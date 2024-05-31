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
                    <strong>Ubah Acara</strong>
                    <a href="/admin/acara" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>


                <div class="card-header  pull-left">Ubah Acara</div>
                <div class="text-left mb-3 mt-2">
                    <a href="{{ url()->previous() }}" class="pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="card-body">

                    <form action="/admin/acara/update" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                            
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $dataubah->id ?>">
                            <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $dataubah->judul ?>">
                            
                        </div>

                        <div class="form-group">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                            
                                <textarea class="form-control" name="deskripsi" id="deskripsi"s="3"><?php echo $dataubah->deskripsi ?></textarea>
                            
                        </div>

                        <div class="form-group">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?php echo $dataubah->tanggal ?>">
                            
                        </div>

                        <div class="form-group">
                            <label for="jam" class="col-sm-2 col-form-label">Jam</label>
                            
                                <input type="time" class="form-control" name="jam" id="jam" value="<?php echo $dataubah->jam ?>">
                            
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="linksatu" class="col-sm-2 col-form-label">Link 1</label>
                            
                                <input type="text" class="form-control" name="linksatu" id="linksatu" value="<?php echo $dataubah->linksatu ?>">
                            
                        </div>

                        <div class="form-group">
                            <label for="judullinksatu" class="col-sm-2 col-form-label">Tipe 1</label>
                            
                                <select name="judullinksatu" id="judullinksatu" class="form-control">
                                    <option value="">- Pilih Tipe -</option>
                                    <option value="instagram" <?php if($dataubah->judullinksatu=='instagram'){ echo 'selected'; } ?>>Instagram</option>
                                    <option value="facebook" <?php if($dataubah->judullinksatu=='facebook'){ echo 'selected'; } ?>>Facebook</option>
                                    <option value="zoom" <?php if($dataubah->judullinksatu=='zoom'){ echo 'selected'; } ?>>Zoom</option>
                                    <option value="zoom" <?php if($dataubah->judullinksatu=='link_website'){ echo 'selected'; } ?>>Link Website</option>
                                    <option value="googlemap" <?php if($dataubah->judullinksatu=='googlemap'){ echo 'selected'; } ?>>Google Map</option>
                                </select>
                            
                        </div>

                        
                        <div class="form-group">
                            <label for="linkdua" class="col-sm-2 col-form-label">Link 2</label>
                            
                                <input type="text" class="form-control" name="linkdua" id="linkdua" value="<?php echo $dataubah->linkdua ?>">
                            
                        </div>

                        <div class="form-group">
                            <label for="judullinkdua" class="col-sm-2 col-form-label">Tipe 2</label>
                            
                                <select name="judullinkdua" id="judullinkdua" class="form-control">
                                    <option value="">- Pilih Tipe -</option>
                                    <option value="instagram" <?php if($dataubah->judullinkdua=='instagram'){ echo 'selected'; } ?>>Instagram</option>
                                    <option value="facebook" <?php if($dataubah->judullinkdua=='facebook'){ echo 'selected'; } ?>>Facebook</option>
                                    <option value="zoom" <?php if($dataubah->judullinkdua=='zoom'){ echo 'selected'; } ?>>Zoom</option>
                                    <option value="zoom" <?php if($dataubah->judullinkdua=='link_website'){ echo 'selected'; } ?>>Link Website</option>
                                    <option value="googlemap" <?php if($dataubah->judullinkdua=='googlemap'){ echo 'selected'; } ?>>Google Map</option>
                                </select>
                            
                        </div>
                        </div>
                    </div>


                        <div class="form-group">
                            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                            
                                <input type="file" class="form-control" name="gambar" id="gambar">
                                <input type="hidden" name="gambar_lama" value="<?php echo $dataubah->gambar ?>">
                           
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


