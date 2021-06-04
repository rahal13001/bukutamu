@extends('layouts.layout')

@section('judul', 'Buku Tamu LPSPL Sorong')

@section('isi')

<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">

            <form class="user" method="post" action="{{ route('admin_store') }}" enctype="">
                @csrf
            <div class="form-row mt-3">
                <div class="form-group col-sm-4">
                    <label for="tanggal">Tanggal</label>
                      <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" placeholder="Masukan Nama" value="{{ old('tanggal') }}">
                      @error('tanggal') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>

                <div class="form-group col-sm-4">
                    <label for="datang">Jam Datang</label>
                      <input type="time" class="form-control @error('datang') is-invalid @enderror" name="datang" id="datang" placeholder="Masukan Jam Datang" value="{{ old('datang') }}">
                      @error('datang') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>

                  <div class="form-group col-sm-4">
                    <label for="pulang">Jam Pulang</label>
                      <input type="time" class="form-control @error('pulang') is-invalid @enderror" name="pulang" id="pulang" placeholder="Masukan Jam Pulang" value="{{ old('pulang') }}">
                      @error('pulang') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
            </div>
                
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
                    <select class="form-control form-select @error('jk') is-invalid @enderror" aria-label="jk" name="jk">
                        <option selected value="{{ old('jk') }}">{{ old('jk') }}</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                      @error('jk') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            
                      <div class="form-group mt-3">
                        <label for="lokasi">Satker Tujuan</label>
                        <select class="form-control form-select @error('lokasi') is-invalid @enderror" aria-label="lokasi" name="lokasi">
                            <option selected value="{{ old('lokasi') }}">{{ old('lokasi') }}</option>
                            <option value="Sorong">Sorong</option>
                            <option value="Merauke">Merauke</option>
                            <option value="Ambon">Ambon</option>
                            <option value="Ternate">Ternate</option>
                            <option value="Morotai">Morotai</option>
                          </select>
                          @error('lokasi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            
            
                      <div class="form-group mt-3">
                        <label for="keperluan">Keperluan</label>
                          <input type="text" class="form-control @error('keperluan') is-invalid @enderror" name="keperluan" id="keperluan" placeholder="Masukan Keperluan" value="{{ old('keperluan') }}">
                          @error('keperluan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>

                      {{-- <div class="form-group mt-3">
                        <label for="datang">Jam Datang</label>
                          <input type="time" class="form-control @error('datang') is-invalid @enderror" name="datang" id="datang" placeholder="Masukan Jam Datang" value="{{ old('datang') }}">
                          @error('datang') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>

                      <div class="form-group mt-3">
                        <label for="pulang">Jam Pulang</label>
                          <input type="time" class="form-control @error('pulang') is-invalid @enderror" name="pulang" id="pulang" placeholder="Masukan Jam Pulang" value="{{ old('pulang') }}">
                          @error('pulang') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div> --}}
            
                        <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
                <a href="/data" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>



@endsection