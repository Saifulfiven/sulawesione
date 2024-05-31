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
                    <strong style="color:white">Ubah kabupaten</strong>
                    <a href="/admin/kabupaten" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="card-body">

                    <form action="/admin/kabupaten/update" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="form-group">
                            <label for="namakabupaten" class="col-sm-2 col-form-label">Nama Kabupaten</label>
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $dataubah->id ?>">
                            <input type="text" name="namakabupaten" class="form-control"  value="<?php echo $dataubah->namakabupaten ?>">
                        </div>

                        <?php 
                           // $selectedidkandidat = $dataubah->id_kandidat; 
                            $selectedidkandidat = $dataubah->id_kandidat;    
                            $selectedidkabupaten = $dataubah->id_kabupaten;    
                        ?>
                        
                        <div class="form-group">
                            <label for="id_kandidat" class="col-sm-2 col-form-label">Nama kandidat</label>
                            <select name="id_kandidat" class="form-control" required>
                                <option value="" disabled>--Pilih kandidat--</option>
                                @foreach ($kandidat as $kandidat)
                                <option value="{{ $kandidat->id }}" {{ $kandidat->id == $selectedidkandidat ? 'selected' : '' }}>{{ $kandidat->namakandidat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_kabupaten" class="col-sm-2 col-form-label">Nama kabupaten</label>
                            <select name="id_kabupaten" class="form-control" required>
                                <option value="" disabled>--Pilih kabupaten--</option>
                                @foreach ($kabupaten as $kab)
                                <option value="{{ $kab->id }}" {{ $kab->id == $selectedidkabupaten ? 'selected' : '' }}>{{ $kab->namakabupaten }}</option>
                            
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- <div class="form-group">
                            <label for="id_provinsi" class="col-sm-2 col-form-label">Nama Provinsi</label>
                            <select name="id_propinsi" class="form-control" required>
                                <option value="" disabled>--Pilih Provinsi--</option>
                                @foreach ($provinsi as $prov)
                                <option value="{{ $prov->id }}" {{ $prov->id == $selectedidprovinsi ? 'selected' : '' }}>{{ $prov->namaprovinsi }}</option>
                            
                                @endforeach
                            </select>
                        </div> -->

                        <div class="form-group">
                            <div class="col-sm-2">
                                <button class="btn btn-info">Ubah</button>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection


