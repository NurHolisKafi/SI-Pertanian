@extends('layout.admin.index')

@section('title','Kebutuhan Tanam')

@push('additional-link')
      
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endpush


@section('content')
    
<!-- Begin Page Content -->
<div class="container-fluid">

    <h2 class="text-gray-600 mb-4">Kebutuhan Tanam</h2>
    <h6 class="mb-4">Mengelola berbagai kebutuhan untuk menanam tanaman</h6>
    <!-- Content Row -->
    <div class="card border-left-success text-dark shadow h-100 p-4">
        <div class="card-header py-3 bg-white">
            <a href="{{ route('kebutuhantanam.create') }}" class="btn btn-sm btn-primary"><i
                    class="bi bi-plus-lg mr-1"></i>Tambah</a>
        </div>
        <div class="card-body text-dark">
            <!-- DataTales Example -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 1rem;">No</th>
                            <th>Tanaman</th>
                            <th>Kebutuhan</th>
                            <th style="width: 10rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                        <tr>
                            <td> {{ $index+1 }} </td>
                            <td> {{ $item->nama }} </td>
                            <td><a style="color: cornflowerblue" href="#" data-target="#viewModal" data-toggle="modal" data-id="{{ $item->id_tanaman }}">Lihat</a></td>
                            <td>
                                <a href="{{ route('kebutuhantanam.edit',$item->id_tanaman) }}" class="btn btn-sm btn-warning shadow-none"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger shadow-none" data-toggle="modal"
                                    data-target="#hapusModal" data-id="{{ $item->id_tanaman }}"><i class="fas fa-trash"></i></button>
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
    
<!-- View bahan -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Bahan - Bahan</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 1rem;">No</th>
                                    <th>Bahan/Peralatan</th>
                                    <th>Harga (per kg/satuan)</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hapus record -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Hapus Data</h4>
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
                    <button class="btn btn-secondary shadow-none" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger shadow-none">Hapus</button>
                </form>
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
            $('#viewModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-id');
                let url = "{{env('APP_URL')}}" + "/tanaman/kebutuhan/"+id;
                // console.log(url);
                $('#viewModal tbody').html('');
                $.get(url,function (result) {
                    result.forEach((element,index) => {
                        $('#viewModal tbody').append(`
                        <tr>
                            <td>${index+1}</td>
                            <td>${element.nama}</td>
                            <td>RP. ${element.harga}</td>
                        </tr>
                        `);
                    });
                })
            })

            $('#hapusModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-id');
                let url = "{{env('APP_URL')}}" + "/admin/kebutuhantanam/"+id;
                $('#form-delete').attr('action',url);
            })

            @if(session('success'))
                success_message = @json(session('success'));
                successAlert(success_message);
            @endif
        });

    </script>
@endpush
