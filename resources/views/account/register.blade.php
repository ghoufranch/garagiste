

@extends('account.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                <li class="breadcrumb-item">Register</li>
            </ol>
        </div>
    </div>
</section>


@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<section class=" section-4 ">
    <div class="container">
        <div class="login-form text-center">    
            <form   method="post"  class="small" name="registerForm" id="registerForm">
                @csrf
                <h4 class="modal-title">Register Now</h4>
                <div class="form-group small">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" >  
                    <p></p>              
                </div>
                <div class="form-group">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" >
                    <p></p>
                </div>
                <div class="form-group">
                    <input id="phone" type="phone" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Phone Number" >
                    <p></p>
                </div>
                <div class="form-group">
                    <input id="address" type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Address" >
                    <p></p>
                </div>

                <div class="form-group">
                    <input id="password" type="password" name="password" class="form-control" placeholder="Password" >
                    <p></p>
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" name="password_confirmation"  placeholder="Confirm Password" class="form-control" >
                    <p></p>
                </div>
                <div class="form-group small">
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div> 
                <button type="submit" class="btn btn-dark btn-block btn-lg" >Register</button>
            </form>			
            <div class="text-center small">Already have an account? <a href="{{ route('account.login')}}">Login Now</a></div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script type="text/javascript">
$(document).ready(function() {
    $("#registerForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        
        $.ajax({
            url: '{{ route("account.processRegister") }}',
            type: 'post',
            data: element.serialize(),
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);

                if   (response.status === false) {

                    if(errors.name){
                        $("#name").siblings("p").addClass('invalid-feedback').html(errors.name);
                    $("#name").addClass('is-invalid');
                    }else{
                        $("#name").siblings("p").removeClass('invalid-feedback').html('');
                         $("#name").removeClass('is-invalid');
                    }

                    if(errors.email){
                        $("#email").siblings("p").addClass('invalid-feedback').html(errors.email);
                    $("#email").addClass('is-invalid');
                    }else{
                        $("#email").siblings("p").removeClass('invalid-feedback').html('');
                         $("#email").removeClass('is-invalid');
                    }

                    if(errors.phone){
                        $("#phone").siblings("p").addClass('invalid-feedback').html(errors.phone);
                    $("#phone").addClass('is-invalid');
                    }else{
                        $("#phone").siblings("p").removeClass('invalid-feedback').html('');
                         $("#phone").removeClass('is-invalid');
                    }

                    if(errors.address){
                        $("#address").siblings("p").addClass('invalid-feedback').html(errors.address);
                    $("#address").addClass('is-invalid');
                    }else{
                        $("#address").siblings("p").removeClass('invalid-feedback').html('');
                         $("#address").removeClass('is-invalid');
                    }

                    if(errors.password){
                        $("#password").siblings("p").addClass('invalid-feedback').html(errors.password);
                    $("#password").addClass('is-invalid');
                    }else{
                        $("#password").siblings("p").removeClass('invalid-feedback').html('');
                         $("#password").removeClass('is-invalid');
                    }

                   
                } else {
                   
                    window.location.href="{{ route('account.login')}}"
                    
                    $("#name").siblings("p").removeClass('invalid-feedback').html('');
                    $("#name").removeClass('is-invalid');

                    $("#email").siblings("p").removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid');

                    $("#phone").siblings("p").removeClass('invalid-feedback').html('');
                    $("#phone").removeClass('is-invalid');

                    $("#address").siblings("p").removeClass('invalid-feedback').html('');
                    $("#address").removeClass('is-invalid');

                    $("#password").siblings("p").removeClass('invalid-feedback').html('');
                    $("#password").removeClass('is-invalid');

                    
                    
                }
            },
            error: function(jqXHR, exception) {
               console.log('error', jqXHR, exception);
            }
        });
    });
});
</script>
@endsection
