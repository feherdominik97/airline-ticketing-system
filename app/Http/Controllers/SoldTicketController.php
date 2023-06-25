<?php

namespace App\Http\Controllers;

use App\Models\SoldTicket;
use Illuminate\Http\Request;

class SoldTicketController extends Controller
{
    public static function getSoldTicketsByFlightId($flightId): int
    {
        return SoldTicket::query()->where('flight_id', $flightId)->get()->count();
    }

    public function store(Request $request)
    {

        return SoldTicket::query()->create($request->all() + ['user_id' => auth()->user()->getAuthIdentifier()]);
    }
}
