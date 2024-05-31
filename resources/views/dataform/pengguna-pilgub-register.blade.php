@extends('landingpage.layout')

@section('content')
<script>
    function showTextBoxes() {
        // Mendapatkan nilai dari elemen select
        var selectedOption = document.getElementById("options").value;

        // Menampilkan atau menyembunyikan textbox sesuai dengan pilihan
        if (selectedOption === "A") {
            document.getElementById("foto").style.display = "block";
        } else if (selectedOption === "B") {
            document.getElementById("foto").style.display = "none";
        }
    }
</script>


<div class="container">
    
 <br><br>
 <br><br>
    <div class="row">
       
            <div class="col-lg-12">

<a class="back-link btn btn-primary" href="javascript:history.back()"><i class="fas fa-arrow-left"></i> Kembali</a>
            <br><br>
            <form action="{{ url('dataform/pengguna-register') }}" method="post"
            class="form-horizontal"  
            style="background-image: url('/img/bg-form.jpg'); background-repeat: repeat; padding: 50px; border: 1px solid #F2D768; border-radius: 5px;"
            enctype="multipart/form-data"> 
                @csrf
                <div class="col-lg-6 mx-auto">
                
                <h3>Form Data Tim Anggota Survey {{ $jeniskandidat }}</h3>
                <div class="form-group">
                    <label for="options">Pilih opsi:</label>
                    
                        <select id="options" onchange="showTextBoxes()" class="form-control" name="jenistim">
                            <option value="" disabled>Pilih...</option>
                            <option value="A">Tim Inti</option>
                            <option value="B">Form Pendukung</option>
                        </select>
                    
                </div>

                <input type="hidden" name="id_dapil" class="form-control" value="{{ $datadapils->id }}">
                <input type="hidden" name="id_provinsi" class="form-control" value="{{ $datadapils->id_provinsi }}">

                <div id="email" class="form-group">
                    <label for="email">Email:</label>
                        <input type="text" id="email" name="email" class="form-control" required>
                </div>

                <div id="password" class="form-group">
                    <label for="password">Password:</label>
                        <input type="text" id="password" name="password" class="form-control" required>
                </div>
                
                <div id="nama" class="form-group">
                    <label for="textbox1">Nama:</label>
                    
                        <input type="text" id="textbox1" name="nama" class="form-control">
                    
                </div>

                <div id="ktp" class="form-group">
                    <label for="textbox2">Nomor KTP:</label>
                    
                        <input type="text" id="textbox2" name="ktp" class="form-control">
                    
                </div>

                @include('master.wilayah')

                
                <div id="desa" class="form-group">
                    <label for="desa">Desa:</label>
                    
                        <input type="text" id="desaa" name="desa" class="form-control">
                    
                </div>
                
                <div id="kontak" class="form-group">
                    <label for="textbox6">No Telp/WA:</label>
                    
                        <input type="text" id="textbox6" name="kontak" class="form-control">
                    
                </div>

                <div id="foto" class="form-group">
                    <label for="textbox7">Foto Selfie Camera depan rumah:</label>
                        <input type="file" id="textbox7" name="foto" class="form-control">
                </div>

            </div><!-- Penutup Textbox -->

                <div class="col-lg-6 mx-auto">
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>

            </form>

            </div>
    </div>
</div>
             
             
@endsection