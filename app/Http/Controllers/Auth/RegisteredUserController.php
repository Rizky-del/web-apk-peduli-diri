<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nik'   => ['required', 'integer', 'unique:users'],
                'nama_lengkap' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults(), 'min:8'],
            ],
            [
                'nik.required' => 'NIK Wajib Di-isi',
                'nik.integer' => 'Harus Berupa Number',
                'nik.unique' => 'NIK Itu Sudah Ada',

                'nama_lengkap.required' => 'Nama Wajib Di-isi',
                'nama_lengkap.string' => 'Harus Berupa Karakter',
                'nama_lengkap.max' => 'Pengisian Karakter Terlalu Banyak',

                'email.required' => 'Email Wajib Di-isi',
                'email.string' => 'Pengisian Harus Karakter Support Email',
                'email.email' => 'Harus Berupa Email',
                'email.unique' => 'Email Itu Sudah Ada',

                'password.required' => 'Password Wajib Di-isi',
                'password.confirmed' => 'Password Confirmasi Tidak Sama Dengan Password Di-atas-nya',
                'password.min' => 'Password Minimal 8'
            ]
        );

        $user = User::create([
            'nik'   => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
