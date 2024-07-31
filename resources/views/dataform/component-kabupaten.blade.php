@extends('landingpage.layout')

@section('content')

<style>
                .card:hover .card-body:first-child{display: none;
                }
                .card:hover:last-child{display: block;background-color: #373838;color:white;
                }
                a{color:#373838;
                }
              </style>
<!-- CONTAINER -->
<div class="container">
   <div class="row">
        <div class="col-lg-12">
            <br>
            <a class="back-link btn btn-primary" href="/"><i class="fas fa-arrow-left"></i> Kembali</a>
<br><br>
<div class="row justify-content-center">

            <!-- Baris Pertama -->
            <div class="col-lg-4  col-md-4 col-xs-6">
                <div class="card mb-3" >
                    <a href="/dataform/kab/{{ $kabupaten->slug }}" class="stretched-link">
                        <img src="/images/kandidat/{{ $kabupaten->foto }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">{{ $kabupaten->namakabupaten }}</p>
                        </div>
                    </a>
                </div>
            </div>

            </div>

        </div>
    </div>
</div>
@endsection
