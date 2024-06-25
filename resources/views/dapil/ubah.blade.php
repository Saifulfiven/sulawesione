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
                    <strong style="color:white">Ubah Setting Dapil</strong>
                    <a href="/admin/dapil" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="card-body">
                    <form action="/admin/dapil/update" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $dapils->id }}">
                        <div class="form-group">
                            <label for="id_kandidat">Nama Kandidat</label>
                            <select name="id_kandidat" id="id_kandidat" class="form-control">
                                @foreach ($kandidat as $kand)
                                <option value="{{ $kand->id }}" {{ $kand->id == $dapils->id_kandidat ? 'selected' : '' }}>{{ $kand->namakandidat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jeniskandidat">Jenis Kandidat</label>
                            <select name="jeniskandidat" id="jeniskandidat" class="form-control" onchange="showTextBoxes()">
                                <option value="pilgub" {{ $dapils->jeniskandidat == 'pilgub' ? 'selected' : '' }}>Pilgub</option>
                                <option value="pilkab" {{ $dapils->jeniskandidat == 'pilkab' ? 'selected' : '' }}>Pilkab</option>
                            </select>
                        </div>
                        <div id="pilih-provinsi" style="display: {{ $dapils->jeniskandidat == 'pilgub' ? 'block' : 'none' }}">
                            <div class="form-group">
                                <label for="id_provinsi">Nama Provinsi</label>
                                <select name="id_provinsi" id="id_provinsi" class="form-control">
                                    @foreach ($provinsi as $prov)
                                    <option value="{{ $prov->id }}" {{ $prov->id == $dapils->id_provinsi ? 'selected' : '' }}>{{ $prov->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="pilih-pilkab" style="display: {{ $dapils->jeniskandidat == 'pilkab' ? 'block' : 'none' }}">
                            <div class="form-group">
                                <label for="id_kabupaten">Nama Kabupaten/Kota</label>
                                <select name="id_kabupaten" id="id_kabupaten" class="form-control">
                                    @foreach ($kabupaten as $kab)
                                    <option value="{{ $kab->id }}" {{ $kab->id == $dapils->id_kabupaten ? 'selected' : '' }}>{{ $kab->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ $dapils->username }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    function showTextBoxes() {
        // Mendapatkan nilai dari elemen select
        var selectedOption = document.getElementById("options").value;

        // Menampilkan atau menyembunyikan textbox sesuai dengan pilihan
        if (selectedOption === "pilgub") {
            document.getElementById("pilih-kabupaten").style.display = "none";
            document.getElementById("pilih-provinsi").style.display = "block";
            document.getElementById("id_kabupaten").val('');
        } else if (selectedOption === "pilkab") {
            document.getElementById("pilih-kabupaten").style.display = "block";
            document.getElementById("pilih-provinsi").style.display = "none";
            document.getElementById("id_provinsi").val('');
        }
    }
</script>
