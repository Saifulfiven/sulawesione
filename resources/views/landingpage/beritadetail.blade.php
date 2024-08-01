
<!-- Blog Start -->
<div class="container-fluid py-5" id="berita">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay=".3s">
            <h1 class="display-5">Berita</h1>
        </div>
        <div class="owl-carousel blog-carousel wow fadeInUp" data-wow-delay=".5s">
            @foreach ($beritas as $berita)
                <div class="blog-item">
                    <a href="/{{ $berita->slug }}" class="my-auto text-dark">
                        <img src="images/berita/{{ $berita->gambar }}" class="img-fluid w-100 rounded-top" alt="{{ $berita->slug }}">
                        <div class="rounded-bottom bg-light">
                            <div class="d-flex justify-content-between p-4 pb-2">
                                <span class="pe-2 text-dark"><i class="fa fa-user me-2"></i>By Admin</span>
                                <span class="text-dark"><i class="fas fa-calendar-alt me-2"></i>{{ date('d F Y', strtotime($berita->created_at)) }}</span>
                            </div>
                            <div class="px-4 pb-0">
                                <h4>{{ $berita->judul }}</h4>
                                <p>{{ substr($berita->deskripsi, 0, 350) }}...</p>
                            </div>
                            <div class="p-4 py-2 d-flex justify-content-between bg-primary rounded-bottom blog-btn">
                                Selengkapnya
                                <span><i class="fa fa-comments me-2"></i>23 Comments</span>
                            </div>
                    </a>
                </div>
        </div>
        @endforeach
    </div>
</div>

</div>
<!-- Blog End -->
