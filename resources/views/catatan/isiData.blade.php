<x-app-layout>
    <style>
        .buat {
            border-color: #09BC92;
            background-color: #09BC92;
            color: white;
        }

        .buat:hover {
            color: white;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Isi Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="row mb-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h5 class="mb-4">Isi Catatan Hari Ini</h5>
                        <form action="{{ route('catatan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                           @if($errors->any())
                           <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                           @endif
                            <div class="mb-3 mt-2">
                                <label for="lokasi" class="col-sm-12 form-label">Lokasi Yang Dikunjungi </label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi_kunjung" placeholder="isi lokasi kunjungan anda">
                            </div>
                            <div class="mb-5">
                                <label for="suhu" class="col-sm-12 form-label">Suhu Tubuh </label>
                                <input type="number" class="form-control" id="suhu" name="suhu_tubuh">
                            </div>

                            <h5 class="mb-4">Di-Bawah Ini Pelengkap (boleh di-isi boleh tidak)</h5>
                            <div class="mb-3">
                                <label for="uploadlokasi" class="form-label">Gambar Lokasi</label>
                                <input class="form-control" type="file" id="uploadlokasi" name="uploadlokasi" />
                                <div id="uploadlokasi" class="form-text">
                                    Kosongkan Saja Jika Tidak Ada
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"></textarea>
                            </div>
                            <div id="deskripsi" class="form-text">
                                Kosongkan Saja Jika Tidak Ada
                            </div>

                            <button type="submit" class="btn buat">Buat Catatan</button>
                            <a href="{{ route('catatan.index') }}">
                                <button type="button" class="btn btn-info">Kembali</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>