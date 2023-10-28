@extends('layout.admin.index')

@section('title','Daftar User Umum')

@section('user-active','active')

@push('additional-link')
      
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endpush


@section('content')
    
<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 text-gray-800 mb-5">Data User Umum</h1>
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
                        <tr>
                            <td>1</td>
                            <td class="text-capitalize">John Doe</td>
                            <td>johndoe@gmail.com</td>
                            <td>2000-14-12</td>
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
                                            data-target="#viewModal">Lihat</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#passModal">Ubah Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#hapusModal">Hapus</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
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
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <label class="text-gray-500">Nama</label>
                            </div>
                            <div class="col-7">
                                <p>Agus setiawan</p>
                            </div>
                            <div class="col-4">
                                <label class="text-gray-500">Email</label>
                            </div>
                            <div class="col-7">
                                <p class="text-capitalize">www@gmail.com</p>
                            </div>
                            <div class="col-4">
                                <label class="text-gray-500">No Hp</label>
                            </div>
                            <div class="col-7">
                                <p class="text-capitalize">087850234440</p>
                            </div>
                            <div class="col-4">
                                <label class="text-gray-500">Jenis Kelamin</label>
                            </div>
                            <div class="col-7">
                                <p class="text-capitalize">laki - laki</p>
                            </div>
                            <div class="col-4">
                                <label class="text-gray-500">Kota</label>
                            </div>
                            <div class="col-7">
                                <p class="text-capitalize">Surabaya</p>
                            </div>
                            <div class="col-4">
                                <label class="text-gray-500">Alamat</label>
                            </div>
                            <div class="col-7">
                                <p class="text-capitalize">Jl sudirman no.25, Sukolilo</p>
                            </div>
                        </div>
                    </div>
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
                <div class="modal-body">
                    <form action="#" method="post">
                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input class="form-control shadow-none" type="password" min="8" required>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary shadow-none" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-none">Save</button>
                </div>
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
                <div class="modal-body">
                    <h6>Yakin Ingin Menghapus ?</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light shadow-none" type="button" data-dismiss="modal">Cancel</button>
                    <a href="" class="btn btn-secondary shadow-none">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection


@push('additional-script')
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
            @if(session('success'))
                success_message = @json(session('success'));
                successAlert(success_message);
            @endif
        });

    </script>
@endpush
