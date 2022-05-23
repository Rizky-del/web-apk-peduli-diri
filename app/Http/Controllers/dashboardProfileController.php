<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class dashboardProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('setting.settingprofile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'nik' => ['required', 'string', 'max:255', 'unique:users,nik,' . auth()->id()],
                'nama_lengkap' => ['required', 'max:255'],
                'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email,' . auth()->id()],
            ],
            [
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'nik.string' => 'Harus Berupa Karakter',
                'nik.max' => 'Pengisian Karakter Terlalu Banyak',
                'nik.unique' => 'NIK tidak boleh sama',

                'nama_lengkap.required' => 'Nama Tidak Boleh Kosong',
                'nama_lengkap.max'  => 'Pengisian Karaker Terlalu Banyak',

                'email.required' => 'Email Tidak Boleh Kosong',
                'email.email' => 'Harus Berupa Email',
                'email.string' => 'Pengisian Harus Karakter',
                'email.max' => 'Pengisian Karakter Terlalu Banyak',
                'email.unique' => 'Email Itu Sudah Ada'
            ]
        );

        auth()->user()->update([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
        ]);


        if ($request->email == auth()->user()->email) {
            auth()->user()->update(['email' => $request->email]);
        } else {
            auth()->user()->update(['email' => $request->email]);
            auth()->user()->update(['email_verified_at' => null]);
            auth()->user()->sendEmailVerificationNotification();
        }


        return back()->with('success', 'Profile anda berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function avatar(Request $request) 
    {
        $request->validate(
            [
                'avatar' => ['image', 'mimes:jpg,jpeg,png', 'max:5000'],
            ],
            [
                'avatar.image' => 'Harus Berupa Gambar',
                'avatar.mimes' => 'Jenis File Yang Boleh JPG, JPEG, PNG',
                'avatar.max' => 'Ukuran File Max 5MB'
            ]
        );

        if($request->hasfile('avatar'))
        {
            $avatars = 'avatars/'.auth()->user()->avatar;
            if(File::exists($avatars))
            {
                File::delete($avatars);
            }
            $file = $request->file('avatar');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('avatars/', $filename);
            auth()->user()->update([
                'avatar' => $filename
            ]);
        }

        return back()->with('success', 'Avatar Anda Berhasil Di-ubah');
    }
}
