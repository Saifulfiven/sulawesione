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
              <h6>Data Tim Pendukung Calon Gubernur</h6>
              <a href="{{ url('admin/timintipilgub') }}" class="btn btn-success  position-absolute end-10 top-0 mt-3 me-3">Tim Inti</a>
            <a href="{{ url('admin/pendukungpilgub') }}" class="btn btn-primary  position-absolute end-0 top-0 mt-3 me-3">Pendukung</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">

              <div class="table-responsive p-3"><table class="table align-items-center mb-0" id="tabel-data">
                  <thead>
                    <tr>
                      <th class="text-secondary">No</th>
                      <th class="text-secondary">Nama</th>
                        <th class="text-secondary">Kontak</th>
                      <th class="text-secondary">Kandidat</th>
                      <th class="text-secondary">Provinsi</th>
                      <th class="text-secondary">Kabupaten</th>
                      <th class="text-secondary">Jenis Tim</th>
                        <!-- Ini Adalah Wilayah Kandidat -->
                      <!-- <th class="text-secondary">Aksi</th> -->
                    </tr>
                  </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      @foreach ($pendukungpilgubs as $pendukungpilgub)

                        <tr>
                          <td> {{ $no }}</td>
                          <td>{{ $pendukungpilgub->nama }}</td>
                            <td>{{ $pendukungpilgub->kontak }}</td>
                          <td>{{ $pendukungpilgub->namakandidat }}</td>
                          <td>{{ $pendukungpilgub->namaprovinsi }}</td>
                          <td>{{ $pendukungpilgub->namakabupaten }}</td>
                          <td>
                            @if ($pendukungpilgub->kodetim == 'A')
                              Team Keluarga
                            @elseif ($pendukungpilgub->kodetim == 'B')
                              Team Parti Nasdem
                            @elseif ($pendukungpilgub->kodetim == 'C')
                              Team PKS
                            @elseif ($pendukungpilgub->kodetim == 'D')
                              Team PKB
                            @elseif ($pendukungpilgub->kodetim == 'E')
                              Team Commando
                            @elseif ($pendukungpilgub->kodetim == 'F')
                              Team DTD
                            @elseif ($pendukungpilgub->kodetim == 'G')
                              Team Desa/Khusus
                            @endif
                          </td>
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

