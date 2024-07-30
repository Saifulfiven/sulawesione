  <style>
    .navbar-dark .navbar-nav .nav-link:hover {
        background-color: green;
        color: white;
    }
</style>
  <!-- Navbar Start -->
        <div class="container-fluid bg-dark">
            <div class="container">
                <nav class="navbar navbar-dark navbar-expand-lg py-lg-0">
                    <a href="/" class="navbar-brand">
                        <img src="img/icon-cer1.png" class="img-fluid rounded-top" style="width:50%" alt="">

                        <!-- <h1 class="text-primary mb-0 display-5">Nobel<span class="text-white">Institute</span> -->
                    </a>
                    <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-dark"></span>
                    </button>
                    <div class="collapse navbar-collapse me-n3" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="/home" class="nav-item nav-link active">Home</a>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span style="color:white">Indonesia</span> <span style="color:red">One</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">JakartaOne</a>
                                    <ul style="list-style-type: none;">
                                            <li><a href="/dataform/timinti/jakarta" class="text-dark">
                                                <span style="display:block;padding:2px">Tim Inti</span></a>
                                            </li>
                                            
                                            @if (session('jeniskandidat') == 'pilgub')
                                                @if(session('jenistim') == 'A')
                                                <li><a href="/tambahpendukungpilgub" class="text-dark">
                                                    <span style="display:block;padding:2px">GPendukung
                                                    </span>
                                                    </a>
                                                </li>
                                                @endif
                                                <li><a href="/dtd" class="text-dark">
                                                    <span style="display:block;padding:2px">DTD
                                                    </span>
                                                    </a>
                                                </li>
                                            @elseif (session('jeniskandidat') == 'pilkab')
                                                @if(session('jenistim') == 'A')
                                                <a href="/tambahpendukung" class="nav-item nav-link">WPendukung</a>
                                                @endif
                                                <a href="/dtd" class="nav-item nav-link">DTD</a>
                                                <a href="/pengguna/logout" class="nav-item nav-link">Logout</a>
                                                <span>{{ session('namapengguna') }}</span>
                                            @else
                                                <span style="display:block;padding:2px">Pendukung</span></a></li>
                                                <li><a href="#" class="text-dark">
                                                <span style="display:block;padding:2px">DTD</span></a></li>
                                            @endif

                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="#">SumatraOne</a>
                                    <ul>
                                        <li><a href="/dataform/timinti/sumatera-selatan" class="text-dark" style="transition: all .3s ease-in-out;">
                                            <span style="display:block;padding:2px">Tim Inti</span></a></li>
                                            <li><a href="#" class="text-dark" style="transition: all .3s ease-in-out;">
                                            <span style="display:block;padding:2px">Pendukung</span></a></li>
                                            <li><a href="#" class="text-dark" style="transition: all .3s ease-in-out;">
                                            <span style="display:block;padding:2px">DTD</span></a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="#">GorontaloOne</a>
                                    <ul>
                                        <li><a href="/dataform/timinti/gorontalo" class="text-dark" style="transition: all .3s ease-in-out;">
                                            <span style="display:block;padding:2px">Tim Inti</span></a></li>
                                            <li><a href="#" class="text-dark" style="transition: all .3s ease-in-out;">
                                            <span style="display:block;padding:2px">Pendukung</span></a></li>
                                            <li><a href="#" class="text-dark" style="transition: all .3s ease-in-out;">
                                            <span style="display:block;padding:2px">DTD</span></a></li>
                                    </ul>
                                </li>
                                </ul>
                            </li>
                            <a href="/#fitur" class="nav-item nav-link">Fitur</a>
                            <a href="/#berita" class="nav-item nav-link">Berita</a>
                           
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->