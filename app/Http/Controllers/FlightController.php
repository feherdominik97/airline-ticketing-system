<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use DateTime;
use Exception;
use Illuminate\Support\Carbon;

class FlightController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(): array
    {
        $source = request()->input('source', false);
        $start = request()->input('start', false);
        $end = request()->input('end', false);
        $query = Flight::with('aircraft')->with('airline');

        if($source)
            $query->whereRaw("lower(source) LIKE lower(?)", "%$source%");

        if($start){
            $start = date('Y-m-d H:i:s', strtotime($start));
            $query->whereDate('take_off', '>=' , $start);
        }

        if($end){
            $end = date('Y-m-d H:i:s', strtotime($end));
            $query->whereDate('take_off', '<=' , $end);
        }

        $flights = $query->orderBy('take_off')->get()->toArray();

        array_walk($flights, function (&$flight){
            $flight['availableTickets'] = $flight['aircraft']['passenger_limit'] - SoldTicketController::getSoldTicketsByFlightId($flight['id']);
            $flight['ticketType'] = 'Economy';
        });

        return $flights;
    }

    public function cancelFlight($id): int
    {
        return Flight::query()->where(compact('id'))->update(['is_cancelled' => true]);
    }
}
