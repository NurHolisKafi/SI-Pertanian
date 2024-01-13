@extends('layout.admin.index')

@section('title','Budidaya Tanaman')

@push('additional-link')
      
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush


@section('content')
    
<!-- Begin Page Content -->
<div class="container-fluid">

    <h3 class="text-gray-600 mb-2">Budidaya Tanaman</h3>
    <h6 class="mb-4">Mengelola data cara menanam tanaman yang baik dan benar</h6>
    <!-- Content Row -->
    <div class="card border-left-success text-dark shadow h-100 p-4">
        <div class="card-header py-3 bg-white">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i
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
                            <th style="width: 10rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-capitalize"> {{$item->nama}}</td>
                                <td>
                                    <button class="btn btn-sm btn-info shadow-none" data-toggle="modal"
                                        data-target="#viewModal" data-bs-id="{{ $item->id }}"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-warning shadow-none" data-toggle="modal"
                                        data-target="#editModal" data-bs-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger shadow-none" data-toggle="modal"
                                        data-target="#hapusModal" data-bs-id="{{ $item->id }}"><i class="fas fa-trash"></i></button>
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
    
<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Preview</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="mb-4 text-center">
                        <p class="h4 text-capitalize" id="view_judul"></p>
                        <p style="font-size: small; " id="view_tanggal"></p>
                    </div>
                    <p id="view_isi_budidaya"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Tambah Data</h3>
                <button class="close shadow-none" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="{{ route('budidaya.store') }}" method="post" enctype="multipart/form-data" id="form-tambah">
                <div class="modal-body">
                @csrf
                    <div class="mb-3">
                        <label>Tanaman</label>
                        <select name="id_tanaman" class="form-control shadow-none">
                            <option disabled selected>-- Pilih --</option>
                            @foreach ($jenis_tanaman as $item)
                                <option value="{{$item->id_tanaman}}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label >Gambar Thumbnail(sesuai tanaman yang dipilih)</label>
                        <div class="custom-file">
                            <input type="file" name="thumbnail" class="custom-file-input shadow-none"
                                accept=".jpg,.jpeg,.png" required>
                            <label class="custom-file-label shadow-none" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Langkah - Langkah</label>
                        <textarea name="tahapan" id="tambah-deskripsi"></textarea>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Edit Data</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="form-edit">
                @csrf
                @method('put')
                <div class="modal-body">
                    <h6 id="loading"></h6>
                    <div class="form-input">
                        <input type="hidden" name="old_thumbnail">
                        <div class="mb-3">
                            <label>Tanaman</label>
                            <select name="id_tanaman" class="form-control shadow-none" required>
                                <option disabled selected>-- Pilih --</option>
                                @foreach ($jenis_tanaman as $item)
                                    <option value="{{$item->id_tanaman}}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label >Gambar Thumbnail(sesuai tanaman yang dipilih)</label>
                            <div class="custom-file">
                                <input type="file" name="thumbnail" class="custom-file-input shadow-none"
                                    accept=".jpg,.jpeg,.png" required>
                                <label class="custom-file-label shadow-none" for="inputGroupFile01">Choose file</label>
                            </div>
                            <img id="view_thumb" src="" alt="" width="20%" class="mt-2">
                        </div>
                        <div class="mb-3">
                            <label>Langkah - Langkah</label>
                            <textarea name="tahapan" id="edit-deskripsi"></textarea>
                        </div>
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

<!-- Hapus Modal -->
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
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/lejcoxpsjxgd19wu942vvfizq3qmtwd86wo7pbby49k5yzyp/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('#dataTable').DataTable();
            let input_tambah_image = document.querySelector('#tambahModal input[name="thumbnail"]');
            input_tambah_image.addEventListener('change',function (params) {
                $('#tambahModal .custom-file-label').html(input_tambah_image.files[0].name);
            })

            let input_edit_image = document.querySelector('#editModal input[name="thumbnail"]');
            input_edit_image.addEventListener('change',function (params) {
                $('#editModal .custom-file-label').html(input_edit_image.files[0].name);
            })

            function tinyInit(params) {
                tinymce.init({
                    selector: params, // Gantilah 'textarea#tiny' dengan selektor yang sesuai
                    height: 400,
                    menubar: true,
                    placeholder: "Tulis sesuatu...",
                    plugins: [
                        'advlist', 'autolink','lists', 'link', 'charmap', 'preview', 'anchor', 'searchreplace',
                        'visualblocks', 'fullscreen', 'insertdatetime', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
                });
            }
            tinyInit('#tambah-deskripsi');
            tinyInit('#edit-deskripsi');

            $('#viewModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                let path = "/admin/budidaya/"+id
                $('#view_isi_budidaya').html('Sedang memuat .....')
                $.get(path,function(data) {
                    $('#view_isi_budidaya').html(data.tahapan)
                })
                
            })


            $('#editModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                let path = "/admin/budidaya/"+id
                $('#editModal #form-input').css('display','none');
                $('#loading').html('Sedang memuat.....')
                $.get(path,function(data) {
                    $('#loading').html('')
                    $("#editModal input[name='old_thumbnail']").val(data.thumbnail);
                    $("#view_thumb").attr('src',`/tanaman/${data.thumbnail}/image`)
                    $("#editModal select[name='id_tanaman']").val(data.id_tanaman);
                    tinymce.get('edit-deskripsi').setContent(data.tahapan);
                    $('#editModal .modal-body').css('display','block');
                    
                })
                $('#form-edit').attr('action',path);
            })

            $('#hapusModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                let path = "/admin/budidaya/"+id;
                $('#form-delete').attr('action',path);
            })

            
            //Event Submit Form

            $('#form-tambah').on('submit',function(e) {
                e.preventDefault();
                let valisiBerita = tinymce.get('tambah-deskripsi').getContent();
                
                const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if(input_tambah_image.files[0] && !allowedExtensions.exec(input_tambah_image.files[0].name)){
                    dangerAlert('Tipe file yang diperbolehkan adalah JPG, JPEG, atau PNG')
                    return;
                }

                if (valisiBerita == '') {
                    dangerAlert('Langkah - langkah tidak boleh kosong')
                    return;
                }

                this.submit();
            })



            $('#form-edit').on('submit',function(e) {
                e.preventDefault();
                let valisiBerita = tinymce.get('edit-deskripsi').getContent();
                
                const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

                if(input_edit_image.files[0] && !allowedExtensions.exec(input_edit_image.files[0].name)){
                    error('Tipe file yang diperbolehkan adalah JPG, JPEG, atau PNG')
                    return;
                }

                if (valisiBerita == '') {
                    error('Isi berita tidak boleh kosong')
                    return;
                }

                this.submit();
            })

            @if(session('success'))
                success_message = @json(session('success'));
                successAlert(success_message);
            @endif
        });

    </script>
@endpush
