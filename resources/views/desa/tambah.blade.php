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
                    <strong style="color:white">Tambah Desa</strong>
                    <a href="/admin/desa" class="btn btn-sm btn-info">
                        <i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/admin/desa/tambah" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="namadesa" class="col-sm-2 col-form-label">Nama desa</label>
                            <input type="text" name="namadesa" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="id_kecamatan" class="col-sm-2 col-form-label">Nama Kecamatan</label>
                            <select name="id_kecamatan" class="form-control" required>
                                <option value="">--Pilih Kecamatan--</option>
                                @foreach ($kecamatan as $kec)
                                    <option value="{{ $kec->id }}">{{ $kec->namakecamatan }}</option>
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

