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
                            <label for="judul" class="col-sm-2 col-form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $dataubah->nama ?>">
                        </div>

                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Program Studi</label>
                            <input type="text" class="form-control" name="programstudi" id="programstudi" value="<?php echo $dataubah->programstudi ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Angkatan</label>
                            <input type="text" class="form-control" name="angkatan" id="angkatan" value="<?php echo $dataubah->angkatan ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?php echo $dataubah->jabatan ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Tempat Kerja</label>
                            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo $dataubah->pekerjaan ?>">
                        </div>

                        <div class="form-group">
                            <label for="detail" class="col-sm-2 col-form-label">Deskripsi</label>
                                <textarea class="form-control" name="detail" id="detail" rows="6"><?php echo $dataubah->detail ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                <input type="file" class="form-control" name="foto" id="foto">
                                <input type="hidden" name="foto_lama" value="<?php echo $dataubah->foto ?>">
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


