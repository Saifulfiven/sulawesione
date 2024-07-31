
<style>
    a:hover {
        color: #007bff;
        text-decoration: none;
    }
</style>
<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container py-5">

                <div class="row">

                    <div class="col-lg-8 wow fadeIn" data-wow-delay=".5s">
                        <div class="row wow fadeIn" data-wow-delay=".3s">
                            <img src="images/berita/{{ $berita->gambar }}" class="img-fluid" alt="{{ $berita->slug }}">
                        </div>

                        <div class="d-flex justify-content-between p-4 pb-2">
                                <span class="pe-2 text-dark"><i class="fa fa-user me-2"></i>By Admin</span>
                                <span class="text-dark"><i class="fas fa-calendar-alt me-2"></i>{{ $berita->created_at->format('d F Y') }}</span>
                        </div>

                        <h1 class="mb-4"> {{ $berita->judul }}</h1>
                        <article>
            {!! nl2br(e($berita->deskripsi)) !!}
                        </article>


                    </div>

                    <div class="col-lg-4 wow fadeIn  pt-3 pl-3" data-wow-delay=".3s">
                        <ul class="mt-3 border border-shadow pt-3 pb-4" style="transition: all 0.3s ease-in-out;">
                        <h3>Berita</h3>

                        @foreach($beritas as $item)
                        <li class="mt-2">
                            <a href="{{ url('/'.$item->slug) }}" class="text-dark" style="display: block;" onmouseover="this.style.color='#007bff'; this.style.textDecoration='none'" onmouseout="this.style.color='#212529'; this.style.textDecoration='none'">
                            <span style="transition: all 0.3s ease-in-out;">{{ $item->judul }}</span>
                            </a>
                        </li>
                        @endforeach
                        </ul>
                    </div>

                </div>

    </div>
</div>
        <!-- Blog End -->
