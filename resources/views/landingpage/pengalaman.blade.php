<style>

        .content {
            border: 1px dotted #ccc;
            padding:5px;

        }
        .pagination {
            display: inline-block;
        }
        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }
        .pagination a:hover:not(.active) {background-color: #ddd;}

        .bg-pengalaman {
    background-image: url("/img/bg-pengalaman.jpg");
    background-repeat: no-repeat;
  background-size: cover;
}
    </style>
<!-- Blog Start -->
        <div class="container-fluid py-5 bg-pengalaman">
            <div class="container py-5">
                <div class="text-center mb-5 wow fadeInUp" data-wow-delay=".3s">
                    <h1 class="display-5">Kenali Mereka !</h1>
                </div>

                <span style="font-family: Arial, sans-serif; font-size: 22px;" class="mb-5"> Baca cerita hidup mereka dan ketahui apa yang mendorong mereka</span>

                <div class="container">

    <?php
    // Konfigurasi pagination
    $perPage = 1; // Jumlah konten per halaman
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
    $start = ($page - 1) * $perPage; // Item pertama yang akan ditampilkan

    // Contoh data (bisa diganti dengan data dari database)
    $data = array(
        array("title" => "Tonny Uloli", "content" => "Isi Konten 1",'image' => 'img/toni.jpg'),
        array("title" => "H Ramli Anwar", "content" => "Isi Konten 2",'image' => 'img/hjramli.jpg'),
        array("title" => "Belum Ada", "content" => "Isi Konten 3",'image' => 'img/kosong.jpg'),
        array("title" => "Tonny Uloli", "content" => "Isi Konten 4",'image' => 'img/toni.jpg'),
        array("title" => "H Ramli Anwar", "content" => "Isi Konten 5",'image' => 'img/hjramli.jpg'),
    );
    ?>


                <div class="content rounded">
                    <div class="row align-items-center">

                        <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                            <img src="<?php echo $data[$start]["image"] ?>" class="img-fluid rounded" alt="Acara">
                        </div>

                        <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                            <h2 class="mb-4" style="color: blue;">Calon Gubernur Provinsi Gorontalo 2024</h2>
                            <p><i>
                            <?php $data[$start]["content"] ?>
                            </i></p>
                            <h1 class="mb-4" style="color: #ee2122;"><?php echo $data[$start]["title"] ?></h1>
                            <span> Gorontalo </span><br>

                            <span><b>Profil Kandidat</b></span><br>

                            @if($ceritalain)
                            <a href="/pengalaman" class="btn btn-primary mt-3" style="letter-spacing: 5px;color:white">TEMUKAN CERITA YANG LAIN</a>
                            @endif
                            <?php

                            if($navhalaman){
                            // Pagination links
                            echo '<br><div class="pagination">';
                            if ($page > 1) {
                                echo '<a href="?page=' . ($page - 1) . '">Previous</a>';
                            }
                            if ($start + $perPage < count($data)) {
                                echo '<a href="?page=' . ($page + 1) . '">Next</a>';
                            }
                            echo '</div>';
                            }
                            ?>

                        </div>

                    </div>
                </div>



            </div>
        </div>
                        </div>
        <!-- Blog End -->
