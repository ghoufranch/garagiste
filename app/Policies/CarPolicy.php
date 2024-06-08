<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the car.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Car  $car
     * @return mixed
     */
    public function update(User $user, Car $car)
    {
        return $user->id === $car->user_id || $user->role == 2;
    }

    public function delete(User $user, Car $car)
    {
        return $user->id === $car->user_id || $user->role == 2;
    }
}
