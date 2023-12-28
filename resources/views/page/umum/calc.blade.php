@extends('layout.umum.index')

@section('title','Kalkulator Panen')

@section('calc-active','active')

@push('additional-link')
      
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush


@section('content')
    
<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="text-gray-800 mb-4">Kalkulator Tanam</h1>
    <h6 class="mb-4">Kalkulator tanam berfungsi sebagai perhitungan yang digunakan untuk memprediksi
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
                            <th style="width: 20%">Tanaman</th>
                            <th style="width: 30%">Luas Tanah (m<sup>2</sup>)</th>
                            <th>Modal</th>
                            <th style="width: 4rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPerhitungan as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->tanaman }}</td>
                            <td>{{ $item->luas }} m<sup>2</sup></td>
                            <td>Rp {{ $item->modal }}</td>
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
                                            data-target="#viewModal" data-id="{{ $item->id }}">Lihat Hasil</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#hapusModal" data-id="{{ $item->id }}">Hapus</a>
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
            <div class="modal-body" id="viewBody">
                {{-- <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <label class="text-gray-600">Bibit</label>
                        </div>
                        <div class="col-7">
                            <p>&#177; Rp 110.000</p>
                        </div>
                        <div class="col-4">
                            <label class="text-gray-600">Pupuk</label>
                        </div>
                        <div class="col-7">
                            <p>&#177; Rp 110.000</p>
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
                            <small class="text-warning">Note: harga kebutuhan tanaman dan hasil panen dapat berubah sesuai situasi dan kondisi tanaman</small>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>


<!-- Tambah perhitungan -->
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
            <form action="/store/tanam" id="formTambah" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label>Modal (tidak termasuk biaya tanah)</label>
                    <input type="number" name="modal" class="form-control shadow-none" min="1">
                </div>
                <div class="mb-3">
                    <label>Luas Tanah (m<sup>2</sup>)</label>
                    <input type="number" name="luas" class="form-control shadow-none" min="1">
                    <small id="note-luas"></small>
                </div>
                <div class="mb-3">
                    <label>Tanaman</label>
                    <select name="tanaman" id="tanaman" class="form-control shadow-none">
                        @foreach ($dataTanaman as $item)
                        <option value="{{ $item->id_tanaman }}">{{ $item->nama }}</option>
                        @endforeach
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
                    <h4 class="modal-title" id="exampleModalLabel">Confirm</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-dark">Yakin Ingin Menghapus ?</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light shadow-none" type="button" data-dismiss="modal">Cancel</button>
                    <a href="" class="btn btn-danger shadow-none">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('additional-script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        let minLuas;
        function getMinLuas(id) {
            let url = '/lahan/min/'+id 
            $.get(url,function(params) {
                $('input[name="luas"]').val(params.min_luas);
                $('#note-luas').html(`
                    Note: minimal luas yang dibutuhkan ${params.min_luas} m<sup>2</sup>
                `);
                minLuas = params.min_luas
            });
        }
        $(document).ready(function () {
            $('#dataTable').DataTable();
            let id = $('select[name="tanaman"]').val();
            getMinLuas(id);

            $('select[name="tanaman"]').on('change',function() {
                id = $('select[name="tanaman"]').val();
                getMinLuas(id)
            })

            $('#viewModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-id');
                console.log(id);
                let url = '/'+ id +'/kebutuhan';
                $('#viewBody').html('Tunggu Sebentar ...');
                $.get(url,function (data) {
                    $('#viewBody').html(data);
                })
            })

            $('#hapusModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-id');
                let url = '/perhitungan/'+ id +'/d';
                $('#hapusModal a').attr('href',url);
            })

            $('#formTambah').on('submit',function (e) {
                e.preventDefault();
                let data = $(this).serializeArray()
                console.log(data);
                if (data[1].value == '' || data[2].value == '') {
                    dangerAlert('input form tidak boleh kosong')
                    return
                }
                if (data[2].value < minLuas) {
                    dangerAlert('tidak memenuhi minimal luas tanah yang dibutuhkan')
                    return
                }

                this.submit();

            })
            
        });
        @if(session('success'))
            success_message = @json(session('success'));
            successAlert(success_message);
        @endif
    </script>
@endpush
