<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catatanPerjalanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;

class dashboardController extends Controller
{
    public function index()
    {
        $catatan = catatanPerjalanan::all()->where('user_id', Auth::user()->id);
        $album = Album::all()->where('user_id', Auth::user()->id);

        $catatan_count = DB::table('catatan_perjalanans')->where('user_id', Auth::user()->id)->count();
        return view('dashboard', compact('catatan', 'album', 'catatan_count'));
    }
}
