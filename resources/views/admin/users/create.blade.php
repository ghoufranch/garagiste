@extends('admin.layouts.app')

@section('content')

<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create User</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form method="post" id="usersForm" name="usersForm">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                                <p class="text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">	
                                <p class="text-danger"></p>
                            </div>
                        </div>	
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">	
                                <p class="text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">	
                                <p class="text-danger"></p>
                            </div>
                        </div>	
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Address">	
                                <p class="text-danger"></p>
                            </div>
                        </div>								
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{route('users.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
$(document).ready(function() {
    $("#usersForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        
        $.ajax({
            url: '{{route("users.store")}}',
            type: 'post',
            data: element.serialize(),
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);

                if (response.status === true) {
                    $("#name, #email, #phone, #address, #password").each(function() {
                        $(this).removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    });

                    window.location.href = "{{route('users.index')}}";
                } else {
                    var errors = response.errors;
                    
                    if (errors.name) {
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);         
                    } else {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");  
                    }

                    if (errors.email) {
                        $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email); 
                    } else {
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");   
                    }

                    if (errors.phone) {
                        $("#phone").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.phone); 
                    } else {
                        $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");   
                    }

                    if (errors.address) {
                        $("#address").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.address); 
                    } else {
                        $("#address").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");   
                    }

                    if (errors.password) {
                        $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.password); 
                    } else {
                        $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");   
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("button[type=submit]").prop('disabled', false);
                console.log("Error: " + textStatus + " " + errorThrown);
            }
        });
    });
});
</script>
@endsection
