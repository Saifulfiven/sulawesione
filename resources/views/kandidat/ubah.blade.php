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
                    <strong style="color:white">Ubah kandidat</strong>
                    <a href="/admin/kandidat" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="card-body">

                    <form action="/admin/kandidat/update" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="namakandidat" class="col-sm-2 col-form-label">Nama Kandidat</label>
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $dataubah->id ?>">
                            <input type="text" class="form-control" name="namakandidat" id="namakandidat" value="<?php echo $dataubah->namakandidat ?>">
                        </div>

                        <div class="form-group">
                            <label for="foto" class="col-sm-2 col-form-label">Foto Kandidat</label>
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


