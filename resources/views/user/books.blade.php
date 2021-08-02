@extends('layouts.user')
@section('judul', 'Buku Tamu LPSPL Sorong')
@section('isi')

<div class="container mt-5">
 
    <section>
      @if (session('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session ('status') }}
      </div>
      @endif
    <form action="{{ route('simpanbukutamu') }}" method="post" class="user">
        @csrf

        <div class="form-group mt-3">
        <label for="nama">Nama</label>
          <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukan Nama" value="{{ old('nama') }}">
          @error('nama') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>

        <div class="form-group mt-3">
        <label for="instansi">Instansi / Lembaga</label>
          <input type="text" class="form-control @error('instansi') is-invalid @enderror" name="instansi" id="instansi" placeholder="Masukan Asal Instansi" value="{{ old('instansi') }}">
          @error('instansi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>

        <div class="form-group mt-3">
        <label for="no_hp">No HP</label>
          <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" placeholder="Masukan Nomor HP" value="{{ old('no_hp') }}">
          @error('no_hp') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>

        <div class="form-group mt-3">
        <label for="email">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukan Alamat Email" value="{{ old('email') }}">
          @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>

        <div class="form-group mt-3">
        <label for="jk">Jenis Kelamin</label>
        <select class="form-select @error('jk') is-invalid @enderror" aria-label="jk" name="jk">
            <option selected value="{{ old('jk') }}">Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
          @error('jk') <div class="invalid-feedback"> {{ $message }} </div> @enderror

          <div class="form-group mt-3">
            <label for="lokasi">Satker Tujuan</label>
            <select class="form-select @error('lokasi') is-invalid @enderror" aria-label="lokasi" name="lokasi">
                <option selected value="{{ old('lokasi') }}">Pilih Lokasi Satker Tujuan</option>
                <option value="Sorong">Sorong</option>
                <option value="Merauke">Merauke</option>
                <option value="Ambon">Ambon</option>
                <option value="Ternate">Ternate</option>
                <option value="Morotai">Morotai</option>
              </select>
              @error('lokasi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
          </div>

          {{-- <div class="form-group mt-3">
            <label for="pegawai">Pihak Yang Ditemui</label>
            <select class="form-select @error('pegawai') is-invalid @enderror" aria-label="pegawai" name="pegawai">
                <option selected value="{{ old('pegawai') }}">Siapa yang Anda Temui ?</option>
                @foreach ($employe as $pgw)
                <option value ="{{$pgw->id}}">{{ $pgw->jabatan }} - {{ $pgw->name }}</option>
                @endforeach
              </select>
              @error('pegawai') <div class="invalid-feedback"> {{ $message }} </div> @enderror
          </div> --}}

          <div class="form-group mt-3">
            <label for="pegawai">Pihak Yang Ditemui</label>
              <input type="text" class="form-control @error('pegawai') is-invalid @enderror" name="pegawai" id="pegawai" placeholder="Masukan Nama Pihak Yang Anda Temui" value="{{ old('pegawai') }}">
              @error('pegawai') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>
          
          <div class="form-group mt-3">
            <label for="keperluan">Keperluan</label>
              <input type="text" class="form-control @error('keperluan') is-invalid @enderror" name="keperluan" id="keperluan" placeholder="Masukan Keperluan" value="{{ old('keperluan') }}">
              @error('keperluan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>
          <div class="form-group mt-3">
            <label for="suhu">Suhu</label>
              <input type="number" class="form-control" name="suhu" id="suhu" placeholder="Masukan Suhu Tubuh Anda" step=".01" value="{{ old('suhu') }}"> @error('suhu') <div class="invalid-feedback"> {{ $message }} </div> @enderror
             </div>

            <button type="submit" class="btn btn-primary mt-3" name="btnIn" value="1">Datang</button>
            <button type="submit" class="btn btn-danger mt-3 ml-4 float-right" name="btnOut" value="1">Pulang</button>
        </form>
    </section>
</div>

@endsection