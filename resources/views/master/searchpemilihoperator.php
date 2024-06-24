 <form action="" method="get" class="row mt-3" id="form-cari" onsubmit="event.preventDefault(); searchData()">
    <div class="col-md-2">
      <select class="form-select" name="provinsi" id="filter-provinsi" aria-label="Default select example">
        <option value="" selected>Pilih Provinsi</option>
        @foreach ($provinsi as $item)
        <option value="{{ $item->id }}" {{ request()->get('provinces') == $item->id ? 'selected' : '' }}>{{ $item->namaprovinsi }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select" name="kabupaten" id="filter-kabupaten" aria-label="Default select example">
        <option value="" selected>Pilih Kabupaten</option>
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select" name="kecamatan" id="filter-kecamatan" aria-label="Default select example">
        <option value="" selected>Pilih Kecamatan</option>
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select" name="kandidat" id="filter-dapil" aria-label="Default select example">
        <option value="" selected>Pilih Nama Kandidat</option>
        @foreach ($dapils as $item)
        <option value="{{ $item->id }}" {{ request()->get('dapils') == $item->id ? 'selected' : '' }}>{{ $item->namakandidat }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-1">
      <button type="submit" class="btn btn-primary">Cari</button>
    </div>
  </form>

  <div class="row">
    <div class="col-lg-6 mb-lg-0 mb-4">
    <div class="card h-100">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex flex-column h-100">
                <h5 class="font-weight-bolder">Jumlah Suara </h5>
                <canvas id="barChart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-6">
      <div class="card h-100 p-3">
        <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('assetsadmin/img/ivancik.jpg') }}');">
          <span class="mask bg-gradient-dark"></span>
          <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3 text-white">
            <h5 class="text-white font-weight-bolder mb-4 pt-2">Suara Pemilih</h5>
            <table>
              <?php 
              $dataPemilihDapil = []; 
              foreach ($pemilihdapil as $data){
                echo "<tr><td>Nama Wilayah: $data->name </td><td> Jumlah Pemilih: $data->jumlah_pemilih</td></tr>";

                $dataPemilihDapil[] = ["namawilayah" => $data->name, "jumlah_pemilih" => $data->jumlah_pemilih];

              }

              ?>   
              </table>

          
          </div>
        </div>
      </div>
    </div>
  </div>

              <script>
              function searchData() {
                  $('#tblsearchpemilih').empty();

                let province = $('#filter-provinsi').val();
                let district = $('#filter-kabupaten').val();
                let subDistrict = $('#filter-kecamatan').val();
                let candidate = $('#filter-dapil').val();
                //let url = `{{ url('admin/master/pemilih?provinsi=') }}${province}&kabupaten=${district}&kecamatan=${subDistrict}&kandidat=${candidate}`;
                $.ajax(
                  {
                    url: '/admin/searchpemilihgub',
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_provinsi: province,
                        id_kabupaten: district,
                        id_kecamatan: subDistrict,
                        id_kandidat: candidate,
                    },
                  success: function(response) {
                    console.log(response);
                    let no = 1;
                    response.forEach(function(objek, indeks) {
                          $('#tblsearchpemilih').append('<tr>'+'<td>'+ no++ +'</td><td>'+ objek.nama +'</td>'+'<td>'+ objek.kontak +'</td>'+'<td>'
                              + objek.jenispilihan +'</td>'+'<td>'+ objek.namakandidat +'</td>'+'<td>'+ objek.namaprovinsi +'</td>'+'<td>'
                              + objek.namakabupaten +'</td>'+'<td>'+ objek.namakecamatan +'</td>'+'<td>'+ objek.namadesa +'</td>'+'<td>'
                              + objek.namapengguna +'</td>'+'<td>'+ objek.created_at +'</td></tr>');
                      });
                  },
                  error: function(error) {
                    console.log(error);
                  }
                });
              }
              </script>