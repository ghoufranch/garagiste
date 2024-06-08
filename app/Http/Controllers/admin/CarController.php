<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;



class CarController extends Controller
{
    public function list(Request $request){

        $cars = Car::with('user')->get();
        $users = User::all();
        return view('admin.cars.list' , [
            'cars' => $cars,
            'users' => $users
        ]);
    }

    public function create(){
        return view('admin.cars.create' , [
            'users' => User::all(),
            
        ]);
    }

    public function store(Request $request){
        
       $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'picture' => 'nullable|image',
            'status' => 'required|in:done,in_progress',
        ]);

        $car = new Car($validated);
        $car->save();
        return redirect()->route('admin.cars.list')->with('success', 'Car added successfully.');
    }
}
