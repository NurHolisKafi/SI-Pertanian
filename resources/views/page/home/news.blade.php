
@extends('layout.home.index')

@section('news-active','active')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown">News</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">News</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Products Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
                <p class="fs-4 fw-medium fst-italic text-primary">News</p>
                <h1 class="display-6" style="font-size: xx-large;">Informasi Seputar Bidang Pertanian</h1>
            </div>
            <div class="row">
                @foreach ($news as $item)
                <div class="col-md-6 col-12">
                    <div class="card mb-3" id="news-card" data-path="{{route('news.detail',['id' => $item->id_berita ])  }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-2 col-4">
                                    <img src="{{ route('news.image',['name'=> $item->thumbnail]) }}" class=" w-100" width="50" height="80">
                                </div>
                                <div class="col">
                                    <div style="line-height: 12px;">
                                        <p style="font-size: small;"><i class="bi bi-clock me-2"></i>{{ $item->tanggal_posting }} </p>
                                        <h2 class="fs-5">{{ $item->judul }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--news End -->
@endsection

@push('additional-script')
    
<script>
    const news_card = document.querySelectorAll('#news-card');
    news_card.forEach(element => {
        element.addEventListener('click', function () {
            let path = element.getAttribute('data-path');
            window.location.href = path;
        })
        
    });
</script>

@endpush
