@extends('landingpage.layout')

@section('content')

<!-- CONTAINER -->
<div class="container">
   <div class="row">
        <div class="col-lg-12">
            <div id="success">
                <div class="mt-5 text-center">
                <img src="{{ asset('img/icon-sukses.png') }}" 
                class="img-fluid mt-3 animated zoomIn"
                alt="Sukses" width="150" style="animation-duration: 1.5s;">
                    <br>
                   
                    @if(session('berhasil_login'))
                        <h4>Terima kasih data yang kamu inputkan berhasil kami Terima!</h4>
                    <h6>Kembali Ke Input data</h6>
                    <div class="d-flex justify-content-between">
                        <a href="/dataform" class="btn btn-success">Pendukung</a> 
                        <a href="/dtd" class="btn btn-success">Form DTD</a>
                    </div>
                    
                    @else
                        <h4>Terima kasih data yang kamu inputkan berhasil kami Terima!</h4>
                        <a href="/pengguna/login" class="btn btn-success">Ke Halaman Login ➜</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection