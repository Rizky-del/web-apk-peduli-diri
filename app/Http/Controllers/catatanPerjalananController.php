<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\catatanPerjalanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class catatanPerjalananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catatan = catatanPerjalanan::latest()->where('user_id', Auth::user()->id)->paginate(5);
        return view('catatan.catatanPerjalanan', compact('catatan'))->with('i' , (request()->input('page', 1) - 1) * 5);   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catatan.isiData');
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
                'lokasi_kunjung' => ['required', 'string', 'max:255'],
                'suhu_tubuh'    => ['required', 'integer', 'max:255'],
                'uploadlokasi' => ['image', 'mimes:jpg,jpeg,png', 'max:5000'],
            ],
            [
                'lokasi_kunjung.required' => 'Lokasi Tidak Boleh Kosong',
                'lokasi_kunjung.string' => 'Harus Berupa Karakter',
                'lokasi_kunjung.max' => 'Pengisian Karakter Terlalu Banyak',

                'suhu_tubuh.required' => 'Suhu Tidak Boleh Kosong',
                'suhu_tubuh.integer' => 'Harus Berupa Angka',
                'suhu_tubuh.max' => 'Angka Terlalu Banyak',

                'uploadlokasi.image' => 'Harus Berupa Gambar',
                'uploadlokasi.mimes' => 'Jenis File Yang Boleh JPG, JPEG, PNG',
                'uploadlokasi.max' => 'Ukuran File Max 5MB'
            ]
        );

        $catatan = new catatanPerjalanan();
        $catatan->user_id = Auth::user()->id;
        $catatan->tanggal = Carbon::now()->toFormattedDateString();
        $catatan->chek_in = Carbon::now();
        $catatan->lokasi_kunjung = $request->lokasi_kunjung;
        $catatan->suhu_tubuh = $request->suhu_tubuh;

        if($request->file('uploadlokasi')){
            $file = $request->file('uploadlokasi');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('public/gambar_lokasi'), $filename);
            $catatan['gambar_lokasi']= $filename;
        }

        $catatan->deskripsi = $request->deskripsi;
        $catatan->save();

        if ($catatan) {
            return redirect()
                ->route('catatan.index')
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
        $catatan = catatanPerjalanan::find($id);
        return view('catatan.edit', compact('catatan'));
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
        $this->validate($request, 
            [
                'uploadlokasi' => ['image', 'mimes:jpg,jpeg,png', 'max:5000'],
            ],
            [
                'uploadlokasi.image' => 'Harus Berupa Gambar',
                'uploadlokasi.mimes' => 'Jenis File Yang Boleh JPG, JPEG, PNG',
                'uploadlokasi.max' => 'Ukuran File Max 5MB'
            ]
        );

        $catatan = catatanPerjalanan::find($id);

        if($request->file('uploadlokasi')){
            $album_lokasi = 'public/gambar_lokasi/'.$catatan->gambar_lokasi;

            if(File::exists($album_lokasi))
                {
                    File::delete($album_lokasi);
                }

            $file = $request->file('uploadlokasi');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('public/gambar_lokasi'), $filename);

            $catatan['gambar_lokasi']= $filename;

            $catatan->deskripsi = $request->deskripsi;
            $catatan->update();

        } else {
            $catatan->deskripsi = $request->deskripsi;
            $catatan->update();
        }

        if ($catatan) {
            return redirect()
                ->route('catatan.index')
                ->with([
                    'success' => 'Data Perjalanan Anda Berhasil Di-ubah'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Data Perjalanan Anda Gagal Di-ubah'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $temp = catatanPerjalanan::findOrfail($id);
        $album_lokasi = 'public/gambar_lokasi/'.$temp->gambar_lokasi;
            if(File::exists($album_lokasi))
                {
                    File::delete($album_lokasi);
                }
        $temp->delete();

        if($temp) {
            return redirect()->route('catatan.index')->with([
                'success' => 'Data berhasil dihapus'
            ]);
        } else {
            return redirect()->route('catatan.index')->back()->withInput()->with([
                'gagal' => 'data gagal dihapus'
            ]);
        }
    }

    public function update_chekout(Request $request, catatanPerjalanan $id)
    {
        $id->update(['chek_out' => Carbon::now()]);

        return redirect()->route('catatan.index')
        ->with('success', 'berhasil chek out');
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;
        $catatan = catatanPerjalanan::where('lokasi_kunjung', 'like', "%" . $cari . "%")->where('user_id', Auth::user()->id)->paginate(5);
        return view('catatan.catatanPerjalanan', compact('catatan'))->with('i' , (request()->input('page', 1) - 1) * 5);
    }

    public function sortfirst(Request $request)
    {
        $catatan = catatanPerjalanan::orderBy('lokasi_kunjung', 'asc')
                    ->orderBy('suhu_tubuh', 'asc')
                    ->where('user_id', Auth::user()->id)
                    ->paginate(5);
        return view('catatan.catatanPerjalanan', compact('catatan'))->with('i' , (request()->input('page', 1) - 1) * 5);
    }

    public function sortlast(Request $request)
    {
        $catatan = catatanPerjalanan::orderBy('lokasi_kunjung', 'desc')
                    ->orderBy('suhu_tubuh', 'desc')
                    ->where('user_id', Auth::user()->id)
                    ->paginate(5);
        return view('catatan.catatanPerjalanan', compact('catatan'))->with('i' , (request()->input('page', 1) - 1) * 5);
    }
}
