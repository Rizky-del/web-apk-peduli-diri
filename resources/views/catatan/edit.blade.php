<x-app-layout>
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h5 class="mb-4">Pelengkap</h5>
                            <form action="{{ route('catatan.update', $catatan->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

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
                                <div class="mb-3">
                                    <label for="uploadlokasi" class="form-label" >Gambar Album</label>
                                    <input class="form-control" type="file" id="uploadlokasi" name="uploadlokasi" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5">{{$catatan->deskripsi}}
                                    </textarea>
                                </div>
                                <div id="deskripsi" class="form-text mb-2">
                                    Kosongkan Saja Jika Tidak Ada
                                </div>

                                <button type="submit" class="btn text-white" style="background-color: #09BC92;">Ubah Catatan</button>
                                <a href="{{ route('catatan.index') }}">
                                    <button type="button" class="btn btn-info">Kembali</button>
                                </a>
                            </form>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>