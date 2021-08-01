@extends('layouts.layout')

@section('judul', 'Buku Tamu LPSPL Sorong')

@section('isi')

<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">
            <form class="user" method="post" action="{{ route('pegawai_update', $employe->id) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name"
                            placeholder="Masukan Nama" value="{{ $employe->name }}">
                            @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control form-control-user @error('nip') is-invalid @enderror" id="nip" name="nip"
                            placeholder="Masukan NIP" value="{{ $employe->nip }}">
                            @error('nip') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control form-control-user @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan"
                            placeholder="Jabatan" value="{{ $employe->jabatan }}">
                            @error('jabatan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-4 mb-4 float-left">Ubah Data</button>
            </form>
            <a name="batal" id="batal" class="btn btn-danger" href="{{ route('pegawai_index') }}" role="button">Batal</a>
        </div>
    </div>
    
</div>

@endsection