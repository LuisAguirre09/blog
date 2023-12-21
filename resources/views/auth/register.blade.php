@extends('layouts.app')

@section('content')
<div class="container">
    <div style="margin-top: 150px; margin-bottom: 120px;" class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('registro-formulario.Register') }}</div>

                {{-- mi validación --}}

                    {{-- @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li> {{ $error  }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                {{-- mi validación --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('registro-formulario.Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        @foreach($errors->get('name') as $error)
                                            <strong>{{ $error }}</strong>
                                        @endforeach
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('registro-formulario.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alias" class="col-md-4 col-form-label text-md-right">Alias*</label>

                            <div class="col-md-6">
                                <input id="alias" type="text" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}" name="alias" value="{{ old('alias') }}" placeholder="Min 3, Max 20 carácteres" required autofocus>
                                
                                @if ($errors->has('alias'))
                                    <span class="invalid-feedback" role="alert">
                                         @foreach ($errors->get('alias') as $error)
                                            <strong>{{ $error }}</strong>
                                         @endforeach
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="web" class="col-md-4 col-form-label text-md-right">Sitio Web</label>

                            <div class="col-md-6">
                                <input id="web" type="text" class="form-control" name="web" value="{{ old('web') }}" autofocus>

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('registro-formulario.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('registro-formulario.Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
