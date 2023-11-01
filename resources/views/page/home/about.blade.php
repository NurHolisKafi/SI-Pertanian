
@extends('layout.home.index')

@section('about-active','active')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


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

@endsection
   