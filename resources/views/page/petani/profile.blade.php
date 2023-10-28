
@php
    $alamat_lengkap = auth()->user()->alamat;
    $split_alamat = explode(',',$alamat_lengkap);
    $kota = end($split_alamat);
    $index_kota = count($split_alamat) - 1;
    unset($split_alamat[$index_kota]);
    $alamat_tanpa_kota = implode(',',$split_alamat);
     
@endphp

@extends('layout.petani.index')

@section('title','My Profile')

@section('profile-active','active')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="text-gray-800 mb-4">Profile</h1>

    <!-- Content Row -->
    <div class="card border-left-success text-dark shadow h-100 p-4">
        <div class="card-body">
            <h5 class="font-weight-bold">Account Information</h5>
            <hr class="my-4">
            <h6 class="font-weight-bold mb-3">Profile Picture Change</h6>
            <div class="row align-items-center">
                <div class="col-2">
                    <img src="{{ route('view.image', ['name' => auth()->user()->image]) }}" class="img-thumbnail rounded-circle" alt="">
                </div>
                <div class="col-5">
                    <div class="row justify-content-start">
                        <div class="col-3">
                            <button class="border py-2 px-3 border btn-change" data-toggle="modal"
                                data-target="#upProfileModal">Change</button>
                        </div>
                        <div class="col-3 {{ auth()->user()->image == 'default_profile.jpg' ? 'd-none' : 'd-block' }}">
                            <button class="border py-2 px-3 border btn-remove" data-toggle="modal"
                                data-target="#delProfileModal">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <h5 class="font-weight-bold mb-4">Personal Information <span><i class="fas fa-xs fa-pen m-3"
                        id="btn-edit-account"></i></span></h5>
            <div class="row " id="profile-view-mode">
                <div class="col-3">
                    <label class="text-gray-500">Nama</label>
                </div>
                <div class="col-8">
                    <p class="text-capitalize">{{ auth()->user()->name }}</p>
                </div>
                <div class="col-3">
                    <label class="text-gray-500">Email</label>
                </div>
                <div class="col-8">
                    <p>{{ auth()->user()->email }}</p>
                </div>
                <div class="col-3">
                    <label class="text-gray-500">No Hp</label>
                </div>
                <div class="col-8">
                    <p> {{ auth()->user()->notelp }} </p>
                </div>
                <div class="col-3">
                    <label class="text-gray-500">Jenis Kelamin</label>
                </div>
                <div class="col-8">
                    <p class="text-capitalize">{{ auth()->user()->jenis_kelamin }}</p>
                </div>
                <div class="col-3">
                    <label class="text-gray-500">Profesi</label>
                </div>
                <div class="col-8">
                    <p class="text-capitalize">{{ auth()->user()->profesi }}</p>
                </div>
                <div class="col-3">
                    <label class="text-gray-500">Organisasi Petani</label>
                </div>
                <div class="col-8">
                    <p class="text-capitalize">{{ auth()->user()->organisasi_petani }}</p>
                </div>
                <div class="col-3">
                    <label class="text-gray-500">Kota</label>
                </div>
                <div class="col-8">
                    <p class="text-capitalize">{{ $kota }}</p>
                </div>
                <div class="col-3">
                    <label class="text-gray-500">Alamat</label>
                </div>
                <div class="col-8">
                    <p class="text-capitalize">{{ $alamat_tanpa_kota }}</p>
                </div>
            </div>
            <form action="{{ route('store.information') }}" method="POST" class="mb-3 d-none" id="profile-edit-mode">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control shadow-none" name="nama"
                                autocomplete="username" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" name="email" class="form-control shadow-none"
                                autocomplete="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="custom-select shadow-none" name="jenis_kelamin">
                                <option value="laki - laki">Laki - Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <input type="text" value="{{ $kota }}" class="form-control shadow-none" name="kota"
                                autocomplete="address-level2" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea rows="3" name="alamat" class="form-control shadow-none" required>{{ $alamat_tanpa_kota }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">No Hp</label>
                            <input type="text" name="notelp" value="{{ auth()->user()->notelp }}" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profesi</label>
                            <input type="text" value="{{ auth()->user()->profesi }}" name="profesi" class="form-control shadow-none" autocomplete="work"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Organisasi Petani</label>
                            <input type="text" value="{{ auth()->user()->organisasi_petani }}" name="organisasi" class="form-control shadow-none"
                                autocomplete="organization" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger p-2 mt-3" id="btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-secondary p-2 mt-3">Save</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection

@section('modal')

<!-- Change img profile Modal-->
<div class="modal fade text-dark" id="upProfileModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <form action="{{ route('store.img') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{ auth()->user()->image }}">
                <div class="modal-body">
                    <label>Pilih File</label>
                    <div class="custom-file shadow-none">
                        <input type="file" name="img_profile" class="custom-file-input" accept=".jpg,.jpeg,.png" required>
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    <span class="small">max file 2 mb</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete img profile Modal-->
<div class="modal fade text-dark" id="delProfileModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Yakin Ingin Menghapus Profile ?</label>
            </div>
            <form action="{{ route('delete.img') }}" method="POST">
                @csrf
                <input type="hidden" name="filename" value="{{ auth()->user()->image }}">                
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('profile-event')
    <script>
        $("#btn-edit-account").click(function () {
            $("#btn-edit-account").addClass('d-none');
            $("#profile-view-mode").addClass('d-none');
            $("#profile-edit-mode").removeClass('d-none');
        });

        $("#btn-cancel").click(function () {
            $("#btn-edit-account").removeClass('d-none');
            $("#profile-view-mode").removeClass('d-none');
            $("#profile-edit-mode").addClass('d-none');
        });

    </script>
@endpush

@push('additional-script')
    <script>
        $(document).ready(function(params) {
            let user_jk = @json(auth()->user()->jenis_kelamin);
            $('#jk').val(user_jk);

            let input_file_profile = document.querySelector('#upProfileModal input[name="img_profile"]');
            input_file_profile.addEventListener('change',function(params) {
                $('#upProfileModal .custom-file-label').html(input_file_profile.files[0].name)
            })

            let success_message;
            let danger_message;
            @if(session('success'))
                success_message = @json(session('success'));
                successAlert(success_message);
            @endif

            @error('image')
                danger_message = @json($message);
                dangerAlert(danger_message)
            @enderror

            @error('email')
                danger_message = @json($message);
                dangerAlert(danger_message)
            @enderror
        })
    </script>
@endpush