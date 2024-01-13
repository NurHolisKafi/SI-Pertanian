
@extends('layout.home.index')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown">Information</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Budidaya Tanaman</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Content Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
                <p class="fs-4 fw-medium fst-italic text-primary">Budidaya Tanaman</p>
                <h1 class="display-6" style="font-size: xx-large;">Informasi Tentang Cara Menanam Tanaman</h1>
            </div>
            <div class="row">
                @if ($budidaya->isNotEmpty())
                    @foreach ($budidaya as $item)
                    <div class="col-md-3 col-sm-6 col-12 wow fadeInUp">
                        <div class="card mt-5" id="card-link" data-path="{{ route('budidaya.detail',$item->id) }}" style="border-radius: 5px; box-shadow: 1.5px 1.5px rgba(9, 255, 0, 0.74)">
                            <img src="{{ route('tanaman.image',$item->thumbnail) }}" alt="" style="height: 150px">
                            <div class="card-body text-center">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="text-dark">{{ $item->nama }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col text-center wow fadeInUp">
                        <p class="fs-5 text-primary">Data budidaya masih belum ada</p>
                    </div> 
                @endif
            </div>
        </div>
        <div class="container d-flex justify-content-end">
            {{ $budidaya->links() }}
        </div>
    </div>
    <!--news End -->
@endsection

@push('additional-script')
    
<script>
    const card = document.querySelectorAll('#card-link');
    card.forEach(element => {
        element.addEventListener('click', function () {
            let path = element.getAttribute('data-path');
            window.location.href = path;
        })
        
    });
</script>

@endpush
