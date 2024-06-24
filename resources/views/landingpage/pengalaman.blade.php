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
        display: flex;
    }

    .slide img {
        width: 40%;
        height: auto;
        border-radius: 10px 0 0 10px;
    }

    .student-info {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 60%;
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

        <div class="content rounded">
            <div class="row align-items-center">
                <div class="col-md-12">
<div class="slider">
    <div class="slides">
        <div class="slide">
            <img src="img/toni.jpg" alt="Student Photo">
            <div class="student-info">
                <h1>H. Tonny Uloli, S.E., M.M. </h1>
                <h2>Calon Gubernur Gorontalo</h2>
                <p style="margin-top:200px;color: #d6d6d6">Sulawesione</p>
            </div>
        </div>
        <div class="slide">
            <img src="img/hjramli.jpg" alt="Student Photo">
            <div class="student-info">
                <h1>Ramli Anwar</h1>
                <h2>Calon Walikota Gorontalo</h2>
                <p style="margin-top:200px;color: #d6d6d6">Sulawesione</p>
            </div>
        </div>
        <!-- Tambahkan slide lain sesuai kebutuhan -->
    </div>
    <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
    <button class="next" onclick="changeSlide(1)">&#10095;</button>
</div>
                </div>
            </div>
        </div>
    </div></div>

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
