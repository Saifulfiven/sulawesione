
Kode dibutuhkan
    
menampilkan data kandidat di Form Input
    <div class="form-group">
        <label for="id_kandidat" class="col-sm-2 col-form-label">Nama Kandidat</label>
        <select name="id_kandidat" class="form-control" required>
            <option value="" disabled>--Pilih Kandidat--</option>
            @foreach ($kandidat as $kandidat)
                <option value="{{ $kandidat->id }}">{{ $kandidat->namakandidat }}</option>
            @endforeach
        </select>
    </div> 

menampilkan data kandidat di Form Edit
    <div class="form-group">
        <label for="id_kandidat" class="col-sm-2 col-form-label">Nama Kandidat</label>
        <select name="id_kandidat" class="form-control" required>
            <option value="" disabled>--Pilih Kandidat--</option>
            
        @foreach ($kandidat as $kandidat)
            <option value="{{ $kandidat->id }}" {{ $kandidat->id == $selectedidkandidat ? 'selected' : '' }}>{{ $kandidat->namakandidat }}</option>
        @endforeach
        </select>
    </div>