
@extends('account.layouts.app')

@section('content')

@include('account.common.header')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                <li class="breadcrumb-item">Settings</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="d-flex justify-content-center">
           
            <div class="col-md-3">

                @include('account.common.sidebar')
            </div>
            <div class="container mt-9">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                     <h5 class="card-title text-center">Personal Information</h5>
                                </div>
                               
                                <form action="{{ route('account.updateProfile') }}" method="post" name="profileForm" id="profileForm">
                                    @csrf
                                    <div class="form-group">
                                        <input value="{{$user->name}}" type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name">
                                        <p></p>
                                    </div>
                                    <div class="form-group">                                       
                                        <input value="{{$user->email}}" type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email">
                                        <p></p>
                                    </div>
                                    <div class="form-group">
                                        <input value="{{$user->phone}}" type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone">
                                        <p></p>
                                    </div>
                                    <div class="form-group">
                                    <input value="{{$user->address}}" type="text" class="form-control" id="address" name="address" placeholder="Enter Your Address">
                                    <p></p>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    @include('account.common.footer')

@endsection

@section('customJs')

<script>

$(document).ready(function() {

        $("#profileForm").submit(function(event){
            event.preventDefault();
            console.log("Form submitted");

            $.ajax({
                url: '{{ route("account.updateProfile") }}',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status == true) {
                        $("#name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        $("#email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        $("#phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        $("#address").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                        window.location.href = '{{ route("account.profile") }}';
                    } else {
                        var errors = response.errors;

                        if (errors.name) {
                            $("#name").addClass('is-invalid').siblings('p').html(errors.name).addClass('invalid-feedback');
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        }

                        if (errors.email) {
                            $("#email").addClass('is-invalid').siblings('p').html(errors.email).addClass('invalid-feedback');
                        } else {
                            $("#email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        }

                        if (errors.phone) {
                            $("#phone").addClass('is-invalid').siblings('p').html(errors.phone).addClass('invalid-feedback');
                        } else {
                            $("#phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        }

                        if (errors.address) {
                            $("#address").addClass('is-invalid').siblings('p').html(errors.address).addClass('invalid-feedback');
                        } else {
                            $("#address").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        }
                    }
                }
            });
        });
    });

</script>
@endsection

