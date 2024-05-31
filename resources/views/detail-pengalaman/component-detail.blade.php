
<div class="container my-5">
    <h2 class="text-center mb-4">{{ $detailjudulhalaman }}</h2>
    <div class="row">
        <!-- Card 1 -->
        
    @php
        $jumlahKonten = 20;
        $kontenTampil = 3;
        $kontenPerKlik = 6;
    @endphp

    <div class="row" id="kontenPengalaman">
        @for ($i = 0; $i < $jumlahKonten; $i++)
            <div class="col-md-4 {{ $i >= $kontenTampil ? 'd-none' : '' }} mb-4" id="card-{{ $i }}">
                <div class="card" style="transition: transform .2s; margin-bottom: 5px;">
                    <div class="card-img-overlay d-flex flex-column justify-content-end" style="transition: background-color .2s;">
                        <h5 class="card-title">Tony Uloli</h5>    
                        <p class="card-text text-white">Walikota Gorontalo</p>
                    </div>
                    <img src="images/caleg/toni.jpg" class="card-img-top" alt="Gambar 4">
                    <style>
                        .card:hover {
                            transform: scale(1.05);
                            cursor: pointer;
                        }
                        .card-img-overlay:hover {
                            background-color: rgba(0, 0, 0, 0.5);
                        }
                    </style>
                </div>
            </div>
        @endfor
    </div>

    <button class="btn btn-primary text-white mt-3" onclick="tampilkanLebihBanyak()" style="letter-spacing: 5px;">LIHAT LAINNYA</button>

    <script>
        let kontenTampil = {{ $kontenTampil }};
        const jumlahKonten = {{ $jumlahKonten }};
        const kontenPerKlik = {{ $kontenPerKlik }};

        function tampilkanLebihBanyak() {
            const batas = kontenTampil + kontenPerKlik;
            for (let i = kontenTampil; i < batas && i < jumlahKonten; i++) {
                document.getElementById('card-' + i).classList.remove('d-none');
            }
            kontenTampil += kontenPerKlik;
            if (kontenTampil >= jumlahKonten) {
                document.querySelector('button').style.display = 'none';
            }
        }
    </script>


    </div>
</div>
