
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