@extends('layouts.app')

@section('content')

<div class="container-fluid ml-0">
    <div class="row">
        <div class="col-md-10">
            <img src="{{ asset('img/loka.svg') }}" alt="" class="img-fluid ml-2" width="40%">
        </div>
    </div>
    <div class="row mt-2 mb-n2">
        <div class="col text-center">
            <h3 class="tulisansistem mb-3">Admin Buku Tamu LPSPL Sorong</h3>
        </div>
    </div>
    <div class="row mt-0">
        <div class="col-md-8 col-sm-8">
            <img src="{{ asset('img/login.png') }}" alt="Perjalanan dinas" class="img-fluid ml-5" width="80%">
        </div>

        <div class="col-md-4 col-sm-4 mt-5">
            <h3 class="label1 mt-5 mb-n3 ml-3">Selamat Datang</h3>
            <form action="{{ route('login') }}" method="POST" class="col-auto mt-4 mr-4">
                @csrf

                <div class="form-group">
                    <label for="email" class="label1">Email</label>
                    <input type="text" name="email" id="email" class="form-control rounded-pill @error('email') is-invalid @enderror" placeholder="Masukan Email" aria-describedby="MasukanEmail" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukan Email">
                    {{-- <small id="MasukanNIP" class="text-muted">Masukan S</small> --}}
                    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>

                <div class="form-group form-fluid">
                    <label for="password" class="label1">Password</label>
                    <input type="password" name="password" id="password" class="form-control rounded-pill  @error('password') is-invalid @enderror" placeholder="Masukan Password" aria-describedby="MasukanPassword" required autocomplete="current-password">
                    {{-- <small id="MasukanPassword" class="text-muted">Masukan Password</small> --}}

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-warning">
                        {{ __('Login') }}
                    </button>
                    
                    
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif

                </div>

                <div class="form-group row ml-2">
                   
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                   
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
