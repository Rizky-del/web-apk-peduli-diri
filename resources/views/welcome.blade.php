<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">

        <title>Peduli Diri</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">

        <!-- Link Swiper's CSS -->
        <link
          rel="stylesheet"
          href="https://unpkg.com/swiper/swiper-bundle.min.css"
        />


        <style>
            html, body {
                position: relative;
                height: 100%;
            }

            body {
                font-family: 'Nunito', sans-serif;
                margin: 0;
                padding: 0;
            }

            .swiper {
                width: 100%;
                height: 100%;
                background: #000;
            }

            .swiper-slide {
                /*font-size: 18px;*/
                color: #fff;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                /*padding: 40px 60px;*/
            }

            .parallax-bg {
                position: absolute;
                left: 0;
                top: 0;
                width: 130%;
                height: 100%;
                -webkit-background-size: cover;
                background-size: cover;
                background-position: center;
            }

            .btn {
                border-color: #09BC92;
                background-color: white;
                color: black;
            }

            .btn:hover {
                border-color: #09BC92;
                background-color: #09BC92;
                color: white;
            }
        </style>
    </head>
    <body>
        <!-- Swiper -->

        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff;"
        class="swiper mySwiper">
            <div class="parallax-bg" style=" background-image: url({{ asset('assets/img/backgrounds/jalan_pagi.jpg') }});
                " data-swiper-parallax="-23%">      
            </div>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <header>
                        <div class="container" >
                            <nav class="navbar navbar-dark bg-transparenet">
                                <a class="navbar-brand" href="#">
                                    <img src="{{ asset('assets/img/health.svg') }}" alt="logo">
                                </a>
                            </nav>    
                        </div>
                    </header>
                    <div class="my-3">
                        <div class="container">
                            <h1 class="page-title">PEDULI DIRI</h1>
                            <p class="page-description" >Web Aplikasi, Catatan Perjalanan, Album, Informasi Lokasi & Kesehatan.  
                            </p>
                            <p style="font-weight: bold;">Geser Ke-Kanan Untuk Melihat Halaman Selanjutnya</p>
                            <p>Stay connected</p>
                            <nav class="footer-social-links">
                                <a href="#!" class="social-link"><i class="mdi mdi-facebook-box"></i></a>
                                <a href="#!" class="social-link"><i class="mdi mdi-twitter"></i></a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <header>
                        <div class="container" >
                            <nav class="navbar navbar-dark bg-transparenet">
                                <a class="navbar-brand " href="#">
                                    <img src="{{ asset('assets/img/health.svg') }}" alt="logo">
                                </a>
                            </nav>    
                        </div>
                    </header>
                    <div class="my-1">
                        <div class="container">
                            <h1 class="page-title">Tulislah Hari Wisatamu <span style="color: #09BC92;">Di Pedulidiri.com</span></h1>
                            <p class="page-description" >Kunjungi Berbagai Macam Wisata Yang Ada, Buatlah Album-mu Dan Catatlah Kondisi Kesehatan Anda Dimanapun Berada Sesuai Prosedure Tempat.  
                            </p>
                            <p style="font-weight: bold;">Geser Ke-Kanan Untuk Login</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <header>
                        <div class="container" >
                            <nav class="navbar navbar-dark bg-transparenet">
                                <a class="navbar-brand mx-auto d-block" href="#">
                                    <img src="{{ asset('assets/img/health.svg') }}" alt="logo">
                                </a>
                            </nav>    
                        </div>
                    </header>
                    <div class="my-4">
                        <div class="container">
                            <h1 class="page-title text-center">Masuk Di Sini</h1>
                            <div class="d-grid gap-2 col-8 mx-auto">
                                @if (Route::has('login'))
                                    @auth
                                    <br><br>
                                        <a href="{{ url('/dashboard') }}" class="btn py-3 px-5 ">Dashboard</a>
                                    @else
                                    <div class="d-grid gap-2 ">
                                        <a href="{{ route('login') }}" class="btn py-3 px-5 ">Log in</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="btn py-3 px-5 ">Register</a>
                                        @endif
                                    </div>
                                    @endauth
                                @endif
                            </div>
                            <p style="font-weight: bold; margin-top: 20px;" class="text-center">Geser Ke-Kiri Untuk Kembali</p>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> --}}
            <div class="swiper-pagination"></div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
          var swiper = new Swiper(".mySwiper", {
            speed: 600,
            parallax: true,
            pagination: {
              el: ".swiper-pagination",
              clickable: true
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev"
            }
          });
        </script>
    </body>
</html>
