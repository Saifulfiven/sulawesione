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
                    <strong>Tambah Acara</strong>
                    <a href="/admin/acara" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/admin/acara/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                   <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Jam</label>
                            <input type="time" name="jam" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Link 1</label>
                            <input type="text" name="linksatu" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Tipe 1</label>
                            <select name="judullinksatu" class="form-control" required>
                                <option value="instagram">Instagram</option>
                                <option value="facebook">Facebook</option>
                                <option value="zoom">Zoom</option>
                                <option value="link_website">Link Website</option>
                                <option value="google_map">Google Map</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Link 2</label>
                            <input type="text" name="linkdua" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Tipe 2</label>
                            <select name="judullinkdua" class="form-control" required>
                                <option value="instagram">Instagram</option>
                                <option value="facebook">Facebook</option>
                                <option value="zoom">Zoom</option>
                                <option value="link_website">Link Website</option>
                                <option value="google_map">Google Map</option>
                            </select>
                        </div>
                    </div>
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

