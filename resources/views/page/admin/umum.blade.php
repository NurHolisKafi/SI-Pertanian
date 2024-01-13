@extends('layout.admin.index')

@section('title','Daftar User Umum')

@section('user-active','active')

@push('additional-link')
      
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="{{ asset('/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush


@section('content')
    
<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 text-gray-600 mb-5">Data Users</h1>
    <!-- Content Row -->
    <div class="card border-left-primary text-dark shadow h-100 p-4">
        <div class="card-body text-dark">
            <!-- DataTales Example -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 1rem;">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Dibuat</th>
                            <th style="width: 4rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td class="text-capitalize"> {{ $item->name }} </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Aksi</div>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#viewModal" data-path="{{ route('user.data',$item->id_user) }}">Lihat</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#passModal" data-id="{{ $item->id_user }}">Ubah Password</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#hapusModal" data-path="{{ route('delete.user',$item->id_user) }}">Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection


@section('modal')
    
    <!-- View User -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Preview User</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <!-- Ubah Pass -->
    <div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="passModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <form action="{{ route('update.user') }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input class="form-control shadow-none" name="new_pass" type="password" min="8" required>
                        <small>password minimal 8 karakter</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light shadow-none" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-none">Save</button>
                </div>
                </form> 
            </div>
        </div>
    </div>

    <!-- Hapus User -->
    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Confirm</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <form action="" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <h5>Yakin Ingin Menghapus ?</h5>
                        <small>Note : data yang dihapus tidak akan bisa dikembalikan</small>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light shadow-none" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-secondary shadow-none">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@push('additional-script')
    <script src="{{ asset('/vendor/datatables/jquery.dataTables.min.js') }}"></script> 
    <script src="{{ asset('/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
            $('#viewModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let path = button.getAttribute('data-path');
                $('#data-user').remove();
                $('#viewModal .modal-body').html('<p class="text-center">Tunggu Sebentar.....</p>')
                // console.log(path);
                $.ajax({
                    url: path, // Ganti dengan URL yang sesuai
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    success: function(data) {
                        $('#viewModal .modal-body').html(`
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <label class="text-gray-500">Nama</label>
                                </div>
                                <div class="col-7">
                                    <p>${data.name}</p>
                                </div>
                                <div class="col-4">
                                    <label class="text-gray-500">Email</label>
                                </div>
                                <div class="col-7">
                                    <p>${data.email}</p>
                                </div>
                                <div class="col-4">
                                    <label class="text-gray-500">No Hp</label>
                                </div>
                                <div class="col-7">
                                    <p class="text-capitalize">${data.notelp}</p>
                                </div>
                                <div class="col-4">
                                    <label class="text-gray-500">Jenis Kelamin</label>
                                </div>
                                <div class="col-7">
                                    <p class="text-capitalize">${data.jenis_kelamin}</p>
                                </div>
                                <div class="col-4">
                                    <label class="text-gray-500">Alamat</label>
                                </div>
                                <div class="col-7">
                                    <p class="text-capitalize">${data.alamat}</p>
                                </div>
                            </div>
                        </div>`
                        );
                    },
                });
            })

            $('#passModal').on('show.bs.modal',function(e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-id');
                $('#passModal input[name="id"]').val(id);
            })

            $('#hapusModal').on('show.bs.modal',function(e) {
                let button = e.relatedTarget;
                let path = button.getAttribute('data-path');
                $('#hapusModal form').attr('action',path);
            })

            @if(session('success'))
                success_message = @json(session('success'));
                successAlert(success_message);
            @endif
        });

    </script>
@endpush
