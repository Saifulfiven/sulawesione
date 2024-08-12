<style>
    .slider {
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border-radius: 10px;
        
    }

    .slides {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slide {
        min-width: 100%;
        box-sizing: border-box;
        
    }

    .slide img {
        width: 100%;
        border-radius: 10px 0 0 10px;
    }

    .student-info {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        
    }

    .student-info h3 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .student-info p {
        margin: 5px 0;
        font-size: 14px;
        color: #666;
    }

    button.prev, button.next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 50%;
        font-size: 18px;
    }

    button.prev {
        left: 10px;
    }

    button.next {
        right: 10px;
    }

    button.prev:hover, button.next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .bg-pengalaman {
        background-image: url("/img/bg-pengalaman.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>


<div class="container-fluid py-5 bg-pengalaman">
    <div class="container py-5">

        <div class="row">

            
                <div class="col-md-6">
                    <div class="slider">
                        <div class="slides">
                            <div class="slide">
                                <div class="col-md-12 col-xs-12">
                                    <img src="img/profilanisbaswedan.jpeg" alt="">
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="student-info">
                                        <h3>H. Anies Rasyid Baswedan, S.E., M.P.P., Ph.D.</h3>
                                        <p>Calon Gubernur Jakarta</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="slide">
                            <div class="col-md-12 col-xs-12">
                                    <img src="img/profiltoni.jpg" alt="">
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="student-info">
                                        <h3>H. Tonny Uloli, S.E., M.M.</h3>
                                        <p>Calon Gubernur Gorontalo</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="slide">
                                <div class="col-md-12 col-xs-12">
                                    <img src="img/profilhjramli.jpg" alt="">
                                </div>
                                <div class="col-md-12 col-xs-12">
                                <div class="student-info">
                                    <h3>Haji Ramli Anwar</h3>
                                    <p>Calon Walikota Gorontalo</p>
                                </div>
                                </div>
                            </div>

                            <div class="slide">
                                <div class="col-md-12 col-xs-12">
                                    <img src="/img/andiislamuddinbone.jpg" alt="">
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="student-info">
                                        <h3>Drs. H. Andi Islamuddin, M.H.</h3>
                                        <p>Calon Bupati Kabupaten Bone</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
                        <button class="next" onclick="changeSlide(1)">&#10095;</button>
                    </div>
                </div>
            
        

                <div class="col-md-6">
                    <br>
                    <h3 class="mb-4">Kenali Kandidat</h3>
                    
                    <hr>
                    <p class="lead">
                        Strategi dengan mengelola persepsi masyarakat (people perception)
                        secara tepat, dapat memberikan jalan dalam meningkatkan partisipasi.
                    </p>
                    <p>
                        Dengan strategi ini, kamu akan dapat memperoleh gambaran lebih dini tentang
                        figura calon Pemimpin daerah yang akan dipilih oleh masyarakat.
                    </p>
                    <p>
                        Estimasi tingkat partisipasi secara lebih akurat dan tingkat loyalitas peserta
                        terhadap calon yang dipilih dapat dilakukan dengan mudah.
                    </p>
                </div>

            
        </div>
    </div>
</div>

<script>
    let currentIndex = 0;

    function changeSlide(direction) {
        const slides = document.querySelector('.slides');
        const totalSlides = slides.children.length;

        currentIndex += direction;

        if (currentIndex >= totalSlides) {
            currentIndex = 0;
        } else if (currentIndex < 0) {
            currentIndex = totalSlides - 1;
        }

        const offset = -currentIndex * 100;
        slides.style.transform = `translateX(${offset}%)`;
    }

    // Optional: Automatic slide change every 5 seconds
    setInterval(() => {
        changeSlide(1);
    }, 5000);
</script>

