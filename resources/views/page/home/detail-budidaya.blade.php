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
                    <li class="breadcrumb-item text-dark" aria-current="page">Padi
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
                <div class="col-10">
                    <div class="card p-2">
                        <div class="text-center mb-5">
                            <h1 class="card-title">Budidaya Tanaman Padi</h1>
                        </div>
                        <img src="https://pertanian.uma.ac.id/wp-content/uploads/2023/03/klasifikasi-dan-morfologi-padi.jpg" alt="thumbnail" width="100%">
                        <div class="card-body">
                            <p class="card-text" style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt amet error officia obcaecati atque repudiandae aperiam ex eius odio ratione quis in laborum recusandae nisi neque placeat cumque, minus tenetur officiis dignissimos ea. Et deleniti voluptate, praesentium debitis omnis ex optio sapiente. Voluptatum sit dolorem, perferendis culpa quasi impedit doloribus nihil? Nam ullam impedit explicabo doloremque ut iste error tenetur aliquid, laborum at, nihil qui omnis numquam rerum earum vero debitis quam eveniet mollitia quidem deleniti! Cum similique quas id nemo accusantium iste assumenda accusamus quis animi. Illo deserunt accusantium maxime atque, ea culpa tempora ratione delectus consequatur! Ea, ut?</p>
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