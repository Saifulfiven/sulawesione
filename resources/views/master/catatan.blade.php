                    ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
                    ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                    ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                    ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                    ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                    ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                    ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                        ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                        'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                        'kandidats.namakandidat',
                        'timpenggunas.nama as namapengguna')
                    ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
                    ->Where('pemilihs.id_dapil', '=', $id_dapil)
                    ->Where('pemilihs.id_timinti', '=', $id_surveyor)
                    ->Where('dapils.jeniskandidat','=','pilkab')->get();


                                @if(session('berhasil_login_operator'))
              @include('master.wilayahoperator')