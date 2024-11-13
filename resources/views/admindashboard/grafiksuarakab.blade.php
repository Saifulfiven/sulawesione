
<div class="container-fluid py-4">


      <div class="row mt-4">
        <div class="col-lg-8 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-12">
                  <div class="d-flex flex-column h-100">
                    <h5 class="font-weight-bolder">Grafik Suara Kota Gorontalo</h5>
                    <br>
                    <canvas id="barChart" width="400" height="200"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        


        </div>


        <div class="col-lg-4">
          <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('assetsadmin/img/ivancik.jpg') }}');">
              <span class="mask bg-gradient-dark"></span>
              <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                <h5 class="text-white font-weight-bolder mb-4 pt-2">Suara Pemilih</h5>
                <p class="text-white">Data Suara Pemilih .</p>
                <ul class="text-white">
                  @if(session('berhasil_login_admins'))
                  
                  <?php 
                  $dataPemilihDapil = []; 
                  foreach ($pemilihDapil as $data){
                    echo "<li>Nama Wilayah: $data->name - Jumlah Pemilih: $data->jumlah_pemilih</li>";

                    $dataPemilihDapil[] = ["namawilayah" => $data->name, "jumlah_pemilih" => $data->jumlah_pemilih];
                  }

                  ?>
                  @elseif(session('berhasil_login_operator'))
                  
                  <?php 
                  $dataPemilihDapil = []; 
                  foreach ($pemilihDapil as $data){
                    echo "<li>Nama Wilayah: $data->name - Jumlah Pemilih: $data->jumlah_pemilih</li>";

                    $dataPemilihDapil[] = ["namawilayah" => $data->name, "jumlah_pemilih" => $data->jumlah_pemilih];

                  }

                  ?>
                  @endif

                  
                  
                </ul>
 
              
              </div>
            </div>
          </div>
        </div>
      </div>
      

      <div class="row mt-4">
        
        
        <div class="col-lg-12 mb-lg-0 mb-4" style="display: none;">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-12">
                  <div class="d-flex flex-column h-100">
                    <h5 class="font-weight-bolder">Dashboard</h5>
                    <canvas id="pieChart" width="400" height="200"></canvas>

                  </div>
                </div>
                
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
                <a href="#" class="font-weight-bold" target="_blank">Programmer</a>
                Suara Pemilih.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https:/www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https:/www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">Tentang Kami</a>
                </li>
                <li class="nav-item">
                  <a href="https:/www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https:/www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      dataPemilihDapil
        var dataPemilihDapil = <?php echo json_encode($dataPemilihDapil) ?>;
        const data = {
            labels: dataPemilihDapil.map(item => item.namawilayah),
            datasets: [{
                label: 'Jumlah Suara',
                data: dataPemilihDapil.map(item => item.jumlah_pemilih),
                backgroundColor: dataPemilihDapil.map(item => {
                    if (item.jumlah_pemilih < 5) {
                        return 'red';
                    } else if (item.jumlah_pemilih >= 5 && item.jumlah_pemilih < 6) {
                        return 'orange';
                    } else {
                        return 'green';
                    }
                }),
                borderColor: ['blue', 'orange', 'green', 'red'],
                borderWidth: 1
            }]
        };

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
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

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += new Intl.NumberFormat('en-US', { style: 'percent', maximumFractionDigits: 1 }).format(context.parsed / 650);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
 