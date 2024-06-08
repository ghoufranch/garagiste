@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Car</h1>

        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" id="model" class="form-control" value="{{ $car->model }}" required>
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" class="form-control" value="{{ $car->brand }}" required>
            </div>
            <div class="form-group">
                <label for="registration_number">Registration Number</label>
                <input type="text" name="registration_number" id="registration_number" class="form-control" value="{{ $car->registration_number }}" required>
            </div>
            <div class="form-group">
                <label for="picture">Picture</label>
                <input type="file" name="picture" id="picture" class="form-control">
                @if ($car->picture)
                    <img src="{{ Storage::url($car->picture) }}" alt="Car Picture" width="100" class="mt-2">
                @endif
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="in_progress" {{ $car->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $car->status == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Car</button>
        </form>
    </div>
@endsection
