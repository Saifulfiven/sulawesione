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
              <h6>Data pemilih</h6>

              <form action="" method="get" class="row mt-3" id="form-cari" onsubmit="event.preventDefault(); searchData()">
                <div class="col-md-2">
                  <select class="form-select" name="provinsi" id="filter-provinsi" aria-label="Default select example">
                    <option value="" selected>Pilih Provinsi</option>
                    @foreach ($provinsi as $item)
                    <option value="{{ $item->id }}" {{ request()->get('provinsi') == $item->id ? 'selected' : '' }}>{{ $item->namaprovinsi }}</option>
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
                    url: '/admin/searchpemilih',
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

            </div>

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

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="tabel-data">
                  <thead>
                    <tr>
                        <thead>
                    <tr>

                        <th>No</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Jenis Pilihan</th>
                        <th>Kandidat</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
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
                          <td>{{ $pemilih->jenispilihan }}</td>
                          <td>{{ $pemilih->namakandidat }}</td>
                          <td>{{ $pemilih->namaprovinsi }}</td>
                          <td>{{ $pemilih->namakabupaten }}</td>
                          <td>{{ $pemilih->namakecamatan }}</td>
                          <td>{{ $pemilih->namadesa }}</td>
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

@endsection

