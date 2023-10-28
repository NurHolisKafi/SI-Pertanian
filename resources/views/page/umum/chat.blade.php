@extends('layout.umum.index')

@section('title','Chat')

@section('chat-active','active')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="text-gray-800 mb-4">Chat</h1>
    <h6 class="mb-4">Diskusikan masalah dengan para petani profesional</h6>
    <!-- Content Row -->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card h-100 border-left-primary" style="min-height: 60vh;">
                    <div class="card-body">

                        <!-- list orang -->
                        <ul class="list-unstyled mb-0">
                            <li class="p-2 border-bottom message">
                                <a href="#!"
                                    class="d-flex justify-content-between text-decoration-none">
                                    <div class="d-flex flex-row">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp"
                                            alt="avatar"
                                            class="rounded-circle d-flex align-self-center mr-3 shadow-sm shadow-1-strong"
                                            width="60">
                                        <div class="pt-1">
                                            <p class="font-weight-bold mb-0">John Doe</p>
                                            <p class="small text-muted">Hello, Are you there?
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pt-1">
                                        <p class="small text-muted mb-1">Just now</p>
                                        <span class="badge bg-success float-right">1</span>
                                    </div>
                                </a>
                            </li>
                            <li class="p-2 border-bottom message">
                                <a href="#!"
                                    class="d-flex justify-content-between text-decoration-none">
                                    <div class="d-flex flex-row">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-1.webp"
                                            alt="avatar"
                                            class="rounded-circle d-flex align-self-center mr-3 shadow-1-strong"
                                            width="60">
                                        <div class="pt-1">
                                            <p class="font-weight-bold mb-0">Danny Smith</p>
                                            <p class="small text-muted">Lorem ipsum dolor sit.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pt-1">
                                        <p class="small text-muted mb-1">5 mins ago</p>
                                    </div>
                                </a>
                            </li>
                            <li class="p-2 border-bottom message">
                                <a href="#!"
                                    class="d-flex justify-content-between text-decoration-none">
                                    <div class="d-flex flex-row">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-2.webp"
                                            alt="avatar"
                                            class="rounded-circle d-flex align-self-center mr-3 shadow-1-strong"
                                            width="60">
                                        <div class="pt-1">
                                            <p class="font-weight-bold mb-0">Alex Steward</p>
                                            <p class="small text-muted">Lorem ipsum dolor sit.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pt-1">
                                        <p class="small text-muted mb-1">Yesterday</p>
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <!-- Halaman Chat -->
                        <div class="row d-none">
                            <div class="col-12">
                                <div class="d-flex align-items-center border-bottom pb-2 mb-4">
                                    <div id="prev"><i class="fas fa-arrow-left mr-4"></i>
                                    </div>
                                    <img src="../img/about-4.jpg" alt="avatar"
                                        class="rounded-circle d-flex align-self-center mr-3 shadow-sm"
                                        width="40" height="40">
                                    <div class="ml-1">
                                        <p class="font-weight-bold mb-0">John Doe</p>
                                        <small>online</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h-100" style="min-height: 50vh;">
                                    <ul class="list-unstyled d-none">
                                        <li class="d-flex justify-content-between mb-4">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                                                alt="avatar"
                                                class="rounded-circle d-flex align-self-start mr-3 shadow"
                                                width="60">
                                            <div class="card">
                                                <div
                                                    class="card-header d-flex justify-content-between p-3">
                                                    <p class="font-weight-bold mb-0">Brad Pitt</p>
                                                    <p class="text-muted small mb-0"><i
                                                            class="far fa-clock"></i> 12
                                                        mins ago</p>
                                                </div>
                                                <div class="card-body">
                                                    <p class="mb-0">
                                                        Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing
                                                        elit, sed
                                                        do eiusmod tempor
                                                        incididunt ut
                                                        labore et dolore magna aliqua.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex justify-content-between mb-4">
                                            <div class="card w-100">
                                                <div
                                                    class="card-header d-flex justify-content-between p-3">
                                                    <p class="font-weight-bold mb-0">Lara Croft</p>
                                                    <p class="text-muted small mb-0"><i
                                                            class="far fa-clock"></i> 13
                                                        mins ago</p>
                                                </div>
                                                <div class="card-body">
                                                    <p class="mb-0">
                                                        Sed ut perspiciatis unde omnis iste natus
                                                        error
                                                        sit
                                                        voluptatem accusantium doloremque
                                                        laudantium.
                                                    </p>
                                                </div>
                                            </div>
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp"
                                                alt="avatar"
                                                class="rounded-circle d-flex align-self-start ml-3 shadow"
                                                width="60">
                                        </li>
                                        </li>
                                        <li class="d-flex justify-content-between mb-4">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                                                alt="avatar"
                                                class="rounded-circle d-flex align-self-start mr-3 shadow"
                                                width="60">
                                            <div class="card">
                                                <div
                                                    class="card-header d-flex justify-content-between p-3">
                                                    <p class="font-weight-bold mb-0">Brad Pitt</p>
                                                    <p class="text-muted small mb-0"><i
                                                            class="far fa-clock"></i> 12
                                                        mins ago</p>
                                                </div>
                                                <div class="card-body">
                                                    <p class="mb-0">
                                                        Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing
                                                        elit, sed
                                                        do eiusmod tempor
                                                        incididunt ut
                                                        labore et dolore magna aliqua.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-white d-flex align-items-center w-100"
                                    style="bottom: 0;">
                                    <div class="form-outline mb-2 w-100">
                                        <textarea class="form-control shadow-none" id="textAreaExample2"
                                            rows="1" placeholder="type a message ..."></textarea>
                                    </div>
                                    <button type="button"
                                        class="btn mb-2 btn-success ml-2">Send</button>
                                </div>
                            </div>
                        </div>

                        <!-- halaman jika chat kosong -->
                        <div class="d-none">
                            <div class="d-flex h-100 justify-content-center align-items-center">
                                <p>Belum ada pesan</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- /.container-fluid -->

@endsection