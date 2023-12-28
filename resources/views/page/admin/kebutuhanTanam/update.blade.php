@extends('layout.admin.index')

@section('title','Kebutuhan Tanam')

@push('additional-link')
      
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    #hapus-bahan:hover {
        cursor: pointer;
    }
</style>
@endpush


@section('content')
    
<!-- Begin Page Content -->
<div class="container-fluid" style="min-height: 70vh">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kebutuhantanam.index') }}">Kebutuhan Tanam</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <!-- Content Row -->
    <form action="{{ route('kebutuhantanam.update',$tanamanById->id_tanaman) }}" method="POST">
        @method('PUT')
        @csrf
    <div class="card border-left-success text-dark shadow h-100 p-4">
        <div class="card-header py-3 bg-white">
            <div class="row justify-content-between align-items-center">
                <div class="col-10">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group row no-gutters text-center">
                                <label for="inputEmail3" class="col-sm-6 col-form-label">Min Luas Tanah(m<sup>2</sup>)</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control shadow-none" min="1" name="luas" value="{{ $MinLuas }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group row no-gutters text-right">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Tanaman</label>
                                <div class="col-sm-6 ml-2">
                                    <select name="jenis_tanaman" class="form-control shadow-none" required>
                                        @foreach ($dataTanaman as $item)
                                        <option value="{{ $item->id_tanaman }}"> {{ $item->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-sm border-none text-primary shadow-none" id="tambah-bahan"><i
                            class="bi bi-plus-lg mr-1"></i>Tambah bahan</button>
                </div>
            </div>
        </div>
        <div class="card-body text-dark">
            <div class="container" id="list-bahan">
                @foreach ($listBahan as $index => $row)
                <div class="row align-items-center mb-3" id="bahan">
                    <input type="hidden" name="id[]" value="{{ $row->id }}">
                    <i class="fas fa-minus fa-sm mr-4 mt-4" id="hapus-bahan"></i>
                    <div class="col">
                        <label>Nama Bahan/Peralatan</label>
                        <select name="bahan[]" id="selectbahan{{$index+1}}"  class="form-control shadow-none" required>
                            <option value=""></option>
                            @foreach ($dataBahan as $item)
                            <option value="{{ $item->id_kebutuhan }}" {{ $item->id_kebutuhan == $row->id_kebutuhan ? "selected" : '' }}> {{ $item->nama }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Jumlah (total kg/satuan)</label>
                        <input type="number" class="form-control shadow-none" name="jumlah[]" value="{{ $row->jumlah }}" required>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="border border-1 mt-5" style="width: fit-content; margin-left: auto">
                <button type="submit" class="btn btn-secondary" >Simpan</button>
            </div>
        </div>
    </div>
    </form>
</div>
<!-- /.container-fluid -->

@endsection


@push('additional-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // $('#dataTable').DataTable();
            $('select[name="jenis_tanaman"]').val("{{$tanamanById->id_tanaman}}");
            let x = {{$jumBahan}};
            for (let index = 1; index <= x; index++) {
                $(`#selectbahan${index}`).select2({
                    placeholder: "Pilih Bahan/Peralatan"
                });
            }
            $('#tambah-bahan').on('click', function(params) {
                x++;
                $('#list-bahan').append(`
                <div class="row align-items-center mb-3" id="bahan">
                    <i class="fas fa-minus fa-sm mr-4 mt-4" id="hapus-bahan"></i>
                    <div class="col">
                        <label>Nama Bahan/Peralatan</label>
                        <select name="new_bahan[]" id="selectbahan${x}" class="form-control shadow-none" required>
                            <option value=""></option>
                            @foreach ($dataBahan as $item)
                            <option value="{{ $item->id_kebutuhan }}"> {{ $item->nama }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Jumlah (total kg/satuan)</label>
                        <input type="number" class="form-control shadow-none" name="new_jumlah[]" required>
                    </div>
                </div>`)
                $(`#selectbahan${x}`).select2({
                    placeholder: "Pilih Bahan/Peralatan"
                });
            });
            let list_bahan = document.querySelector('#list-bahan');
            list_bahan.addEventListener('click',function (e) {
                let total_bahan = document.querySelectorAll('#bahan');
                console.log(e.target.previousElementSibling);
                if (e.target.id == 'hapus-bahan') {
                    let bahan = e.target.parentNode;
                    if (total_bahan.length > 2) {
                        bahan.remove();
                    }else {
                        alert('Minimal Terdapat 2 Bahan Untuk Menanam')
                    } 
                }

                if (e.target.previousElementSibling != null) {
                    let input = document.createElement('input');
                    let parent = document.querySelector('#list-bahan');
                    input.setAttribute('type','hidden');
                    input.setAttribute('name','delete_bahan[]');
                    input.setAttribute('value', e.target.previousElementSibling.value);
                    parent.append(input);
                }

            })

            @error('luas')
                danger_message = @json($message);
                dangerAlert(danger_message)
            @enderror
            
            @error('jenis_tanaman')
                danger_message = @json($message);
                dangerAlert(danger_message)
            @enderror
            
            @error('bahan')
                danger_message = @json($message);
                dangerAlert(danger_message)
            @enderror
            
            @error('jumlah')
                danger_message = @json($message);
                dangerAlert(danger_message)
            @enderror

            @if(session('success'))
                success_message = @json(session('success'));
                successAlert(success_message);
            @endif
        });

    </script>
@endpush
