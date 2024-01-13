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
                    <li class="breadcrumb-item"><a href="/budidaya">Budidaya</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">{{ $data->tanaman->nama }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- content Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-12 col-md-10">
                    <div class="card p-5">
                        <div class="text-center mb-5">
                            <h1 class="card-title">Budidaya Tanaman {{ $data->tanaman->nama }}</h1>
                        </div>
                        <img src="{{ route('tanaman.image',$data->thumbnail) }}" alt="thumbnail" width="100%">
                        <div class="card-body">
                            {!! $data->tahapan !!}
                        </div>
                    </div>
                </div>
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