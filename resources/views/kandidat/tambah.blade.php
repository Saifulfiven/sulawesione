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
                    <strong style="color:white">Tambah Kandidat</strong>
                    <a href="/admin/kandidat" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/admin/kandidat/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="namakandidat" class="col-sm-2 col-form-label">Nama Kandidat</label>
                            <input type="text" name="namakandidat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>

                        <button class="btn btn-info">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

