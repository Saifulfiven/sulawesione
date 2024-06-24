<div class="container bg-pengalaman">
<div class="row justify-content-center">
<div class="col-lg-8 col-md-9">
<div class="section-heading text-center mb-5">
<h2>Platform Survey Pilkada</h2>
<p class="lead">
Berpengalaman dan professional.
</p>
</div>
</div>
</div>
<div class="row equal">

<div class="col-md-4 col-lg-4">
<div class="rounded text-center bg-white p-5 h-100" style="border: 2px solid #dbdbdb;"
     onmouseover="this.style.boxShadow='0px 0px 15px rgba(0,0,0,0.2)'"
     onmouseout="this.style.boxShadow='0px 0px 0px rgba(0,0,0,0.2)'">
<div class="circle-icon mb-5">
<span class="ti-vector text-white"></span>
</div>
<h5>Terintegrasi &amp; Berjenjang</h5>
<p>
Data terintegrasi dan berjenjang agar memudahkan Anda untuk melakukan konsolidasi.
</p>
</div>
</div>


<div class="col-md-4 col-lg-4">

<div class="rounded text-center bg-white p-5 h-100" style="border: 2px solid #dbdbdb;"
     onmouseover="this.style.boxShadow='0px 0px 15px rgba(0,0,0,0.2)'"
     onmouseout="this.style.boxShadow='0px 0px 0px rgba(0,0,0,0.2)'">
<div class="circle-icon mb-5">
<span class="ti-lock text-white"></span>
</div>
<h5>Keamanan Data</h5>
<p>Kami menjamin keamanan data Anda, sehingga Anda cukup fokus pada Proses Pemenangan.</p>
</div>
</div>


<div class="col-md-4 col-lg-4">

<div class="rounded text-center bg-white p-5 h-100" style="border: 2px solid #dbdbdb;"
     onmouseover="this.style.boxShadow='0px 0px 15px rgba(0,0,0,0.2)'"
     onmouseout="this.style.boxShadow='0px 0px 0px rgba(0,0,0,0.2)'">
<div class="circle-icon mb-5">
<span class="ti-eye text-white"></span>
</div>
<h5>Mudah Digunakan</h5>
<p>
sangat mudah digunakan oleh semua kalangan tanpa batasan background pendidikan.
</p>
</div>
</div>
</div>
</div>




     <!-- Blog Start -->
        <div class="container-fluid py-5  bg-pengalaman" id="berita">
            <div class="container py-5">
                <div class="text-center mb-5 wow fadeInUp" data-wow-delay=".3s">
                    <h1 class="display-5">{{ $berita }}</h1>
                </div>
                <div class="owl-carousel blog-carousel wow fadeInUp" data-wow-delay=".5s">
                    @foreach($beritas as $item)
                    <div class="blog-item">
                        <img src="images/berita/{{ $item->gambar }}" class="img-fluid w-100 rounded-top" alt="">
                         <div class="rounded-bottom bg-light">
                            <div class="d-flex justify-content-between p-4 pb-2">
                                <span class="pe-2 text-dark"><i class="fa fa-user me-2"></i>By Admin</span>
                                <span class="text-dark"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                            </div>
                            <div class="px-4 pb-0">
                                <h4>{{ $item->judul }}</h4>
                                <?php
                                    $deskrip = $item->deskripsi;
                                    echo "<p>".substr($deskrip, 0, 350)."</p>";
                                    ?>
                            </div>
                            <div class="p-4 py-2 d-flex justify-content-between bg-primary rounded-bottom blog-btn">
                                <a href="/detail" class="my-auto text-dark">Selengkapnya</a>
                                <a href="#" class="my-auto text-dark"><i class="fa fa-comments me-2"></i>23 Comments</a>                            </div>
                        </div>
                    </div>
                        @endforeach

                </div>
            </div>

        </div>
        <!-- Blog End -->
