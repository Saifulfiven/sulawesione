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
                <div class="card-header d-flex justify-content-between  bg-info">
                    <strong style="color:white">Tambah Provinsi</strong>
                    <a href="/admin/provinsi" class="btn btn-sm btn-info">
                        <i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/admin/provinsi/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="namaprovinsi" class="col-sm-2 col-form-label">Nama Provinsi</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" required>
                        </div>

                        <button class="btn btn-info">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

