@extends('layout.admin.index')

@section('title','Kebutuhan Tanam')

@push('additional-link')
      
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endpush


@section('content')
    
<!-- Begin Page Content -->
<div class="container-fluid">

    <h3 class="text-gray-600 mb-4">Manajemen Data Jenis Tanaman</h3>
    <!-- Content Row -->
    <div class="card border-left-success text-dark shadow h-100 p-4">
        <div class="card-header py-3 bg-white">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahModal"><i
                    class="bi bi-plus-lg mr-1"></i>Tambah</button>
        </div>
        <div class="card-body text-dark">
            <!-- DataTales Example -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 1rem;">No</th>
                            <th>Tanaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td class="text-capitalize"> {{ $item->nama }} </td>
                            <td>
                                <button class="btn btn-sm btn-warning shadow-none" data-toggle="modal"
                                    data-target="#editModal" data-path="{{ route('tanaman.update',$item->id_tanaman) }}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger shadow-none" data-toggle="modal"
                                    data-target="#hapusModal" data-path="{{ route('tanaman.destroy',$item->id_tanaman) }}"><i class="fas fa-trash"></i></button>
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
    
<!-- Tambah Tanaman -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tanaman</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="{{ route('tanaman.store') }}" method="post" enctype="multipart/form-data" id="form-tambah">
                <div class="modal-body">
                @csrf
                    <div class="mb-3">
                        <label>Nama Tanaman</label>
                        <input type="text" name="tanaman" class="form-control shadow-none">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary shadow-none" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-none">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Tanaman -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Tanaman</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="" method="post" id="form-edit">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Tanaman</label>
                        <input type="text" name="update-tanaman" class="form-control shadow-none">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary shadow-none" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-none">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Hapus Tanaman -->
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

            $('#editModal').on('show.bs.modal',function(e){
                let button = e.relatedTarget;
                let route = button.getAttribute('data-path');
                let tr = button.parentElement.parentElement.children[1];
                let name = tr.innerText
                $('input[name="update-tanaman"]').val(name);
                $('#form-edit').attr('action',route);
            })

            $('#hapusModal').on('show.bs.modal',function(e){
                let button = e.relatedTarget;
                let route = button.getAttribute('data-path');
                $('#form-delete').attr('action',route);
            })

            @if(session('success'))
                success_message = @json(session('success'));
                successAlert(success_message);
            @endif

            @error('tanaman')
                danger_message = @json($message);
                dangerAlert(danger_message)
            @enderror

            @error('update-tanaman')
                danger_message = @json($message);
                dangerAlert(danger_message)
            @enderror
        });

    </script>
@endpush
