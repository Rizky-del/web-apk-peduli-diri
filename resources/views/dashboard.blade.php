<x-app-layout>
  <style>
    .btn {
      border-color: #09BC92;
      background-color: #09BC92;
      color: white;
    }

    .btn:hover {
      color: white;
    }
  </style>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-8">
                <div class="card mb-3">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card-body">
                        <h5 class="card-title">Selamat Datang Di Peduli Diri</h5>
                        <p class="card-text mb-3">Silahkan Catat Hal Baru Di Halaman Ini</p>
                        <a href="{{ route('catatan.index') }}" class="btn">Halaman Catatan</a>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card-body pb-0 px-0 px-md-4 float-end">
                        <img
                            src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                             width="200"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                        />
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-4">
              <div class="card p-3 text-center">
                <h4 class="card-title">Jumlah Catatan Anda</h4>
                <h1 class="card-text pt-3">{{ $catatan_count }}</h1>
              </div>
            </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-8">
            <div class="row">
              <h5 class="my-3">Gambar Lokasi Dan Album Anda</h5>
              <div class="col-sm-6 mb-5">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      @foreach($album as $key => $albums)
                        @if(!is_null($albums['album']))
                          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('public/gambar_album/'.$albums->album) }}" alt="album" class="album" >
                          </div>
                        @endif
                      @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                      <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                      <span class="visually-hidden">Next</span>
                    </a>
                </div>
              </div>
              <div class="col-sm-6 mb-5">
                <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      @foreach($catatan as $key => $lokasi)
                        @if(!is_null($lokasi['gambar_lokasi']))
                          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('public/gambar_lokasi/'.$lokasi->gambar_lokasi) }}" alt="album" class="album" >
                          </div>
                        @endif
                      @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample2" role="button" data-bs-slide="prev">
                      <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample2" role="button" data-bs-slide="next">
                      <span class="visually-hidden">Next</span>
                    </a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
