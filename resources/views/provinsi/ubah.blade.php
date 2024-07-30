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
            <div class="card-header d-flex justify-content-between bg-primary text-white">
                    <strong>Ubah Provinsi</strong>
                    <a href="/admin/provinsi" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="card-body">

                    <form action="/admin/provinsi/update" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul" class="col-sm-4 col-form-label">Nama Provinsi</label>
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $dataubah->id ?>">
                            <input type="text" class="form-control" name="name" id="namaprovinsi" value="<?php echo $dataubah->name ?>">
                        </div>

                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" value="<?php echo $dataubah->slug ?>">
                        </div>

                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" <?php if ($dataubah->status == 1) {
                                                        echo "selected";
                                                    } ?>>Aktif</option>
                                <option value="0" <?php if ($dataubah->status == 0) {
                                                        echo "selected";
                                                    } ?>>Tidak Aktif</option>
                            </select>
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


