  <!-- Navbar Start -->
        <div class="container-fluid bg-dark">
            <div class="container">
                <nav class="navbar navbar-dark navbar-expand-lg py-lg-0">
                    <a href="/" class="navbar-brand">
                        <img src="img/bendera.png" class="img-fluid w-100 rounded-top" style="width:40%" alt="">

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
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">One Team</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="/timinti">Tim Inti</a></li>
                                            <li><a class="dropdown-item" href="/pendukung">Pendukung</a></li>
                                            <li><a class="dropdown-item" href="/dtd">Dapil DPRD</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="/jakarta">JakartaOne</a></li>
                                    <li><a class="dropdown-item" href="/palembang">PalembangOne</a></li>
                                </ul>
                            </li>
                            <a href="/#fitur" class="nav-item nav-link">Fitur</a>
                            <a href="/#berita" class="nav-item nav-link">Berita</a>
                           
                                @if (session('jeniskandidat') == 'pilgub')
                                    @if(session('jenistim') == 'A')
                                    <a href="/tambahpendukungpilgub" class="nav-item nav-link">Pendukung</a>
                                    @endif
                                    <a href="/dtd" class="nav-item nav-link">DTD</a>
                                    <a href="/pengguna/logout" class="nav-item nav-link">Logout</a>
                                    <span>{{ session('namapengguna') }}</span>
                                @elseif (session('jeniskandidat') == 'pilkab')
                                    @if(session('jenistim') == 'A')
                                    <a href="/tambahpendukung" class="nav-item nav-link">Pendukung</a>
                                    @endif
                                    <a href="/dtd" class="nav-item nav-link">DTD</a>
                                    <a href="/pengguna/logout" class="nav-item nav-link">Logout</a>
                                    <span>{{ session('namapengguna') }}</span>
                                @else                                
                                    <a href="/dataform" class="nav-item nav-link">+ Tim Inti</a>
                                    <a href="/pengguna/login" class="nav-item nav-link">Login</a>
                                @endif

                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->