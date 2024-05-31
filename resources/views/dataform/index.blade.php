@extends('landingpage.layout')

@section('content')

<style>
                .card:hover .card-body:first-child{
                  display: none;
                }
                .card:hover .card-body:last-child{
                  display: block;
                  background-color: #373838;
                  color:white;
                }
                .card:hover .card-body {
                        transform: scale(1.1);
                        box-shadow: 0 0 10px rgba(0,0,3,0.5);
                        color:white;
                    }
              </style>
<!-- CONTAINER -->
<div class="container">
    
   <div class="row">
      

        <div class="col-lg-12">
        <br><br>
                
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100" style="background-color: #007bff;" id="pilgub"  onclick="showAjaxContent('pilgub')">
                        <div class="card-body text-center" style="transition: all 0.3s ease; background: linear-gradient(1b8bd6, #6abbf2, #bbe1fa); color: white !important;">
                            PILGUB
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100" style="background-color: #007bff;" id="pilwalkot"  onclick="showAjaxContent('pilkab')">
                        <div class="card-body text-center" style="transition: all 0.3s ease; background: linear-gradient(1b8bd6, #6abbf2, #bbe1fa); color: white !important;">
                            PILWALKOT
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <span id="pilih-provinsi" style="display:none">
                @foreach($provinsis as $provinsi)
                    <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
                        <div class="card h-100" style="background-color: #007bff;">
                            <a href="/dataform/prov/{{ $provinsi->slug }}/">
                                <div class="card-body text-center" style="transition: all 0.3s ease; background: linear-gradient(1b8bd6, #6abbf2, #bbe1fa); color: white !important;">
                                    <h5 class="card-title">Provinsi {{ $provinsi->namaprovinsi }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
                </span>
            </div>

            
            <div class="row">
             <span id="pilih-pilkab" style="display:none">
                @foreach($provinsis as $provinsi)
                    <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
                        <div class="card h-100" style="background-color: #007bff;">
                            <a href="/dataform/{{ $provinsi->slug }}">
                                <div class="card-body text-center" style="transition: all 0.3s ease; background: linear-gradient(1b8bd6, #6abbf2, #bbe1fa); color: white !important;">
                                    <h5 class="card-title">{{ $provinsi->namaprovinsi }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
                </span>
            </div>


        </div>
    </div>
</div>

<script>

    function showAjaxContent(button){
        console.log(button);
        var content1 = document.getElementById('pilih-provinsi');
        var content2 = document.getElementById('pilih-pilkab');

        if(button === "pilgub"){
            content1.style.display = 'block';
            content2.style.display = 'none';
        } else if(button === "pilkab"){
            content1.style.display = 'none';
            content2.style.display = 'block';
        }
    }


function showTextBoxes() {
    console.log('kucing');
        // Mendapatkan nilai dari elemen select
        var selectedOption = document.getElementById("options").value;

        var content1 = document.getElementById('pilih-provinsi');
        var content2 = document.getElementById('pilih-pilkab');

        // Menampilkan atau menyembunyikan textbox sesuai dengan pilihan
        if (selectedOption === "pilgub") {
            document.getElementById("pilih-kabupaten").style.display = "none";
            document.getElementById("pilih-provinsi").style.display = "block";
            document.getElementById("id_kabupaten").val();
        } else if (selectedOption === "pilkab") {
            document.getElementById("pilih-kabupaten").style.display = "block";
            document.getElementById("pilih-provinsi").style.display = "none";
            document.getElementById("id_provinsi").val();
        }
    }
</script>
@endsection