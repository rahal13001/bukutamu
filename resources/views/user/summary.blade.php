@extends('layouts.user')
@section('judul', 'Buku Tamu LPSPL Sorong')
@section('isi')

<div class="container mt-5">
  @if (session('status'))
  <div class="alert alert-success">
      {{ session ('status') }}
  </div>
  @endif
    <section>
    <form action="{{ route('simpanbukutamu') }}" method="post" class="user">
        @csrf

        <div class="form-group mt-3">
        <label for="nama">Nama</label>
          <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukan Nama" value="{{ old('nama') }}">
          @error('nama') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="form-group mt-3">
        <label for="judul">Judul Kegiatan</label>
          <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" placeholder="Masukan Judul Kegiatan" value="{{ old('judul') }}">
          @error('judul') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>
        <div class="form-group mt-3">
        <label for="judul">Nomor Surat Tugas</label>
          <input type="text" class="form-control @error('no_st') is-invalid @enderror" name="no_st" id="no_st" placeholder="Masukan Nomor Surat Tugas" value="{{ old('no_st') }}">
          @error('no_st') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>

        <div class="form-group mt-3">
        <label for="instansi">Instansi Yang Terlibat</label>
          <input type="text" class="form-control @error('instansi') is-invalid @enderror" name="instansi" id="instansi" placeholder="Masukan Asal Instansi" value="{{ old('instansi') }}">
          @error('instansi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
        </div>

        <div class="form-group mt-3">
        <label for="peserta">Jumlah Peserta</label>
          <input type="text" class="form-control @error('peserta') is-invalid @enderror" name="peserta" id="peserta" placeholder="Masukan Estimasi Jumlah Peserta" value="{{ old('peserta') }}">
          @error('peserta') <div class="invalid-feedback"> {{ $message }} </div> @enderror
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
            <label for="iku">Dukungan Indikator Kinerja Utama (IKU) LPSPL Sorong</label>
            <select class="form-select @error('iku') is-invalid @enderror" aria-label="iku" name="iku">
                <option selected value="{{ old('iku') }}">Pilih Lokasi Satker Tujuan</option>
                <option value="Sorong">Sorong</option>
                <option value="Merauke">Merauke</option>
                <option value="Ambon">Ambon</option>
                <option value="Ternate">Ternate</option>
                <option value="Morotai">Morotai</option>
              </select>
              @error('iku') <div class="invalid-feedback"> {{ $message }} </div> @enderror


          <div class="form-group mt-3">
            <label for="keperluan">Keperluan</label>
              <input type="text" class="form-control @error('keperluan') is-invalid @enderror" name="keperluan" id="keperluan" placeholder="Masukan Keperluan" value="{{ old('keperluan') }}">
              @error('keperluan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2" name="btnIn" value="1">Datang</button>
            <button type="submit" class="btn btn-danger mt-2 ml-4 float-right" name="btnOut" value="1">Pulang</button>
        </form>
    </section>
</div>

@endsection