
@extends('layout.home.index')

@section('home-active','active')

@section('content')

        <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/bgpetani2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <p class="mt-5 fs-4 text-white animated zoomIn">Selamat datang di  Sistem Informasi Pertanian <strong class="text-dark"> Desa Kalinganyar</strong></p>
                                    <h1 class="display-3 text-dark mb-4 animated zoomIn">Temukan solusi pertanian cerdas
                                        dan berkelanjutan di sini</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/bgpetani.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <p class="mt-5 fs-4 text-white animated zoomIn">Selamat datang di  Sistem Informasi Pertanian <strong class="text-dark"> Desa Kalinganyar</strong></p>
                                    <h1 class="display-3 text-dark mb-4 animated zoomIn">Temukan solusi pertanian cerdas
                                        dan berkelanjutan di sini</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row">
                <div class="col wow fadeIn" data-wow-delay="0.5s">
                    <div class="section-title text-center">
                        <p class="fs-4 fw-medium fst-italic text-primary">About Us</p>
                        <h1 class="display-6" style="font-size: xx-large;">Sistem Informasi Pertanian Desa Kalinganyar</h1>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-10 text-center">
                            <p class="mb-0" style="font-size: 1.2rem; line-height: 2rem">Sistem Informasi Pertanian Desa Kalinganyar adalah website yang berfungsi untuk membantu petani di desa kalinganyar. Sistem ini dapat membantu dalam mengatasi masalah pertanian. Petani dapat gunakan ini untuk hasil panen yang lebih baik. Sistem ini membantu pertanian lebih efisien dan petani mendapat hasil lebih banyak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- News Start -->
    <div class="container-fluid product py-5 my-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
                <p class="fs-4 fw-medium fst-italic text-primary">Trending News</p>
                <h1 class="display-6" style="font-size: xx-large;">Informasi Terbaru Bidang Pertanian</h1>
            </div>
            @if ($news->isNotEmpty())
                <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
                    @foreach ($news as $item)
                        <a href="{{ route('news.detail',['id' => $item->id_berita]) }}" class="d-block rounded">
                            <img src="{{ route('news.image',['name' => $item->thumbnail]) }}" alt="" style="max-height: 240px;">
                            <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                                <h4 class="text-primary">{{ $item->judul }}</h4>
                                <span class="news-body text-body">{!! $item->isi_berita !!}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="fs-6 text-primary text-center wow fadeInUp">Berita Belum Ditemukan</p>
            @endif       
        </div>
    </div>
    <!-- News End -->


    <!-- Contact Start -->
    <div class="container-xxl contact py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Contact Us</p>
                <h1 class="display-6">Contact us right now</h1>
            </div>
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <p class="text-center fs-5 mb-5">Untuk informasi lebih lanjut tentang sistem informasi pertanian
                        dapat
                        menghubungi kontak dibawah ini</p>
                    <div class="row g-5">
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-envelope fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">info@example.com</p>
                            <p class="mb-0">support@example.com</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.4s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-phone fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">+012 345 67890</p>
                            <p class="mb-0">+012 345 67890</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-map-marker-alt fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">123 Street</p>
                            <p class="mb-0">New York, USA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Start -->
@endsection

    