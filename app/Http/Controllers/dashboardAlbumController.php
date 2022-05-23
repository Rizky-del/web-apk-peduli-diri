<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catatanPerjalanan;
use App\Models\Album;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class dashboardAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catatan = catatanPerjalanan::all()->where('user_id', Auth::user()->id);
        $album = Album::all()->where('user_id', Auth::user()->id);
        return view('album.index', compact('catatan', 'album'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'lokasi' => ['required', 'string', 'max:255'],
                'uploadalbum' => ['image', 'mimes:jpg,jpeg,png', 'max:5000'],
            ],
            [
                'lokasi.required' => 'Lokasi Tidak Boleh Kosong',
                'lokasi.string' => 'Harus Berupa Karakter',
                'lokasi.max' => 'Pengisian Karakter Terlalu Banyak',

                'uploadalbum.image' => 'Harus Berupa Gambar',
                'uploadalbum.mimes' => 'Jenis File Yang Boleh JPG, JPEG, PNG',
                'uploadalbum.max' => 'Ukuran File Max 5MB'
            ]
        );

        $catatan = new Album();
        $catatan->user_id = Auth::user()->id;
        $catatan->lokasi = $request->lokasi;

        if($request->file('uploadalbum')){
            $file = $request->file('uploadalbum');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('public/gambar_album'), $filename);
            $catatan['album']= $filename;
        }

        $catatan->deskripsi = $request->deskripsi;
        $catatan->save();

        if ($catatan) {
            return redirect()
                ->route('album.index')
                ->with([
                    'success' => 'Data Perjalanan Anda Berhasil Di-tambahkan'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Data Perjalanan Anda Gagal Di-tambahkan'
                ]);
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
