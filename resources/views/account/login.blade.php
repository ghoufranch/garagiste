@extends('account.layouts.app')

@section('content')

<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Login</li>
                </ol>
            </div>
        </div>
    </section>
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
    @endif
    <section class=" section-10">
        <div class="container">
            <div class="login-form">    
                <form  method="post" action="{{ route('account.authenticate') }}">
                    @csrf
                    <h4 class="modal-title">Login to Your Account</h4>
                    <div class="form-group">
                        <input id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"   type="email" name="email" value="{{ old('email') }}" >
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " placeholder="Password" name="password"	>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div> 
                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">              
                </form>			
                <div class="text-center small">Don't have an account? <a href="{{ route('account.register')}}">Sign up</a></div>
            </div>
        </div>
    </section>
</main>

@endsection