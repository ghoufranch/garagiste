@extends('admin.layouts.app')

@section('content')

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Users Cars</h1>
    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">Add a Car</a>
<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th width="60">id</th>
            <th>Owner Name</th>
            <th>Model</th>
            <th>Brand</th>
            <th>Registration Number</th>
            <th>Picture</th>
            <th>Repair Status</th>
            <th width="100">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if($cars ->isNotEmpty())
            @foreach($cars as $car )
        <tr>
            <td>{{$car->id}}</td>												
            <td>{{$car->User->name}}</td>	
            <td>{{$car->model}}</td>
            <td>{{$car->brand}}</td>
            <td>{{$car->registration_number}}</td>
            <td><img src="{{asset('storage/'.$car->picture)}}" width="100" height="100"></td>
            <td>{{$car->status}}</td>
            <td> Action </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="5">Record not found</td>
        </tr>
        @endif
    </tbody>
</table>
</div>

@endsection


