<script>
    var x = document.createElement('script');
    x.src = 'https://www.googleapis.com/maps/api/js?key=AIzaSyA7Z3130k0_GmY7KNp_10FK00H6lc3B8qs&callback=getLocation&libraries=places&v=weekly';
    document.body.appendChild(x);

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        document.getElementById('latitude').value = position.coords.latitude;
        document.getElementById('longitude').value = position.coords.longitude;
    }
    getLocation();
    showPosition();
</script>


<div class="step">
                        <h4>Kuesioner II</h4>
                        
    Latitude : <div id="latitude"></div>
    
    Longitude : <div id="longitude"></div>
                        <div class="form-group">
                            <label>11. Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan
                                anda saat ini? <span class="text-wajib">(wajib diisi)</span></label>
                            
                            <div class="form-check ps-0 q-box">
                                <div class="q-box__question">
                                    <input class="form-check-input question__input" id="sebelas_1" name="seblas" type="radio" value="1"> 
                                    <label class="form-check-label question__label" for="sebelas_1">Setingkat Lebih Tinggi </label>
                                </div>
                                <div class="q-box__question">
                                    <input checked class="form-check-input question__input" id="sebelas_2" name="seblas" type="radio" value="2"> 
                                    <label class="form-check-label question__label" for="sebelas_2">Tingkat yang Sama</label>
                                </div>
                                <div class="q-box__question">
                                    <input checked class="form-check-input question__input" id="sebelas_3" name="seblas" type="radio" value="3"> 
                                    <label class="form-check-label question__label" for="sebelas_3">Setingkat Lebih Rendah</label>
                                </div>
                                <div class="q-box__question">
                                    <input checked class="form-check-input question__input" id="sebelas_4" name="seblas" type="radio" value="4"> 
                                    <label class="form-check-label question__label" for="sebelas_4">Tidak Perlu Pendidikan Tinggi</label>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group">
                                <label>12. Pada saat lulus, pada tingkat mana kompetensi di bawah ini anda : kuasai?
                                    Pada
                                    saat ini, pada tingkat mana kompetensi di bawah ini diperlukan dalam
                                    pekerjaan? <span class="text-wajib">(wajib diisi)</span></label>
                                <table style="width: 100%">
                                    <tbody><tr style="border-bottom: 1px solid #9e9e9eab;height: 45px;font-weight: 700">
                                        <td colspan="8">A</td>
                                        <td></td>
                                        <td colspan="4">B</td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #9e9e9eab;height: 60px;font-weight: 700">
                                        <td colspan="3">Sangat Rendah</td>
                                        <td colspan="3">Sangat Tinggi</td>
                                        <td colspan="3">
                                            <div style="width: 100px"></div>
                                        </td>
                                        <td colspan="3">Sangat Rendah</td>
                                        <td colspan="3">Sangat Tinggi</td>
                                    </tr>

                                    <tr style="border-bottom: 1px solid #9e9e9eab;height: 45px;font-weight: 700">
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td colspan="4">
                                            <div style="width: 100px"></div>
                                        </td>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>


                                    <tr style="border-bottom: 1px solid #9e9e9eab;height: 45px">
                                        <td><input type="radio" name="duabelasaetika" value="1"></td>
                                        <td><input type="radio" name="duabelasaetika" value="2"></td>
                                        <td><input type="radio" name="duabelasaetika" value="3"></td>
                                        <td><input type="radio" name="duabelasaetika" value="4"></td>
                                        <td><input type="radio" name="duabelasaetika" value="5"></td>
                                        <td colspan="4">
                                            <div style="width: 100px">Etika</div>
                                        </td>
                                        <td><input type="radio" name="duabelasbetika" value="1"></td>
                                        <td><input type="radio" name="duabelasbetika" value="2"></td>
                                        <td><input type="radio" name="duabelasbetika" value="3"></td>
                                        <td><input type="radio" name="duabelasbetika" value="4"></td>
                                        <td><input type="radio" name="duabelasbetika" value="5"></td>
                                    </tr>


                                    <tr style="border-bottom: 1px solid #9e9e9eab;height: 45px">
                                        <td><input type="radio" name="duabelasakeahlian" value="1"></td>
                                        <td><input type="radio" name="duabelasakeahlian" value="2"></td>
                                        <td><input type="radio" name="duabelasakeahlian" value="3"></td>
                                        <td><input type="radio" name="duabelasakeahlian" value="4"></td>
                                        <td><input type="radio" name="duabelasakeahlian" value="5"></td>
                                        <td colspan="4">
                                            <div>Keahlian berdasarkan bidang ilmu</div>
                                        </td>
                                        <td><input type="radio" name="duabelasbkeahlian" value="1"></td>
                                        <td><input type="radio" name="duabelasbkeahlian" value="2"></td>
                                        <td><input type="radio" name="duabelasbkeahlian" value="3"></td>
                                        <td><input type="radio" name="duabelasbkeahlian" value="4"></td>
                                        <td><input type="radio" name="duabelasbkeahlian" value="5"></td>
                                    </tr>


                                    <tr style="border-bottom: 1px solid #9e9e9eab;height: 45px">
                                        <td><input type="radio" name="duabelasainggris" value="1"></td>
                                        <td><input type="radio" name="duabelasainggris" value="2"></td>
                                        <td><input type="radio" name="duabelasainggris" value="3"></td>
                                        <td><input type="radio" name="duabelasainggris" value="4"></td>
                                        <td><input type="radio" name="duabelasainggris" value="5"></td>
                                        <td colspan="4">
                                            <div>Bahasa Inggris</div>
                                        </td>
                                        <td><input type="radio" name="duabelasbinggris" value="1"></td>
                                        <td><input type="radio" name="duabelasbinggris" value="2"></td>
                                        <td><input type="radio" name="duabelasbinggris" value="3"></td>
                                        <td><input type="radio" name="duabelasbinggris" value="4"></td>
                                        <td><input type="radio" name="duabelasbinggris" value="5"></td>
                                    </tr>


                                    <tr style="border-bottom: 1px solid #9e9e9eab;height: 45px">
                                        <td><input type="radio" name="duabelasatekonologi" value="1"></td>
                                        <td><input type="radio" name="duabelasatekonologi" value="2"></td>
                                        <td><input type="radio" name="duabelasatekonologi" value="3"></td>
                                        <td><input type="radio" name="duabelasatekonologi" value="4"></td>
                                        <td><input type="radio" name="duabelasatekonologi" value="5"></td>
                                        <td colspan="4">
                                            <div>Penggunaan Teknologi Informasi</div>
                                        </td>
                                        <td><input type="radio" name="duabelasbtekonologi" value="1"></td>
                                        <td><input type="radio" name="duabelasbtekonologi" value="2"></td>
                                        <td><input type="radio" name="duabelasbtekonologi" value="3"></td>
                                        <td><input type="radio" name="duabelasbtekonologi" value="4"></td>
                                        <td><input type="radio" name="duabelasbtekonologi" value="5"></td>
                                    </tr>


                                    <tr style="border-bottom: 1px solid #9e9e9eab;height: 45px">
                                        <td><input type="radio" name="duabelasakomunikasi" value="1"></td>
                                        <td><input type="radio" name="duabelasakomunikasi" value="2"></td>
                                        <td><input type="radio" name="duabelasakomunikasi" value="3"></td>
                                        <td><input type="radio" name="duabelasakomunikasi" value="4"></td>
                                        <td><input type="radio" name="duabelasakomunikasi" value="5"></td>
                                        <td colspan="4">
                                            <div>Komunikasi</div>
                                        </td>
                                        <td><input type="radio" name="duabelasbkomunikasi" value="1"></td>
                                        <td><input type="radio" name="duabelasbkomunikasi" value="2"></td>
                                        <td><input type="radio" name="duabelasbkomunikasi" value="3"></td>
                                        <td><input type="radio" name="duabelasbkomunikasi" value="4"></td>
                                        <td><input type="radio" name="duabelasbkomunikasi" value="5"></td>
                                    </tr>


                                    <tr style="border-bottom: 1px solid #9e9e9eab;height: 45px">
                                        <td><input type="radio" name="duabelasasamatim" value="1"></td>
                                        <td><input type="radio" name="duabelasasamatim" value="2"></td>
                                        <td><input type="radio" name="duabelasasamatim" value="3"></td>
                                        <td><input type="radio" name="duabelasasamatim" value="4"></td>
                                        <td><input type="radio" name="duabelasasamatim" value="5"></td>
                                        <td colspan="4">
                                            <div>Kerja sama tim</div>
                                        </td>
                                        <td><input type="radio" name="duabelasbsamatim" value="1"></td>
                                        <td><input type="radio" name="duabelasbsamatim" value="2"></td>
                                        <td><input type="radio" name="duabelasbsamatim" value="3"></td>
                                        <td><input type="radio" name="duabelasbsamatim" value="4"></td>
                                        <td><input type="radio" name="duabelasbsamatim" value="5"></td>
                                    </tr>


                                    <tr style="border-bottom: 1px solid #9e9e9eab;height: 45px">
                                        <td><input type="radio" name="duabelasapengembangan" value="1"></td>
                                        <td><input type="radio" name="duabelasapengembangan" value="2"></td>
                                        <td><input type="radio" name="duabelasapengembangan" value="3"></td>
                                        <td><input type="radio" name="duabelasapengembangan" value="4"></td>
                                        <td><input type="radio" name="duabelasapengembangan" value="5"></td>
                                        <td colspan="4">
                                            <div>Pengembangan</div>
                                        </td>
                                        <td><input type="radio" name="duabelasbpengembangan" value="1"></td>
                                        <td><input type="radio" name="duabelasbpengembangan" value="2"></td>
                                        <td><input type="radio" name="duabelasbpengembangan" value="3"></td>
                                        <td><input type="radio" name="duabelasbpengembangan" value="4"></td>
                                        <td><input type="radio" name="duabelasbpengembangan" value="5"></td>
                                    </tr>

                                </tbody></table>

                            </div>

                            <!-- Pertanyaan 4 -->
                            <div class="form-group">
                                <label>13. Menurut anda seberapa besar penekanan pada metode pembelajaran dibawah ini
                                    dilaksanakan di program studi anda ?</label>
                                <div class="row custom-radio px-4">
                                    <div class="col-12 col-md-4 pt-4">

                                        <div class="font-bold">Perkuliahan</div>
                                        <input name="tigabelasperkuliahan" type="radio" id="tigabelasperkuliahan" value="1">
                                        <label for="tigabelasperkuliahan">Sangat Besar</label><br>

                                        <input name="tigabelasperkuliahan" type="radio" id="tigabelasperkuliahan" value="2">
                                        <label for="tigabelasperkuliahan">Besar</label><br>

                                        <input name="tigabelasperkuliahan" type="radio" id="tigabelasperkuliahan" value="3">
                                        <label for="tigabelasperkuliahan">Cukup Besar</label><br>

                                        <input name="tigabelasperkuliahan" type="radio" id="tigabelasperkuliahan" value="4">
                                        <label for="tigabelasperkuliahan">Kurang Besar</label><br>

                                        <input name="tigabelasperkuliahan" type="radio" id="tigabelasperkuliahan" value="5">
                                        <label for="tigabelasperkuliahan">Tidak sama sekali</label><br>

                                    </div>

                                    <div class="col-12 col-md-4 pt-4">

                                        <div class="font-bold">Demonstrasi</div>
                                        <input name="tigabelasdemonstrasi" type="radio" id="tigabelasdemonstrasi" value="1">
                                        <label for="tigabelasdemonstrasi">Sangat Besar</label><br>

                                        <input name="tigabelasdemonstrasi" type="radio" id="tigabelasdemonstrasi" value="2">
                                        <label for="tigabelasdemonstrasi">Besar</label><br>

                                        <input name="tigabelasdemonstrasi" type="radio" id="tigabelasdemonstrasi" value="3">
                                        <label for="tigabelasdemonstrasi">Cukup Besar</label><br>

                                        <input name="tigabelasdemonstrasi" type="radio" id="tigabelasdemonstrasi" value="4">
                                        <label for="tigabelasdemonstrasi">Kurang Besar</label><br>

                                        <input name="tigabelasdemonstrasi" type="radio" id="tigabelasdemonstrasi" value="5">
                                        <label for="tigabelasdemonstrasi">Tidak sama sekali</label><br>

                                    </div>

                                    <div class="col-12 col-md-4 pt-4">

                                        <div class="font-bold">Partisipasi dalam proyek riset</div>
                                        <input name="tigabelaspartisipasi" type="radio" id="tigabelaspartisipasi" value="1">
                                        <label for="tigabelaspartisipasi">Sangat Besar</label><br>

                                        <input name="tigabelaspartisipasi" type="radio" id="tigabelaspartisipasi" value="2">
                                        <label for="tigabelaspartisipasi">Besar</label><br>

                                        <input name="tigabelaspartisipasi" type="radio" id="tigabelaspartisipasi" value="3">
                                        <label for="tigabelaspartisipasi">Cukup Besar</label><br>

                                        <input name="tigabelaspartisipasi" type="radio" id="tigabelaspartisipasi" value="4">
                                        <label for="tigabelaspartisipasi">Kurang Besar</label><br>

                                        <input name="tigabelaspartisipasi" type="radio" id="tigabelaspartisipasi" value="5">
                                        <label for="tigabelaspartisipasi">Tidak sama sekali</label><br>

                                    </div>
                                </div>

                                <div class="row custom-radio px-4">
                                    <div class="col-12 col-md-4 pt-4">

                                        <div class="font-bold">Magang</div>
                                        <input name="tigabelasmagang" type="radio" id="tigabelasmagang" value="1">
                                        <label for="tigabelasmagang">Sangat Besar</label><br>

                                        <input name="tigabelasmagang" type="radio" id="tigabelasmagang" value="2">
                                        <label for="tigabelasmagang">Besar</label><br>

                                        <input name="tigabelasmagang" type="radio" id="tigabelasmagang" value="3">
                                        <label for="tigabelasmagang">Cukup Besar</label><br>

                                        <input name="tigabelasmagang" type="radio" id="tigabelasmagang" value="4">
                                        <label for="tigabelasmagang">Kurang Besar</label><br>

                                        <input name="tigabelasmagang" type="radio" id="tigabelasmagang" value="5">
                                        <label for="tigabelasmagang">Tidak sama sekali</label><br>

                                    </div>

                                    <div class="col-12 col-md-4 pt-4">

                                        <div class="font-bold">Praktikum</div>
                                        <input name="tigabelaspraktikum" type="radio" id="tigabelaspraktikum" value="1">
                                        <label for="tigabelaspraktikum">Sangat Besar</label><br>

                                        <input name="tigabelaspraktikum" type="radio" id="tigabelaspraktikum" value="2">
                                        <label for="tigabelaspraktikum">Besar</label><br>

                                        <input name="tigabelaspraktikum" type="radio" id="tigabelaspraktikum" value="3">
                                        <label for="tigabelaspraktikum">Cukup Besar</label><br>

                                        <input name="tigabelaspraktikum" type="radio" id="tigabelaspraktikum" value="4">
                                        <label for="tigabelaspraktikum">Kurang Besar</label><br>

                                        <input name="tigabelaspraktikum" type="radio" id="tigabelaspraktikum" value="5">
                                        <label for="tigabelaspraktikum">Tidak sama sekali</label><br>

                                    </div>

                                    <div class="col-12 col-md-4 pt-4">

                                        <div class="font-bold">Kerja Lapangan</div>
                                        <input name="tigabelaskerja" type="radio" id="tigabelaskerja" value="1">
                                        <label for="tigabelaskerja">Sangat Besar</label><br>

                                        <input name="tigabelaskerja" type="radio" id="tigabelaskerja" value="2">
                                        <label for="tigabelaskerja">Besar</label><br>

                                        <input name="tigabelaskerja" type="radio" id="tigabelaskerja" value="3">
                                        <label for="tigabelaskerja">Cukup Besar</label><br>

                                        <input name="tigabelaskerja" type="radio" id="tigabelaskerja" value="4">
                                        <label for="tigabelaskerja">Kurang Besar</label><br>

                                        <input name="tigabelaskerja" type="radio" id="tigabelaskerja" value="5">
                                        <label for="tigabelaskerja">Tidak sama sekali</label><br>

                                    </div>
                                </div>

                                <div class="row custom-radio px-4">
                                    <div class="col-12 col-md-4 pt-4">

                                        <div class="font-bold">Diskusi</div>
                                        <input name="tigabelasdiskusi" type="radio" id="tigabelasdiskusi" value="1">
                                        <label for="tigabelasdiskusi">Sangat Besar</label><br>

                                        <input name="tigabelasdiskusi" type="radio" id="tigabelasdiskusi" value="2">
                                        <label for="tigabelasdiskusi">Besar</label><br>

                                        <input name="tigabelasdiskusi" type="radio" id="tigabelasdiskusi" value="3">
                                        <label for="tigabelasdiskusi">Cukup Besar</label><br>

                                        <input name="tigabelasdiskusi" type="radio" id="tigabelasdiskusi" value="4">
                                        <label for="tigabelasdiskusi">Kurang Besar</label><br>

                                        <input name="tigabelasdiskusi" type="radio" id="tigabelasdiskusi" value="5">
                                        <label for="tigabelasdiskusi">Tidak sama sekali</label><br>

                                    </div>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label>14. Kapan anda mulai mencari pekerjaan? Mohon pekerjaan sambilan tidak
                                    dimasukkan <span class="text-wajib">(wajib diisi)</span></label>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="empatbelas_1" name="empatbelas" type="radio" value="1"> 
                                            <label class="form-check-label question__label" for="empatbelas_1">Kira-kira
                                            <input type="number" name="empatbelas_text1">
                                            bulan sebelum lulus </label>
                                        </div>
                                        <div class="q-box__question">
                                            <input checked class="form-check-input question__input" id="empatbelas_2" name="empatbelas" type="radio" value="2"> 
                                            <label class="form-check-label question__label" for="empatbelas_2">Kira-kira
                                            <input type="number" name="empatbelas_text2">
                                            bulan sesudah lulus</label>
                                        </div>
                                        <div class="q-box__question">
                                            <input checked class="form-check-input question__input" id="empatbelas_3" name="empatbelas" type="radio" value="3"> 
                                            <label class="form-check-label question__label" for="empatbelas_3">Saya tidak mencari kerja</label>
                                        </div>
                                    </div>

                            </div>

                            
                            <div class="form-group">
                                <label for="basicInput">15. Bagaimana anda mencari pekerjaan tersebut? Jawaban bisa
                                    lebih
                                    dari satu</label>

                                    <div class="row">
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_1" name="limabelas[]" type="checkbox" value="1"> 
                                            <label class="form-check-label question__label" for="limabelas_1">Melalui iklan di koran/majalah, brosur</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_2" name="limabelas[]" type="checkbox" value="2"> 
                                            <label class="form-check-label question__label" for="limabelas_2">Melamar ke perusahaan tanpa mengetahui lowongan yang
                                                ada</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_3" name="limabelas[]" type="checkbox" value="3"> 
                                            <label class="form-check-label question__label" for="limabelas_3">Pergi ke bursa/pameran kerja</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_4" name="limabelas[]" type="checkbox" value="4"> 
                                            <label class="form-check-label question__label" for="limabelas_4">Mencari lewat internet/iklan online/milis</label>
                                        </div>
                                    </div>

                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_5" name="limabelas[]" type="checkbox" value="5"> 
                                            <label class="form-check-label question__label" for="limabelas_5">Dihubungi oleh perusahaan</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_6" name="limabelas[]" type="checkbox" value="6"> 
                                            <label class="form-check-label question__label" for="limabelas_6">Menghubungi Kemenakertrans</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_7" name="limabelas[]" type="checkbox" value="7"> 
                                            <label class="form-check-label question__label" for="limabelas_7">Menghubungi agen tenaga kerja komersial/swasta</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_8" name="limabelas[]" type="checkbox" value="8"> 
                                            <label class="form-check-label question__label" for="limabelas_8">Memeroleh informasi dari pusat/kantor pengembangan karir
                                                fakultas/universitas</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_9" name="limabelas[]" type="checkbox" value="9"> 
                                            <label class="form-check-label question__label" for="limabelas_9">Menghubungi kantor kemahasiswaan/hubungan alumni</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_10" name="limabelas[]" type="checkbox" value="10"> 
                                            <label class="form-check-label question__label" for="limabelas_10">Membangun jejaring (network) sejak masih kuliah</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_11" name="limabelas[]" type="checkbox" value="11"> 
                                            <label class="form-check-label question__label" for="limabelas_11">Melalui relasi (misalnya dosen, orang tua, saudara, teman,
                                                dll.)</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_12" name="limabelas[]" type="checkbox" value="12"> 
                                            <label class="form-check-label question__label" for="limabelas_12">Membangun bisnis sendiri</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_13" name="limabelas[]" type="checkbox" value="13"> 
                                            <label class="form-check-label question__label" for="limabelas_13">Melalui penempatan kerja atau magang</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_14" name="limabelas[]" type="checkbox" value="14"> 
                                            <label class="form-check-label question__label" for="limabelas_14">Bekerja di tempat yang sama dengan tempat kerja semasa
                                                kuliah</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="limabelas_15" name="limabelas" type="checkbox" value="15"> 
                                            <label class="form-check-label question__label" for="limabelas_15">Lainnya</label>
                                            <input name="limabelaslainnya" type="text" class="form-control rounded-3 mt-2" placeholder="">

                                        </div>
                                    </div>

                                    </div>

                            </div>

                            
                            <div class="form-group">
                                <label for="enambelas">16. Berapa perusahaan/instansi/institusi yang sudah anda lamar (lewat
                                    surat
                                    atau e-mail) sebelum anda memeroleh pekerjaan pertama ?</label>
                                <div class="custom-radio row ms-3 align-items-center">
                                    <div class="col-12 col-md-4">
                                        <input name="enambelas" type="text" placeholder="Contoh : 2 Perusahaan" class="form-control rounded-3 mt-2">
                                    </div>

                                    <div class="text-sm col-12 col-md-8 font-bold text-danger">Perusahaan / Instansi /
                                        Institusi
                                    </div>

                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="tujuhbelas">17. Berapa banyak perusahaan/instansi/institusi yang merespons lamaran
                                    anda</label>
                                <div class="custom-radio row ms-3 align-items-center">
                                    <div class="col-12 col-md-4">
                                        <input name="tujuhbelas" type="text" placeholder="Contoh : 2 Perusahaan" class="form-control rounded-3 mt-2">
                                    </div>

                                    <div class="text-sm col-12 col-md-8 font-bold text-danger">Perusahaan / Instansi /
                                        Institusi
                                    </div>

                                </div>
                            </div>

                            
                            <!-- Pertanyaan ke 18 -->

                            <div class="form-group">
                                <label for="delapanbelas">18. Berapa banyak perusahaan/instansi/institusi yang mengundang anda
                                    untuk
                                    wawancara?</label>
                                <div class="custom-radio row ms-3 align-items-center">
                                    <div class="col-12 col-md-4">
                                        <input name="delapanbelas" type="text" placeholder="Contoh : 2 Perusahaan" class="form-control rounded-3 mt-2">
                                    </div>

                                    <div class="text-sm col-12 col-md-8 font-bold text-danger">Perusahaan / Instansi /
                                        Institusi
                                    </div>

                                </div>
                            </div>

                            <!-- Pertanyaan ke 19 -->
                            <div class="form-group">
                                <label for="basicInput">19. Apakah anda aktif mencari pekerjaan dalam 4 minggu terakhir?
                                    Pilihlah satu jawaban ?</label>
                                    <div class="form-check ps-0 q-box">
                                <div class="q-box__question">
                                    <input class="form-check-input question__input" id="sembilanbelas_1" name="sembilanbelas" type="radio" value="1"> 
                                    <label class="form-check-label question__label" for="sembilanbelas_1">Tidak </label>
                                </div>
                                <div class="q-box__question">
                                    <input checked class="form-check-input question__input" id="sembilanbelas_2" name="sembilanbelas" type="radio" value="2"> 
                                    <label class="form-check-label question__label" for="sembilanbelas_2">Tidak, tapi saya sedang menunggu hasil lamaran kerja</label>
                                </div>
                                <div class="q-box__question">
                                    <input checked class="form-check-input question__input" id="sembilanbelas_3" name="sembilanbelas" type="radio" value="3"> 
                                    <label class="form-check-label question__label" for="sembilanbelas_3">Ya, saya akan mulai bekerja dalam 2 minggu ke depan</label>
                                </div>
                                <div class="q-box__question">
                                    <input checked class="form-check-input question__input" id="sembilanbelas_4" name="sembilanbelas" type="radio" value="4"> 
                                    <label class="form-check-label question__label" for="sembilanbelas_4">Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan</label>
                                </div>
                                <div class="q-box__question">
                                    <input checked class="form-check-input question__input" id="sembilanbelas_5" name="sembilanbelas" type="radio" value="5"> 
                                    <label class="form-check-label question__label" for="sembilanbelas_4">Lainnya</label>
                                    <input name="sembilanbelaslainnya" type="text" class="form-control rounded-3 mt-2" placeholder="">
                                </div>
                                
                                
                            </div>


                            </div>

                            <!-- Pertanyaan ke 20 -->
                            <div class="form-group">
                                <label for="basicInput">20. Jika menurut anda pekerjaan anda saat ini tidak sesuai
                                    dengan :
                                    pendidikan anda, mengapa anda mengambilnya? Jawaban bisa lebih dari satu</label>
                                    <div class="row">
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_1" name="duapuluh[]" type="checkbox" value="1">
                                                <label class="form-check-label question__label" for="duapuluh_1">Pertanyaan tidak sesuai; pekerjaan saya sekarang sudah sesuai dengan pendidikan saya.</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_2" name="duapuluh[]" type="checkbox" value="2">
                                                <label class="form-check-label question__label" for="duapuluh_2">Saya belum mendapatkan pekerjaan yang lebih sesuai</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_3" name="duapuluh[]" type="checkbox" value="3">
                                                <label class="form-check-label question__label" for="duapuluh_3">Di pekerjaan ini saya memeroleh prospek karir yang baik.</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_4" name="duapuluh[]" type="checkbox" value="4">
                                                <label class="form-check-label question__label" for="duapuluh_4">Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya.</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_5" name="duapuluh[]" type="checkbox" value="5">
                                                <label class="form-check-label question__label" for="duapuluh_5">Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya.</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_6" name="duapuluh[]" type="checkbox" value="6">
                                                <label class="form-check-label question__label" for="duapuluh_6">Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini.</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_7" name="duapuluh[]" type="checkbox" value="7">
                                                <label class="form-check-label question__label" for="duapuluh_7">Pekerjaan saya saat ini lebih aman/terjamin/secure</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_8" name="duapuluh[]" type="checkbox" value="8">
                                                <label class="form-check-label question__label" for="duapuluh_8">Pekerjaan saya saat ini lebih menarik</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_9" name="duapuluh[]" type="checkbox" value="9">
                                                <label class="form-check-label question__label" for="duapuluh_9">Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel, dll.</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_10" name="duapuluh[]" type="checkbox" value="10">
                                                <label class="form-check-label question__label" for="duapuluh_10">Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya.</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_11" name="duapuluh[]" type="checkbox" value="11">
                                                <label class="form-check-label question__label" for="duapuluh_11">Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya.</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_12" name="duapuluh[]" type="checkbox" value="12">
                                                <label class="form-check-label question__label" for="duapuluh_12">Pada awal meniti karir ini, saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="duapuluh_13" name="duapuluh[]" type="checkbox" value="13">
                                                <label class="form-check-label question__label" for="duapuluh_13">Lainnya</label>
                                                <input name="duapuluhlainnya" type="text" class="form-control rounded-3 mt-2" placeholder="">

                                            </div>
                                            
                                        </div>
</div>
                            </div>
                    </div>