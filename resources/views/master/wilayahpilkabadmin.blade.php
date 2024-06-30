<a href="{{ url('admin/pemilih/pilkab') }}" class="btn {{ $primary }} " onclick="location.reload()"><i class="fas fa-sync-alt"></i></a>

            <button onclick="showHideContent()" class="btn {{ $primary }}" id="tombolsuara">Jumlah Suara</button>
            <button onclick="showHideContentBobot()" class="btn {{ $primary }} " id="tombolbobot">Jumlah Bobot Suara</button>


            <div id="content-toggle" data-aos="fade-up" style="display: none;">
              <form action="" method="get" class="row mt-3" id="form-cari" onsubmit="event.preventDefault(); searchData()">
              <input type="hidden" name="id_provinsi" id="filter-provinsi" value="{{ $province_id }}">  
              <input type="hidden" name="id_kabupaten" value="{{ session('id_kabupaten') }}" id="filter-kabupaten">
              
              <div class="col-md-3">
                <select class="form-select" name="kecamatan" id="filter-kecamatan" aria-label="Default select example">
                  <option value="0" selected>Pilih Kecamatan</option>
                  @foreach ($wilayah as $item)
                  <option value="{{ $item->id }}" {{ request()->get('districts') == $item->id ? 'selected' : '' }}>{{ $item->namakecamatan }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-select" name="desa" id="filter-desa" aria-label="Default select example">
                  <option value="0" selected>Pilih Desa</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-select" name="kandidat" id="filter-dapil" aria-label="Default select example">
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
                            <canvas id="barChart" width="400" height="200" id="suarapemilih"></canvas>
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

                        <table id="suarapemilih">
                          <?php 
                          $dataPemilihDapil = []; 
                          foreach ($pemilihdapil as $data){
                            echo "<tr><td>$data->namakecamatan </td><td> Jumlah Pemilih: $data->jumlah_pemilih</td></tr>";

                            $dataPemilihDapil[] = ["namawilayah" => $data->namakecamatan, "jumlah_pemilih" => $data->jumlah_pemilih];

                          }

                          ?>   
                          </table>

                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


              <div id="content-toggle-bobot" style="display: none;" data-aos="fade-left" data-aos-duration="1000">
              <form action="" method="get" class="row mt-3" id="form-cari-bobot" onsubmit="event.preventDefault(); searchDataBobot()">
              <input type="hidden" name="id_provinsi" id="filter-provinsi-bobot" value="{{ $province_id }}">  
              <input type="hidden" name="id_kabupaten" value="{{ session('id_kabupaten') }}" id="filter-kabupaten-bobot">
              
              <div class="col-md-3">
                <select class="form-select" name="kecamatan" id="filter-kecamatan-bobot" aria-label="Default select example">
                  <option value="0" selected>Pilih Kecamatan</option>
                  @foreach ($wilayah as $item)
                  <option value="{{ $item->id }}" {{ request()->get('districts') == $item->id ? 'selected' : '' }}>{{ $item->namakecamatan }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-select" name="desa" id="filter-desa-bobot" aria-label="Default select example">
                  <option value="0" selected>Pilih Desa</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-select" name="kandidat" id="filter-dapil-bobot" aria-label="Default select example">
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
                            <h5 class="font-weight-bolder">Jumlah Suara Bobot </h5>
                            <canvas id="barChartBobot" width="400" height="200" id="suarapemilihbobot"></canvas>
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
                        <h5 class="text-white font-weight-bolder mb-4 pt-2">Jumlah Suara Bobot</h5>

                        <table id="suarapemilihbobot">
                          <?php 
                          $dataPemilihDapil = []; 
                          foreach ($pemilihdapilbobot as $data){
                            echo "<tr><td>Nama Wilayah: $data->namakecamatan </td><td> Jumlah Pemilih: $data->jumlah_pemilih</td></tr>";

                            $dataPemilihDapil[] = ["namawilayah" => $data->namakecamatan, "jumlah_pemilih" => $data->jumlah_pemilih];

                          }

                          ?>   
                          </table>

                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                        </div>

              <script>
                // Search Pemilih
              function searchData() {

                $('#tblsearchpemilih').empty();
                $('#suarapemilih').empty();
                $('#barChart').replaceWith('<canvas id="barChart"></canvas>');

                let province = $('#filter-provinsi').val();
                let district = $('#filter-kabupaten').val();
                let subDistrict = $('#filter-kecamatan').val();
                let candidate = $('#filter-dapil').val();
                let village = $('#filter-desa').val();
                //let url = `{{ url('admin/master/pemilih?provinsi=') }}${province}&kabupaten=${district}&kecamatan=${subDistrict}&kandidat=${candidate}`;
                $.ajax(
                  {
                    url: '/admin/searchpemilih',
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_provinsi: province,
                        id_kabupaten: district,
                        id_kecamatan: subDistrict,
                        id_kandidat: candidate,
                        id_desa: village
                    },
                  success: function(response) {
                    let pemilihs = response.pemilihs;
                    let pemilihdapil = response.pemilihdapil;
                    let no = 1;let nom = 1;
                    pemilihs.forEach(function(objek, indeks) {
                          $('#tblsearchpemilih').append('<tr>'+'<td>'+ no++ +'</td><td>'+ objek.nama +'</td>'+'<td>'+ objek.kontak +'</td>'+'<td>'
                              + objek.jenispilihan +'</td>'+'<td>'+ objek.namakandidat +'</td>'+'<td>'+ objek.namaprovinsi +'</td>'+'<td>'
                              + objek.namakabupaten +'</td>'+'<td>'+ objek.namakecamatan +'</td>'+'<td>'+ objek.namadesa +'</td>'+'<td>'
                              + objek.namapengguna +'</td>'+'<td>'+ objek.created_at +'</td></tr>');
                      });

                      pemilihdapil.forEach(function(objek, indeks) {
                          $('#suarapemilih').append('<tr>'+'<td>'+ nom++ +'</td><td>'+ objek.namakecamatan +'</td>'+'<td>'+ objek.jumlah_pemilih +'</td>'+'</tr>');
                      });

                      $('#barChart').empty();
                  const data = {
                      labels: pemilihdapil.map(item => item.namakecamatan),
                      datasets: [{
                          label: 'Jumlah Suara',
                          data: pemilihdapil.map(item => item.jumlah_pemilih),
                          backgroundColor: ['blue', 'orange', 'green', 'red','#32a852','#a832a8','#3010e3','#b3ae2b','#10e3ce','#dfe310'],
                          borderColor: ['blue', 'orange', 'green', 'red'],
                          borderWidth: 1
                      }]
                  };

                  // Bar Chart
                  const barCtx = document.getElementById('barChart');
                  if (barCtx) {
                    const myChart = new Chart(barCtx, {
                        type: 'bar',
                        data: data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                  }

                  },
                  error: function(error) {
                    console.log(error);
                  }
                });
              }


              // Search berdasarkan Bobo
               // Search Pemilih
               function searchDataBobot() {
               
                $('#tblsearchpemilih').empty();
                $('#suarapemilihbobot').empty();
                $('#barChartBobot').replaceWith('<canvas id="barChartBobot"></canvas>');

                let province = $('#filter-provinsi-bobot').val();
                let district = $('#filter-kabupaten-bobot').val();
                let subDistrict = $('#filter-kecamatan-bobot').val();
                let villages = $('#filter-desa-bobot').val();
                let candidate = $('#filter-dapil-bobot').val();
                //let url = `{{ url('admin/master/pemilih?provinsi=') }}${province}&kabupaten=${district}&kecamatan=${subDistrict}&kandidat=${candidate}`;
                $.ajax(
                  {
                    url: '/admin/searchpemilihbobot',
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_provinsi: province,
                        id_kabupaten: district,
                        id_kecamatan: subDistrict,
                        id_desa: villages,
                        id_kandidat: candidate,
                    },
                  success: function(response) {
                    let pemilihs = response.pemilihsbobot;
                    let pemilihdapilbobot = response.pemilihdapilbobot;
                    let no = 1;let nom = 1;
                    pemilihs.forEach(function(objek, indeks) {
                          $('#tblsearchpemilih').append('<tr>'+'<td>'+ no++ +'</td><td>'+ objek.nama +'</td>'+'<td>'+ objek.kontak +'</td>'+'<td>'
                              + objek.jenispilihan +'</td>'+'<td>'+ objek.namakandidat +'</td>'+'<td>'+ objek.namaprovinsi +'</td>'+'<td>'
                              + objek.namakabupaten +'</td>'+'<td>'+ objek.namakecamatan +'</td>'+'<td>'+ objek.namadesa +'</td>'+'<td>'
                              + objek.namapengguna +'</td>'+'<td>'+ objek.created_at +'</td></tr>');
                      });

                      pemilihdapilbobot.forEach(function(objek, indeks) {
                          $('#suarapemilihbobot').append('<tr>'+'<td>'+ nom++ +'</td><td>'+ objek.namakecamatan +'</td>'+'<td>'+ objek.jumlah_pemilih +'</td>'+'</tr>');
                      });

                  const data = {
                      labels: pemilihdapilbobot.map(item => item.namakecamatan),
                      datasets: [{
                          label: 'Jumlah Suara',
                          data: pemilihdapilbobot.map(item => item.jumlah_pemilih),
                          backgroundColor: ['blue', 'orange', 'green', 'red','#32a852','#a832a8','#3010e3','#b3ae2b','#10e3ce','#dfe310'],
                          borderColor: ['blue', 'orange', 'green', 'red'],
                          borderWidth: 1
                      }]
                  };

                  // Bar Chart
                  const barCtx = document.getElementById('barChartBobot');
                  if (barCtx) {
                    const myChart = new Chart(barCtx, {
                        type: 'bar',
                        data: data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                  }

                  },
                  error: function(error) {
                    console.log(error);
                  }
                });
              }
              </script>
