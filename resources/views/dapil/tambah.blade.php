@extends('admindashboard.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between bg-info">
                    <strong style="color:white">Tambah Dapil</strong>
                    <a href="/admin/dapil" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/admin/dapil/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="id_kandidat" class="col-sm-2 col-form-label">Nama Kandidat</label>
                            <select name="id_kandidat" class="form-control" required>
                                <option value="" disabled>--Pilih Kandidat--</option>
                                @foreach ($kandidat as $kandidat)
                                    <option value="{{ $kandidat->id }}">{{ $kandidat->namakandidat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="options">Pilih Jenis:</label>
                            
                                <select id="options" onchange="showTextBoxes()" class="form-control" name="jeniskandidat">
                                    <option value="" disabled>Pilih...</option>
                                    <option value="pilkab">Pemilihan Walikota/Bupati</option>
                                    <option value="pilgub">Pemilihan Gubernur</option>
                                </select>
                        </div>

                        <div class="form-group" id="pilih-kabupaten">
                            <label for="id_kabupaten" class="col-sm-2 col-form-label">Nama Kabupaten</label>
                            <select name="id_kabupaten" id="id_kabupaten" class="form-control">
                                <option value="0">--Pilih Kabupaten--</option>
                                @foreach ($kabupaten as $kabupaten)
                                    <option value="{{ $kabupaten->id }}">{{ $kabupaten->namakabupaten }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group" id="pilih-provinsi" style="display: none;">
                            <label for="id_provinsi" class="col-sm-2 col-form-label">Nama Provinsi</label>
                            <select name="id_provinsi" id="id_provinsi" class="form-control">
                                <option value="0">--Pilih provinsi--</option>
                                @foreach ($provinsi as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->namaprovinsi }}</option>
                                @endforeach
                            </select>
                        </div>

<!--                         
                        <div class="form-group">
                            <label for="customer" class="col-sm-2 col-form-label">Customer</label>
                            <select name="customer" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <option value="Bukan Customer">Bukan Customer</option>
                                <option value="Customer">Customer</option>
                            </select>
                        </div> -->


                        <button class="btn btn-info">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTextBoxes() {
    console.log('kucing');
        // Mendapatkan nilai dari elemen select
        var selectedOption = document.getElementById("options").value;

        // Menampilkan atau menyembunyikan textbox sesuai dengan pilihan
        if (selectedOption === "pilgub") {
            document.getElementById("pilih-kabupaten").style.display = "none";
            document.getElementById("pilih-provinsi").style.display = "block";
            document.getElementById("id_kabupaten").val('');
        } else if (selectedOption === "pilkab") {
            document.getElementById("pilih-kabupaten").style.display = "block";
            document.getElementById("pilih-provinsi").style.display = "none";
            document.getElementById("id_provinsi").val('');
        }
    }
    </script>
@endsection