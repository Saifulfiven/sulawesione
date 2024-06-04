<div id="provinsi" class="form-group">
                    <label for="textbox3">Provinsi:</label>
      <select class="form-select" name="provinsi" id="filter-provinsi" aria-label="Default select example">
        <option value="" selected>Pilih Provinsi</option>
        @foreach ($provinsi as $item)
        <option value="{{ $item->id }}" {{ request()->get('provinsi') == $item->id ? 'selected' : '' }}>{{ $item->namaprovinsi }}</option>
        @endforeach
      </select>
    </div>

    <div id="kabupaten" class="form-group">
                    <label for="textbox3">Kabupaten:</label>
      <select class="form-select" name="kabupaten" id="filter-kabupaten" aria-label="Default select example">
        <option value="" selected>Pilih Kabupaten</option>
      </select>
    </div>

<div id="kecamatan" class="form-group">
    <label for="textbox3">Kecamatan:</label>

    <select class="form-select" name="kecamatan" id="filter-kecamatan" aria-label="Default select example">
        <option value="" selected>Pilih Kecamatan</option>
    </select>
</div>

<div id="desa" class="form-group">
    <label for="desa">Desa:</label>

    <select class="form-select" name="desa" id="filter-desa" aria-label="Default select example">
        <option value="" selected>Pilih Desa</option>
    </select>
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

            //Tampilkan List Kecamatan setelah pilih kaupaten
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

            // Tampilkan List Desa Stelah pilih kecamatan
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
                              $('#filter-desa').append('<option value="" selected>Pilih Desa</option>');
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
      </script>
