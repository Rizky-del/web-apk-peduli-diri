<x-app-layout>
<style>
    .cari {
      border-color: #09BC92;
      background-color: #09BC92;
      color: white;
    }

    .sortfirst {
        border-color: #09BC92;
        background-color: #09BC92;
        color: white;   
    }

    .sortlast {
        border-color: #09BC92;
        background-color: #09BC92;
        color: white;
    }

    .sortfirst:hover {
        color: white;   
    }

    .sortlast:hover {
        color: white;
    }

    .cari:hover {
      color: white;
    }
  </style>
    <div class="py-12 container">
        <div class="row mb-3">
            <div class="max-w-7xl col-md-12 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white  shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 text-center">
                        <span>Data Harian Anda</span> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="max-w-7xl col-md-6 sm:px-6 lg:px-8 mb-3">
                <div class="bg-white  shadow-sm sm:rounded-lg">
                    <div class="bg-white border-b border-gray-200 text-center" style="padding: 16px;">
                        <div class="row">
                            <div class="col-md-6 ">
                                <form action="{{ route('sortfirst') }}" class="d-flex float-start" method="get">
                                    @csrf
                                    
                                    <button type="submit" class="btn sortfirst">Sort Awal</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('sortlast') }}" class="d-flex float-end" method="get">
                                    @csrf
                                
                                    <button type="submit" class="btn sortlast">Sort Akhir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl col-md-6 sm:px-6 lg:px-8 mb-3">
                <div class="bg-white  shadow-sm sm:rounded-lg">
                    <div class="bg-white border-b border-gray-200 text-center" style="padding: 16px;">
                        <form action="{{ route('cari') }}" class="d-flex" method="get">
                            @csrf
                            <input class="form-control me-2" name="cari" type="search" placeholder="Search" aria-label="Search">
                            <button type="submit" class="btn cari" value="submit">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <p>{{ $message }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Waktu Masuk</th>
                                        <th scope="col">Waktu Keluar</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Suhu Tubuh</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($catatan as $note)
                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            <td>{{ $note->tanggal }}</td>
                                            <td>{{ $note->chek_in }}</td>
                                            <td>
                                                @if(is_null($note->chek_out))

                                                <form class="btn-group" action="{{ route('chekout', ['id' => $note->id]) }}" method="post">
                                                    {{ csrf_field() }}

                                                    <input type="submit" class="btn btn-success btn-xs" value="Update">
                                                </form>
                                                @else 
                                                
                                                {{ Carbon\carbon::parse($note->chek_out)->format('H:i') }}
                                                
                                                @endif
                                            </td>
                                            <td>{{ $note->lokasi_kunjung }}</td>
                                            <td>{{ $note->suhu_tubuh }}°C</td>
                                            <td>
                                                <a href="{{ route('catatan.edit', $note->id) }}">
                                                    <button type="button" class="btn btn-sm btn-info mt-2 mb-2">Tambah Kelengkapan</button>
                                                </a>
                                                <form onsubmit="return confirm('Apakah anda yakin ingin menghapus ?');" action="{{ route('catatan.destroy', ['catatan' => $note->id]) }}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger mt-2 mb-2" >Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $catatan->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>