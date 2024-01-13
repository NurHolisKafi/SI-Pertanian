<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Informasi Pertanian Desa Kalinganyar</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Nur Holis Kafi" name="author">
    <meta content="Kalinnganyar, Sumenep, Pertanian, Sistem Informasi" name="keywords">
    <meta content="informasi seputar pertanian di desa kalinganyar" name="description">
    

    <!-- Favicon -->
    <link href="{{ asset('img/sumenep-logo.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0 shadow-1">
                <a href="/" class="navbar-brand">
                    <img class="img-fluid" src="{{ asset('img/logo2.png') }}" alt=" Logo">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0 shadow-none" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="/" class="nav-item nav-link @yield('home-active')">Home</a>
                        <a href="/about" class="nav-item nav-link @yield('about-active')">About</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown">Information</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="/news" class="dropdown-item">Berita</a>
                                <a href="/budidaya" class="dropdown-item">Budidaya Tanaman</a>
                                {{-- <a href="/hpt" class="dropdown-item">Hama dan Penyakit</a> --}}
                            </div>
                        </div>
                        <a href="/contact" class="nav-item nav-link @yield('contact-active')">Contact</a>
                        @if (Auth::check())
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle pt-3" data-bs-toggle="dropdown"><img
                                    src="{{ route('view.image', ['name' => auth()->user()->image]) }}" style="margin-right: 0.5rem" class="img-thumbnail rounded-circle" alt="" width="45">{{ auth()->user()->name }}</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="{{ auth()->user()->role == 1 ? '/profile' : '/petani/profile'}}" class="dropdown-item">My Profile</a>
                                <a href="/logout" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                        @elseif(Auth::guard('admin')->check())
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle pt-3" data-bs-toggle="dropdown"><img
                                    src="{{ route('view.image', ['name' => 'default_profile.jpg']) }}" style="margin-right: 0.5rem" class="img-thumbnail rounded-circle" alt="" width="45">{{ auth('admin')->user()->username }}</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Manajemens</a>
                                <a href="/logout" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                        @else
                        <a href="/login" class="nav-item nav-link">Login</a>
                        <a href="/register" class="nav-item nav-link">Register</a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->