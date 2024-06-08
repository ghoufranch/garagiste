@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Your Cars</h1>
        <a href="{{ route('cars.create') }}" class="btn btn-primary">Add a Car to Repair</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Model</th>
                    <th>Brand</th>
                    <th>Registration Number</th>
                    <th>Picture</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->registration_number }}</td>
                        <td>
                            @if ($car->picture)
                                <img src="{{ Storage::url($car->picture) }}" alt="Car Picture" width="100">
                            @endif
                        </td>
                        <td>{{ $car->status }}</td>
                        <td>
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
