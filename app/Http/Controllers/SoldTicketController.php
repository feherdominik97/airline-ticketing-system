<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\Flight;
use App\Models\SoldTicket;
use Illuminate\Http\Request;

class SoldTicketController extends Controller
{
    const DEFUALT_TICKET_TYPE = 'Economy';
    public static function getSoldTicketsByFlightId($flightId): int
    {
        return SoldTicket::query()->where('flight_id', $flightId)->count();
    }

    public function store(Request $request)
    {
        if(!FlightController::hasAvailableTicket($request->input('flight_id', false)))
            return [
                'error' => 'No available ticket for this flight.'
            ];

        SoldTicket::query()->create($request->all() + ['user_id' => auth()->user()->getAuthIdentifier()]);

        return FlightController::getFlightResponse($request->input('flight_id'));
    }

    public static function getNumberOfAvailableTickets($flightId){
        $flight = FlightController::show($flightId);

        return Aircraft::query()->find($flight['aircraft_id'])->toArray()['passenger_limit'] - SoldTicketController::getSoldTicketsByFlightId($flightId);
    }
}
