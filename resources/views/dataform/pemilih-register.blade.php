@extends('landingpage.layout')

@section('content')
<div class="container">
    
    <br><br>
    <div class="row">
       
            <div class="col-lg-12">

            <a class="back-link btn btn-primary" href="javascript:history.back()"><i class="fas fa-arrow-left"></i> Kembali</a>
            <br><br>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('dtd') }}" method="post" class="form-horizontal"  style="background-image: url('/img/bg-form.jpg'); background-repeat: repeat; padding: 50px; border: 1px solid #F2D768; border-radius: 5px;">
                
                @csrf

                <div class="col-lg-6 mx-auto">
                
                <h3>Survey Data {{ $jeniskandidatx }}</h3>
                <span>Jenis Pemilihan : {{ $dapatkandapil->jeniskandidat }}</span>

                <div id="nama" class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="hidden" name="id_dapil" value="{{ $dapatkandapil->id_dapil }}">
                    <input type="text" id="nama" name="nama" class="form-control">
                    
                </div>

                @include('master.wilayah')

                <div id="desa" class="form-group">
                    <label for="kontak">Desa</label>
                        <input type="text" id="desa" name="desa" class="form-control">
                </div>

                
                <div id="kontak" class="form-group">
                    <label for="kontak">No Telp/WA:</label>
                        <input type="text" id="kontak" name="kontak" class="form-control">
                </div>

                <div class="form-group">
                    <label for="options">Jenis Pilihan:</label>
                    
                        <select id="jenispilihan" name="jenispilihan" class="form-control">
                            <option value="" disabled>Pilih...</option>
                            <option value="1">1. Pemilih Lain tapi Setia</option>
                            <option value="2">2. Pemilih Lain tapi masih ragu</option>
                            <option value="3">3. Pemilih kita tapi pemilih biasa</option>
                            <option value="4">4. Pemilih Kita dan setia</option>
                        </select>
                    
                </div>

            </div><!-- Penutup Textbox -->

                <div class="col-lg-6 mx-auto">
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                    <!-- <div class="form-group">
                        <a href="/dataform/sukses" class="btn btn-primary">Kirim</a>
                    </div> -->
                </div>

            </form>


<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script>
$(document).ready(function(){
    $('#filter-provinsi').on('change', function(){
    let id_provinsi = $(this).val();
    if(id_provinsi){
        jQuery.ajax({
        url: '/admin/searchkabupaten',
        type: "post",
        data: { 
            _token: "{{ csrf_token() }}",
            id_provinsi: id_provinsi 
        },
        success: function(res){
            console.log(res);
            $('#filter-kabupaten').empty();
            $('#filter-kabupaten').append('<option value="" selected>Pilih Kabupaten</option>');
            res.forEach(function(objek, indeks) {
                console.log("Objek ke-" + (indeks + 1) + ":");
                console.log(objek.id);console.log(objek.namakabupaten);
                $('#filter-kabupaten').append('<option value="'+ objek.id +'">'+ objek.namakabupaten +'</option>');
            });
        }
        });
    }else{
        $('#filter-kabupaten').empty();
    }
    });
    $('#filter-kabupaten').on('change', function(){
    let id_kabupaten = $(this).val();
    if(id_kabupaten){
        jQuery.ajax({
        url: '/admin/searchkecamatan',
        type: "post",
        data: { 
            _token: "{{ csrf_token() }}",
            id_kabupaten: id_kabupaten 
        },
        success: function(res){
            console.log(res);
            $('#filter-kecamatan').empty();
            $('#filter-kecamatan').append('<option value="" selected>Pilih Kecamatan</option>');
            res.forEach(function(objek, indeks) {
            $('#filter-kecamatan').append('<option value="'+ objek.id +'">'+ objek.namakecamatan +'</option>');
            });
        }
        });
    }else{
        $('#filter-kecamatan').empty();
    }
    });
});
</script>

</div>
    </div>
</div>
             
             
@endsection