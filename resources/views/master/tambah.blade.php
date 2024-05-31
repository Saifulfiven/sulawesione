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
                    <strong>Tambah Pengalaman</strong>
                    <a href="/admin/pengalaman" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/admin/pengalaman/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="programstudi" class="col-sm-2 col-form-label">Program Studi</label>
                            <input type="text" name="programstudi" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                            <input type="text" name="angkatan" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="detail" class="col-sm-2 col-form-label">Deskripsi</label>
                            <textarea name="detail" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>

                        <button class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

