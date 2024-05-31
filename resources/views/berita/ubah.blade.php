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
            <div class="card-header d-flex justify-content-between">
                    <strong>Ubah Berita</strong>
                    <a href="/admin/berita" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>


                <div class="card-header  pull-left">Ubah berita</div>
                <div class="text-left mb-3 mt-2">
                    <a href="{{ url()->previous() }}" class="pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="card-body">

                    <form action="/admin/berita/update" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $dataubah->id ?>">
                            <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $dataubah->judul ?>">
                        </div>

                        <div class="form-group">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi"s="3"><?php echo $dataubah->deskripsi ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar" id="gambar">
                                <input type="hidden" name="gambar_lama" value="<?php echo $dataubah->gambar ?>">
                        </div>

                        <div class="form-group">
                                <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>                            
                        </div>

                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection


