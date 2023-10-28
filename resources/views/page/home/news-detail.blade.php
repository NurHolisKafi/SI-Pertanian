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
                    <li class="breadcrumb-item"><a href="/news">News</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">{{ $detail->judul }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- news Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col">
                    <div class="card p-2">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h1 class="card-title">{{ $detail->judul }}</h1>
                                <p style="font-family: 'Open Sanz';">{{ $detail->tanggal_posting }}</p>
                            </div>
                            <div class="d-flex justify-content-center mb-5">
                                <img src="{{ route('news.image',['name' => $detail->thumbnail]) }}" alt="thumbnail" width="30%">
                            </div>
                            <p class="card-text" style="text-align: justify;">{!! $detail->isi_berita !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <h1 class="fs-3 fw-medium text-primary">Related Article</h1>
                </div>
            </div>
            <div class="row">
                @foreach ($related_articel as $item)
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
    <!-- news End -->

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