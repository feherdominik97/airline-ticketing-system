<?php

namespace App\Http\Controllers;

use App\Models\Flight;

class AirlineController extends Controller
{
    public function goBankrupt($id): int
    {
        return Flight::query()->where('airline_id', $id)->update(['is_cancelled' => true]);
    }
}
