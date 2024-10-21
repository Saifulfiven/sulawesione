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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('pendukung/pengguna-register') }}" method="post"
                      class="form-horizontal"
                      style="background-image: url('/img/bg-form.jpg'); background-repeat: repeat; padding: 50px; border: 1px solid #F2D768; border-radius: 5px;"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-6 mx-auto">

                        <h3>Pendukung Calon Gubernur Provinsi {{ $datadapils->namaprovinsi }}</h3>

                        <input type="hidden" name="id_dapil" class="form-control" value="{{ $datadapils->id_dapil }}">
                        <input type="hidden" name="provinsi" class="form-control" value="{{ $datadapils->id_provinsi }}">

                        <div id="nama" class="form-group">
                            <label for="textbox1">Nama:</label>

                            <input type="text" id="textbox1" name="nama" class="form-control" value="{{ old('nama', '') }}">

                        </div>

                        <div id="ktp" class="form-group">
                            <label for="textbox2">Nomor KTP:</label>

                            <input type="text" id="textbox2" name="ktp" class="form-control" value="{{ old('ktp', '') }}">

                        </div>

                        @include('master.wilayah-pilgub')


                        <div id="alamat" class="form-group">
                            <label for="alamat">Alamat:</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" value="{{ old('alamat') }}" placeholder="Jalan Paropo 3 No 2 RW 3">
                        </div>

                        <div class="form-group">
                            <label for="rt">RT <i>(Boleh Dikosongkan):</i></label>
                            <input type="text" class="form-control" id="rt" name="rt" value="{{ old('rt', '') }}">
                        </div>

                        <div class="form-group">
                            <label for="rw">RW <i>(Boleh Dikosongkan):</i></label>
                            <input type="text" class="form-control" id="rw" name="rw" value="{{ old('rw', '') }}">
                        </div>
                        

                        <div id="kontak" class="form-group">
                            <label for="textbox6">No Telp/WA: </label>
                            <input type="text" id="textbox6" name="kontak" class="form-control" value="{{ old('kontak', '') }}">
                        </div>

                        <div class="form-group" style="display: none;">
                            <select class="form-control" id="id_kandidat" name="id_kandidat">
                                @foreach ($tampilkankandidat as $kandidat)
                                    <option value="{{ $kandidat->id }}">{{ $kandidat->namakandidat }}</option>
                                @endforeach
                            </select>
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
