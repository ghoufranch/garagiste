@extends('layouts.app')

@section('content')

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

    <div class="container">
        <h1>Add a Car to Repair</h1>

        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" id="model" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="registration_number">Registration Number</label>
                <input type="text" name="registration_number" id="registration_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="picture">Picture</label>
                <input type="file" name="picture" id="picture" class="form-control">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Car</button>
        </form>
    </div>
@endsection
