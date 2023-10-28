@extends('layout.admin.index')

@section('title','Berita')

@section('news-active','active')

@push('additional-link')
      
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endpush


@section('content')
    
<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="text-gray-800 mb-4">Berita</h1>
    <h6 class="mb-4">Mengelola berita terbaru seputar pertanian</h6>
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
                            <th>Judul</th>
                            <th>Tanggal Posting</th>
                            <th style="width: 10rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-capitalize"> {{$item->judul}}</td>
                                <td>{{ $item->tanggal_posting }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info shadow-none" data-toggle="modal"
                                        data-target="#viewModal" data-bs-id="{{ $item->id_berita }}" data-bs-img="{{ route('news.image',['name' => $item->thumbnail]) }}"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-warning shadow-none" data-toggle="modal"
                                        data-target="#editModal" data-bs-id="{{ $item->id_berita }}" data-bs-img="{{ $item->thumbnail }}" data-bs-path="{{ route('news.update', $item->id_berita) }}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger shadow-none" data-toggle="modal"
                                        data-target="#hapusModal" data-bs-path="{{ route('news.destroy', $item->id_berita) }}"><i class="fas fa-trash"></i></button>
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
    
<!-- View berita -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Preview Berita</h3>
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
                    <img src="" alt="" class="img-fluid w-50 d-block mx-auto mb-3">
                    <p id="view_isi_berita"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah berita -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Tambah Berita</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data" id="form-tambah">
                <div class="modal-body">
                @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Judul Berita</span>
                        </div>
                        <input type="text" name="title" class="form-control shadow-none">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tanggal Posting</span>
                        </div>
                        <input type="date" name="tanggal" class="form-control shadow-none">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Gambar Thumbnail</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="thumbnail" class="custom-file-input shadow-none"
                                accept=".jpg,.jpeg,.png">
                            <label class="custom-file-label shadow-none" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi Berita</label>
                        <textarea name="deskripsi" id="tambah-deskripsi"></textarea>
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

<!-- Edit berita -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Edit Berita</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="form-edit">
                @csrf
                @method('put')
                <div class="modal-body">
                    <input type="hidden" name="old_thumbnail" >
                    <input type="hidden" name="id" >
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Judul Berita</span>
                        </div>
                        <input type="text" name="title" class="form-control shadow-none" autocomplete="country-name"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tanggal Posting</span>
                        </div>
                        <input type="date" name="tanggal" class="form-control shadow-none" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Gambar Thumbnail</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="thumbnail" class="custom-file-input shadow-none"
                                accept=".jpg,.jpeg,.png">
                            <label class="custom-file-label shadow-none" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi Berita</label>
                        <textarea name="deskripsi" id="edit-deskripsi"></textarea>
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

<!-- Hapus berita -->
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
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
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
                    plugins: [
                        'advlist', 'autolink','lists', 'link', 'charmap', 'preview', 'anchor', 'searchreplace',
                        'visualblocks', 'fullscreen', 'insertdatetime', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
                });
            }
            tinyInit('#tambah-deskripsi');
            tinyInit('#edit-deskripsi');
            $('#formtiny').submit(function (e) {
                e.preventDefault();
                console.log('ok');
                const content = tinymce.get('tiny').getContent();
                if (content.trim() === '') {
                    alert('Input field tidak boleh kosong.');
                } else {
                    // Jika validasi berhasil, lanjutkan dengan pengiriman formulir secara program
                    this.submit(); // Mengirimkan formulir
                }
            })

            $('#viewModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                let thumbnail = button.getAttribute('data-bs-img');
                $("#viewModal img").attr('src',thumbnail);
                let data = @json($data);
                data.forEach(element => {
                    if (element.id_berita == id) {
                        var dateObj = new Date(element.tanggal_posting);
                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                        var new_date = dateObj.toLocaleDateString('id-ID', options);

                        $("#viewModal #view_judul").html(element.judul)
                        $("#viewModal #view_tanggal").html(new_date)
                        
                        $("#viewModal #view_isi_berita").html(element.isi_berita)
                        return;
                    }
                });
            })


            $('#editModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                let thumbnail = button.getAttribute('data-bs-img');
                let path = button.getAttribute('data-bs-path');
                $("#editModal input[name='old_thumbnail']").val(thumbnail);
                $("#editModal input[name='id']").val(id);
                let data = @json($data);
                data.forEach(element => {
                    if (element.id_berita == id) {
                        $("#editModal input[name='title']").val(element.judul)
                        $("#editModal input[name='tanggal']").val(element.tanggal_posting)
                        tinymce.get('edit-deskripsi').setContent(element.isi_berita);
                        return;
                    }
                });
                $('#form-edit').attr('action',path);
            })

            $('#hapusModal').on('show.bs.modal',function (e) {
                let button = e.relatedTarget;
                let path = button.getAttribute('data-bs-path');
                $('#form-delete').attr('action',path);
            })

            
            //Event Submit Form

            $('#form-tambah').on('submit',function(e) {
                e.preventDefault();
                let valjudul = $('#tambahModal input[name="title"]').val();
                let valtanggal = $('#tambahModal input[name="tanggal"]').val();
                let valisiBerita = tinymce.get('tambah-deskripsi').getContent();
                
                const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (valjudul == '') {
                    error('Judul berita tidak boleh kosong')
                    return;
                }
                if (valtanggal == '') {
                    error('Tanggal posting tidak boleh kosong')
                    return;
                }

                if (!input_tambah_image.files[0]) {
                    error('Gambar Thumbnail tidak boleh kosong');
                    return;
                }

                if(input_tambah_image.files[0] && !allowedExtensions.exec(input_tambah_image.files[0].name)){
                    error('Tipe file yang diperbolehkan adalah JPG, JPEG, atau PNG')
                    return;
                }

                if (valisiBerita == '') {
                    error('Isi berita tidak boleh kosong')
                    return;
                }

                this.submit();
            })



            $('#form-edit').on('submit',function(e) {
                e.preventDefault();
                // console.log('ok');
                let valjudul = $('#editModal input[name="title"]').val();
                let valtanggal = $('#editModal input[name="tanggal"]').val();
                let valisiBerita = tinymce.get('edit-deskripsi').getContent();
                
                const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (valjudul == '') {
                    error('Judul berita tidak boleh kosong')
                    return;
                }
                if (valtanggal == '') {
                    error('Tanggal posting tidak boleh kosong')
                    return;
                }

                if(input_edit_image.files[0] && !allowedExtensions.exec(input_edit_image.files[0].name)){
                    error('Tipe file yang diperbolehkan adalah JPG, JPEG, atau PNG')
                    return;
                }

                if (valisiBerita == '') {
                    error('Isi berita tidak boleh kosong')
                    return;
                }

                if (input_tambah_image.files[0]  ) {
                    if (input_edit_image.files[0].name != '') {
                        
                    }
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
