@extends('layout.petani.index')

@section('title','Kalkulator Panen')

@section('calc-active','active')

@push('additional-link')
      
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endpush


@section('content')
    
<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="text-gray-800 mb-4">Kalkulator Panen</h1>
    <h6 class="mb-4">Kalkulator panen berfungsi sebagai perhitungan yang digunakan untuk memprediksi
        kebutuhan - kebutuhan yang diperlukan dalam menanam tanaman</h6>
    <!-- Content Row -->
    <div class="card border-left-success text-dark shadow h-100 p-2">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span class="card-title h5">Hasil Perhitungan</span>
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah</button>
        </div>
        <div class="card-body text-dark">
            <!-- DataTales Example -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 1rem;">No</th>
                            <th>Tanaman</th>
                            <th>Luas Tanah (m<sup>2</sup>)</th>
                            <th style="width: 4rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Padi</td>
                            <td>350 m<sup>2</sup></td>
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
                                            data-target="#viewModal" data-path="#">Lihat Hasil</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#hapusModal" data-path="#">Hapus</a>
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
    
<!-- View perhitungan -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Hasil Perhitungan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <label class="text-gray-600">Bibit</label>
                            </div>
                            <div class="col-7">
                                <p>Rp 110.000</p>
                            </div>
                            <div class="col-4">
                                <label class="text-gray-600">Pupuk</label>
                            </div>
                            <div class="col-7">
                                <p>Rp 110.000</p>
                            </div>
                            <div class="col-4">
                                <label class="text-gray-600">Cangkul</label>
                            </div>
                            <div class="col-7">
                                <p>Rp 110.000</p>
                            </div>
                            <div class="col-4">
                                <label class="text-gray-600">Mesin Tanam</label>
                            </div>
                            <div class="col-7">
                                <p>Rp 110.000</p>
                            </div>
                            <div class="col-4">
                                <label class="text-gray-600">Hasil Panen</label>
                            </div>
                            <div class="col-7">
                                <p>300 kg</p>
                            </div>
                            <div class="col">
                                <small class="text-warning">Note: hasil panen dapat berubah sesuai situasi kondisi tanaman</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- View perhitungan -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Tambah Perhitungan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label>Modal (tidak termasuk biaya tanah)</label>
                    <input type="number" name="modal" class="form-control shadow-none" min="1">
                </div>
                <div class="mb-3">
                    <label>Luas Tanah</label>
                    <input type="number" name="luas" class="form-control shadow-none" min="1">
                </div>
                <div class="mb-3">
                    <label>Tanaman</label>
                    <select name="tanaman" id="" class="form-control shadow-none">
                        <option value="">Padi</option>
                        <option value="">Jagung</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light shadow-none" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-secondary shadow-none">Hitung</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Hapus perhitungan -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Hapus Berita</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="text-dark">Yakin Ingin Menghapus ?</h6>
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="form-delete">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-light shadow-none" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger shadow-none">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('additional-script')
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/lejcoxpsjxgd19wu942vvfizq3qmtwd86wo7pbby49k5yzyp/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
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
