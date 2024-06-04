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
                    <strong style="color:white">Ubah Provinsi</strong>
                    <a href="/admin/provinsi" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>


                <div class="card-header  pull-left">Ubah Provinsi</div>
                <div class="text-left mb-3 mt-2">
                    <a href="{{ url()->previous() }}" class="pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="card-body">

                    <form action="/admin/provinsi/update" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Nama Kecamatan</label>
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $dataubah->id ?>">
                            <input type="text" class="form-control" name="namakecamatan" id="namakecamatan" value="<?php echo $dataubah->namakecamatan ?>">
                        </div>

                            <div class="form-group">
                                <label for="judul" class="col-sm-2 col-form-label">Nama Kecamatan</label>
                                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $dataubah->id ?>">
                                <input type="text" class="form-control" name="namakecamatan" id="namakecamatan" value="<?php echo $dataubah->namakecamatan ?>">
                            </div>

                        <div class="form-group">
                                <button type="submit" name="ubah" class="btn btn-info">Ubah</button>
                        </div>

                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection


