@extends('admin.layouts.app')

@section('content')


    <div class="container">
        <h1>Add a Car to Repair</h1>

        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="user_id">user</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
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
