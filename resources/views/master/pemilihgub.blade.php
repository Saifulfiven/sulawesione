@extends('admindashboard.layout')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <div class="card-header pb-0 position-relative mb-5">
              <h6>{{ $toptitle }}</h6>
              <a href="{{ url('admin/pemilih/pilkab') }}" class="btn {{ $primary }}  position-absolute end-8 top-0 mt-3 me-3">Kabupaten</a>
            <a href="{{ url('admin/pemilih/pilgub') }}" class="btn {{ $success }}  position-absolute end-0 top-0 mt-3 me-3">Provinsi</a>
           <br>
             
            @if(session('berhasil_login_operator'))
            <a href="{{ url('admin/pemilih/pilgub') }}" class="btn {{ $primary }} " onclick="location.reload()"><i class="fas fa-sync-alt"></i></a>

            <button onclick="showHideContent()" class="btn {{ $primary }}" id="tombolsuara">Jumlah Suara</button>
            <button onclick="showHideContentBobot()" class="btn {{ $primary }} " id="tombolbobot">Jumlah Bobot Suara</button>
            <button onclick="showHideContentdatacollection()" class="btn {{ $primary }} " id="tomboldatacollection">Grafik Data Collection</button>


            <div id="content-toggle" data-aos="fade-up" style="display: none;">
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
                  <option value="0" selected>Pilih Kabupaten</option>
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-select" name="kecamatan" id="filter-kecamatan" aria-label="Default select example">
                  <option value="0" selected>Pilih Kecamatan</option>
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-select" name="desa" id="filter-desa" aria-label="Default select example">
                  <option value="0" selected>Pilih Desa</option>
                </select>
              </div>
              <div class="col-md-2">
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


              <div id="content-toggle-bobot" style="display: none;" data-aos="fade-left" data-aos-duration="1000">
              <form action="" method="get" class="row mt-3" id="form-cari-bobot" onsubmit="event.preventDefault(); searchDataBobot()">
              <div class="col-md-2">
                <select class="form-select" name="provinsi" id="filter-provinsi-bobot" aria-label="Default select example">
                  <option value="" selected>Provinsi</option>
                  @foreach ($provinsi as $item)
                  <option value="{{ $item->id }}" {{ request()->get('provinces') == $item->id ? 'selected' : '' }}>{{ $item->namaprovinsi }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-select" name="kabupaten" id="filter-kabupaten-bobot" aria-label="Default select example">
                  <option value="" selected>Pilih Kabupaten</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-select" name="kecamatan" id="filter-kecamatan-bobot" aria-label="Default select example">
                  <option value="0" selected>Pilih Kecamatan</option>
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-select" name="desa" id="filter-desa-bobot" aria-label="Default select example">
                  <option value="0" selected>Pilih Desa</option>
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-select" name="kandidat" id="filter-dapil-bobot" aria-label="Default select example">
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
                        <h5 class="text-white font-weight-bolder mb-4 pt-2">Data Jumlah Suara Bobot</h5>

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




              <!-- INI UNTUK GRAFIK DATA COLLECTION -->

              <div id="content-toggle-grafik-collection" style="display: none;" data-aos="fade-left" data-aos-duration="1000">
                <h3>Grafik Data Collection</h3>
              <form action="" method="get" class="row mt-3" id="form-cari-collection" onsubmit="event.preventDefault(); searchDatacollection()">
              <div class="col-md-2">
                <select class="form-select" name="provinsi" id="filter-provinsi-collection" aria-label="Default select example">
                  <option value="" selected>Provinsi</option>
                  @foreach ($provinsi as $item)
                  <option value="{{ $item->id }}" {{ request()->get('provinces') == $item->id ? 'selected' : '' }}>{{ $item->namaprovinsi }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-select" name="kabupaten" id="filter-kabupaten-collection" aria-label="Default select example">
                  <option value="" selected>Pilih Kabupaten</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-select" name="kecamatan" id="filter-kecamatan-collection" aria-label="Default select example">
                  <option value="0" selected>Pilih Kecamatan</option>
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-select" name="desa" id="filter-desa-collection" aria-label="Default select example">
                  <option value="0" selected>Pilih Kelurahan</option>
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-select" name="kandidat" id="filter-dapil-collection" aria-label="Default select example">
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
                            <h5 class="font-weight-bolder">Grafik Data Collection</h5>
                            <canvas id="barChartcollection" width="400" height="200" id="suarapemilihcollection"></canvas>
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
                        <h5 class="text-white font-weight-bolder mb-4 pt-2">Jumlah Data Collection</h5>

                        <table id="suarapemilihcollection">
                          <?php 
                          $dataPemilihDapil = []; 
                          foreach ($pemilihdapilcollection as $data){
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
                let desa = $('#filter-desa').val();
                console.log('ini kucing ' + district);
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
                        id_desa: desa,
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


              // Search berdasarkan Bobot
               function searchDataBobot() {
               
                $('#suarapemilihbobot').empty();
                $('#barChartBobot').replaceWith('<canvas id="barChartBobot"></canvas>');
                $('#tblsearchpemilih').replaceWith('<tbody id="tblsearchpemilih"></tbody>');

                let province = $('#filter-provinsi-bobot').val();
                let district = $('#filter-kabupaten-bobot').val();
                let subDistrict = $('#filter-kecamatan-bobot').val();
                let candidate = $('#filter-dapil-bobot').val();
                let desa = $('#filter-desa-bobot').val();
                //let url = `{{ url('admin/master/pemilih?provinsi=') }}${province}&kabupaten=${district}&kecamatan=${subDistrict}&kandidat=${candidate}`;
                $.ajax(
                  {
                    url: '/admin/searchpemilihgubbobot',
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_provinsi: province,
                        id_kabupaten: district,
                        id_kecamatan: subDistrict,
                        id_kandidat: candidate,
                        id_desa: desa,
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

                      $('#barChartBobot').empty();
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

              // Search Data Collection
              function searchDatacollection() {
               
               $('#suarapemilihcollection').empty();
               $('#barChartcollection').replaceWith('<canvas id="barChartcollection"></canvas>');
               $('#tblsearchpemilih').replaceWith('<tbody id="tblsearchpemilih"></tbody>');

               let province = $('#filter-provinsi-collection').val();
               let district = $('#filter-kabupaten-collection').val();
               let subDistrict = $('#filter-kecamatan-collection').val();
               let candidate = $('#filter-dapil-collection').val();
               let desa = $('#filter-desa-collection').val();
               console.log(province);
               //let url = `{{ url('admin/master/pemilih?provinsi=') }}${province}&kabupaten=${district}&kecamatan=${subDistrict}&kandidat=${candidate}`;
               $.ajax(
                 {
                   url: '/admin/searchpemilihgubcollection',
                   type: "post",
                   data: {
                       _token: "{{ csrf_token() }}",
                       id_provinsi: province,
                       id_kabupaten: district,
                       id_kecamatan: subDistrict,
                       id_kandidat: candidate,
                       id_desa: desa,
                   },
                 success: function(response) {
                   let pemilihs = response.pemilihscollection;
                   let pemilihdapilcollection = response.pemilihdapilcollection;
                   let no = 1;let nom = 1;
                   pemilihs.forEach(function(objek, indeks) {
                         $('#tblsearchpemilih').append('<tr>'+'<td>'+ no++ +'</td><td>'+ objek.nama +'</td>'+'<td>'+ objek.kontak +'</td>'
                             +'<td>'+ objek.id_kandidat +'</td>'+'<td>'+ objek.jenispilihan +'</td>'+'<td>'+ objek.namakandidat +'</td>'+'<td>'+ objek.namaprovinsi +'</td>'+'<td>'
                             + objek.namakabupaten +'</td>'+'<td>'+ objek.namakecamatan +'</td>'+'<td>'+ objek.namadesa +'</td>'
                             +'<td>'+ 'RT : '+ objek.rt +' RW : '+ objek.rw +'</td>'+'<td>'+ objek.namapengguna +'</td>'+'<td>'+ objek.created_at +'</td></tr>');
                     });

                     pemilihdapilcollection.forEach(function(objek, indeks) {
                         $('#suarapemilihcollection').append('<tr>'+'<td>'+ nom++ +'</td><td>'+ objek.namakandidat +'</td>'+'<td>'+ objek.jumlah_pemilih +'</td>'+'</tr>');
                     });

                     $('#barChartcollection').empty();
                 const data = {
                     labels: pemilihdapilcollection.map(item => item.namakandidat),
                     datasets: [{
                         label: 'Jumlah Suara',
                         data: pemilihdapilcollection.map(item => item.jumlah_pemilih),
                         backgroundColor: ['blue', 'orange', 'green', 'red','#32a852','#a832a8','#3010e3','#b3ae2b','#10e3ce','#dfe310'],
                         borderColor: ['blue', 'orange', 'green', 'red'],
                         borderWidth: 1
                     }]
                 };

                 // Bar Chart
                 const barCtx = document.getElementById('barChartcollection');
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

  

              
            @elseif(session('jeniskandidat') == 'pilgub')
              @include('master.searchpemilihpilgub')
            @elseif(session('jeniskandidat') == 'pilkab')
              @include('master.searchpemilihpilkab')
            @endif

            </div>


            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-3">
                <table class="table align-items-center mb-0" id="tabel-data">
                  <thead>
                    <tr>

                        <th>No</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Kandidat Pilihat</th>
                        <th>Jenis Pilihan</th>
                        <th>Kandidat</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
                        <th>RT RW</th>
                        <th>Pengguna</th>
                        <th>Waktu</th>
                    </tr>
                  </thead>

                    <tbody id="tblsearchpemilih">
                      <?php $no = 1; ?>
                      @foreach ($pemilihs as $pemilih)
                        <tr>
                          <td> {{ $no }}</td>
                          <td>{{ $pemilih->nama }}</td>
                          <td>{{ $pemilih->kontak }}</td>
                          <td>{{ $pemilih->id_kandidat }}</td>
                          <td>{{ $pemilih->jenispilihan }}</td>
                          <td>{{ $pemilih->namakandidat }}</td>
                          <td>{{ $pemilih->namaprovinsi }}</td>
                          <td>{{ $pemilih->namakabupaten }}</td>
                          <td>{{ $pemilih->namakecamatan }}</td>
                          <td>{{ $pemilih->namadesa }}</td>
                          <td>RT : {{ $pemilih->rt }} | RW : {{ $pemilih->rw }}</td>
                            <td>{{ $pemilih->namapengguna }}</td>
                            <td>{{ $pemilih->created_at }}</td>
                        </tr>
                        <?php $no++; ?>
                      @endforeach

                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<!--   Core JS Files   -->
    <script src="{{ asset('assetsadmin/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assetsadmin/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assetsadmin/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assetsadmin/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });

    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
    }, 2000);
</script>

<!-- Filter Searching -->
              <script>

                // Searching Jumlah Suara
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
                           $('#filter-kabupaten').append('<option value="0" selected>Pilih Kabupaten</option>');
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
                          $('#filter-kecamatan').append('<option value="0" selected>Pilih Kecamatan</option>');
                          res.forEach(function(objek, indeks) {
                            $('#filter-kecamatan').append('<option value="'+ objek.id +'">'+ objek.namakecamatan +'</option>');
                          });
                        }
                      });
                    }else{
                      $('#filter-kecamatan').empty();
                    }
                  });

                  $('#filter-kecamatan').on('change', function(){
                    let id_kecamatan = $(this).val();
                    if(id_kecamatan){
                      jQuery.ajax({
                        url: '/admin/searchdesa',
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_kecamatan: id_kecamatan
                        },
                        success: function(res){
                          console.log(res);
                          $('#filter-desa').empty();
                          $('#filter-desa').append('<option value="0" selected>Pilih Desa</option>');
                          res.forEach(function(objek, indeks) {
                            $('#filter-desa').append('<option value="'+ objek.id +'">'+ objek.namadesa +'</option>');
                          });
                        }
                      });
                    }else{
                      $('#filter-desa').empty();
                    }
                  });


                });


                // Searching Jumlah Suara BOBOT
                $(document).ready(function(){
                  $('#filter-provinsi-bobot').on('change', function(){
                    let id_provinsi = $(this).val();
                    if(id_provinsi){
                      jQuery.ajax({
                        url: '/admin/searchkabupatenbobot',
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_provinsi: id_provinsi
                        },
                        success: function(res){
                          console.log(res);
                           $('#filter-kabupaten-bobot').empty();
                           $('#filter-kabupaten-bobot').append('<option value="0" selected>Pilih Kabupaten</option>');
                          res.forEach(function(objek, indeks) {
                              console.log("Objek ke-" + (indeks + 1) + ":");
                              console.log(objek.id);console.log(objek.namakabupaten);
                              $('#filter-kabupaten-bobot').append('<option value="'+ objek.id +'">'+ objek.namakabupaten +'</option>');
                          });
                        }
                      });
                    }else{
                      $('#filter-kabupaten-bobot').empty();
                    }
                  });
                  $('#filter-kabupaten-bobot').on('change', function(){
                    let id_kabupaten = $(this).val();
                    if(id_kabupaten){
                      jQuery.ajax({
                        url: '/admin/searchkecamatanbobot',
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_kabupaten: id_kabupaten
                        },
                        success: function(res){
                          console.log(res);
                          $('#filter-kecamatan-bobot').empty();
                          $('#filter-kecamatan-bobot').append('<option value="0" selected>Pilih Kecamatan</option>');
                          res.forEach(function(objek, indeks) {
                            $('#filter-kecamatan-bobot').append('<option value="'+ objek.id +'">'+ objek.namakecamatan +'</option>');
                          });
                        }
                      });
                    }else{
                      $('#filter-kecamatan-bobot').empty();
                    }
                  });

                  $('#filter-kecamatan-bobot').on('change', function(){
                    let id_kecamatan = $(this).val();
                    if(id_kecamatan){
                      jQuery.ajax({
                        url: '/admin/searchdesabobot',
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_kecamatan: id_kecamatan
                        },
                        success: function(res){
                          console.log(res);
                          $('#filter-desa-bobot').empty();
                          $('#filter-desa-bobot').append('<option value="0" selected>Pilih Desa</option>');
                          res.forEach(function(objek, indeks) {
                            $('#filter-desa-bobot').append('<option value="'+ objek.id +'">'+ objek.namadesa +'</option>');
                          });
                        }
                      });
                    }else{
                      $('#filter-desa-bobot').empty();
                    }
                  });
                });

                // Searching Jumlah Suara collection
                $(document).ready(function(){
                  $('#filter-provinsi-collection').on('change', function(){
                    let id_provinsi = $(this).val();
                    if(id_provinsi){
                      jQuery.ajax({
                        url: '/admin/searchkabupatencollection',
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_provinsi: id_provinsi
                        },
                        success: function(res){
                          console.log(res);
                           $('#filter-kabupaten-collection').empty();
                           $('#filter-kabupaten-collection').append('<option value="0" selected>Pilih Kabupaten</option>');
                          res.forEach(function(objek, indeks) {
                              console.log("Objek ke-" + (indeks + 1) + ":");
                              console.log(objek.id);console.log(objek.namakabupaten);
                              $('#filter-kabupaten-collection').append('<option value="'+ objek.id +'">'+ objek.namakabupaten +'</option>');
                          });
                        }
                      });
                    }else{
                      $('#filter-kabupaten-collection').empty();
                    }
                  });
                  $('#filter-kabupaten-collection').on('change', function(){
                    let id_kabupaten = $(this).val();
                    if(id_kabupaten){
                      jQuery.ajax({
                        url: '/admin/searchkecamatancollection',
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_kabupaten: id_kabupaten
                        },
                        success: function(res){
                          console.log(res);
                          $('#filter-kecamatan-collection').empty();
                          $('#filter-kecamatan-collection').append('<option value="0" selected>Pilih Kecamatan</option>');
                          res.forEach(function(objek, indeks) {
                            $('#filter-kecamatan-collection').append('<option value="'+ objek.id +'">'+ objek.namakecamatan +'</option>');
                          });
                        }
                      });
                    }else{
                      $('#filter-kecamatan-collection').empty();
                    }
                  });

                  $('#filter-kecamatan-collection').on('change', function(){
                    let id_kecamatan = $(this).val();
                    if(id_kecamatan){
                      jQuery.ajax({
                        url: '/admin/searchdesacollection',
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_kecamatan: id_kecamatan
                        },
                        success: function(res){
                          console.log(res);
                          $('#filter-desa-collection').empty();
                          $('#filter-desa-collection').append('<option value="0" selected>Pilih Desa</option>');
                          res.forEach(function(objek, indeks) {
                            $('#filter-desa-collection').append('<option value="'+ objek.id +'">'+ objek.namadesa +'</option>');
                          });
                        }
                      });
                    }else{
                      $('#filter-desa-collection').empty();
                    }
                  });
                });
              </script>


  <script>
      function showHideContent() {
        var content = document.getElementById("content-toggle");
        var contentbobot = document.getElementById("content-toggle-bobot");
        var contentcollection = document.getElementById("content-toggle-grafik-collection");
        
              content.style.display = "block";
              contentbobot.style.display = "none";
              contentcollection.style.display = "none";

              document.getElementById("tombolsuara").style.backgroundColor = "blue";
              document.getElementById("tombolbobot").style.backgroundColor = "#82d616";
              document.getElementById("tomboldatacollection").style.backgroundColor = "#82d616";
      }

      function showHideContentBobot() {
          var content = document.getElementById("content-toggle");
          var contentbobot = document.getElementById("content-toggle-bobot");
          var contentcollection = document.getElementById("content-toggle-grafik-collection");

          contentcollection.style.display = "none";
              content.style.display = "none";
              contentbobot.style.display = "block";

              document.getElementById("tombolsuara").style.backgroundColor = "#82d616";
              document.getElementById("tombolbobot").style.backgroundColor = "blue";
              document.getElementById("tomboldatacollection").style.backgroundColor = "#82d616";
      }


      function showHideContentdatacollection() {
          var content = document.getElementById("content-toggle");
          var contentbobot = document.getElementById("content-toggle-bobot");
          var contentcollection = document.getElementById("content-toggle-grafik-collection");

              content.style.display = "none";
              contentbobot.style.display = "none";
              contentcollection.style.display = "block";

              document.getElementById("tombolsuara").style.backgroundColor = "#82d616";
              document.getElementById("tombolbobot").style.backgroundColor = "#82d616";
              document.getElementById("tomboldatacollection").style.backgroundColor = "blue";
      }
  </script>


<!-- Hasil Filter -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

