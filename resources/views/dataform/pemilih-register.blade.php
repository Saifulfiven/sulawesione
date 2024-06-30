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

                <h3> Door to Door  {{ $jeniskandidatx }} </h3>

                @if(session('jeniskandidat') == 'pilgub')                
                    <h6>Calon Gubernur  Provinsi {{ $datadapils->namaprovinsi }}</h6>
                    <h6>{{ $datadapils->namakabupaten }}</h6>
                @else
                    <h6>Calon Bupati {{ $datadapils->namakabupaten }}</h6>
                @endif
                <br>

                <div id="nama" class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="hidden" name="id_dapil" value="{{ $datadapils->id_dapil }}">
                    <input type="hidden" name="provinsi" value="{{ $datadapils->id_provinsi }}">
                    <input type="hidden" name="kabupaten" value="{{ $datadapils->id_kabupaten }}">
                    <input type="text" id="nama" name="nama" class="form-control">

                </div>

                @if(session('jeniskandidat') == 'pilgub')
                    @include('master.wilayah-pilgub-pendukung')
                @else
                    @include('master.wilayah-pilkab')
                @endif

                <div id="desa" class="form-group">
                    <label for="kontak">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control">
                </div>


                <div id="kontak" class="form-group">
                    <label for="kontak">No Telp/WA:</label>
                        <input type="text" id="kontak" name="kontak" class="form-control">
                </div>

                <div class="form-group">
                    <label for="options">Jenis Pilihan:</label>

                        <select id="jenispilihan" name="jenispilihan" class="form-control">
                            <option value="" disabled>Pilih...</option>
                            <option value="1">1. Memilih calon lain dan bersedia menjadi relawan tim sukses calon lain itu.</option>
                            <option value="2">2. Memilih calon lain tapi tidak bersedia menjadi relawan tim sukses calon lain itu.</option>
                            <option value="3">3. Tidak tahu memilih siapa, belum memutuskan, atau merahasiakan pilihan.</option>
                            <option value="4">4. Memilih  tapi tidak bersedia jadi relawan tim sukses.</option>
                            <option value="5">5. Memilih  dan bersedia jadi relawan tim sukses.</option>
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
