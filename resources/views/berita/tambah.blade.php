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
                    <strong>Tambah Berita</strong>
                    <a href="/admin/berita" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/admin/berita/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>

                        <button class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

