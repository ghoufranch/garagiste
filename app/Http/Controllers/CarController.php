<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::where('user_id', Auth::id())->get();
        return view('cars.index', compact('cars'));

    }



    public function create()
    {
        return view('cars.create');
    }




    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'picture' => 'nullable|image',
            'status' => 'required|in:done,in_progress',
        ]);

        $picturePath = $request->file('picture') ? $request->file('picture')->store('pictures', 'public') : null;

        Car::create([
            'user_id' => Auth::id(),
            'model' => $request->model,
            'brand' => $request->brand,
            'registration_number' => $request->registration_number,
            'picture' => $picturePath,
            'status' => $request->status,
        ]);

        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }



    public function edit(Car $car)
    {
        $this->authorize('update', $car); // Authorize the action

        return view('cars.edit', compact('car'));
    }




    public function update(Request $request, Car $car)
    {
        $this->authorize('update', $car);
        $request->validate([
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'picture' => 'nullable|image',
            'status' => 'required|in:done,in_progress',
        ]);

        if ($request->file('picture')) {
            if ($car->picture) {
                Storage::disk('public')->delete($car->picture);
            }
            $picturePath = $request->file('picture')->store('pictures', 'public');
            $car->picture = $picturePath;
        }

        $car->update($request->only('model', 'brand', 'registration_number', 'status'));

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }



    
    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);
        if ($car->picture) {
            Storage::disk('public')->delete($car->picture);
        }
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
