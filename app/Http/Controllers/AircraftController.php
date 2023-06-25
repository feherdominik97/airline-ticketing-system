<?php

namespace App\Http\Controllers;

use App\Models\Flight;

class AircraftController extends Controller
{
    public function getGrounded($id): int
    {
        return Flight::query()->where('aircraft_id', $id)->update(['is_cancelled' => true]);
    }
}
