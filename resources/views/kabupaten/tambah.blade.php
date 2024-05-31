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
                    <strong style="color:white">Tambah Kabupaten</strong>
                    <a href="/admin/kabupaten" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/admin/kabupaten/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Nama Kabupaten</label>
                            <input type="text" name="namakabupaten" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="id_provinsi" class="col-sm-2 col-form-label">Nama Provinsi</label>
                            <select name="id_propinsi" class="form-control" required>
                                <option value="" disabled>--Pilih Provinsi--</option>
                                @foreach ($provinsi as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->namaprovinsi }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button class="btn btn-info">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

