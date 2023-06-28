<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Models\Flight;
use DateTime;
use Exception;
use Illuminate\Support\Carbon;

class FlightController extends Controller
{
    private int $perPage = 25;

    /**
     * @throws Exception
     */
    public function index(): array
    {
        $source = request()->input('source', false);
        $start = request()->input('start', false);
        $end = request()->input('end', false);
        $page = request()->input('page', false);
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

        $numberOfPages = ceil($query->count() / $this->perPage);

        $query->skip($this->perPage * ($page - 1))->take($this->perPage);

        $flights = $query->orderBy('take_off')->get()->toArray();

        array_walk($flights, function (&$flight){
            $flight['availableTickets'] = SoldTicketController::getNumberOfAvailableTickets($flight['aircraft_id']);
            $flight['ticketType'] = SoldTicketController::DEFUALT_TICKET_TYPE;
        });

        return [
            'list' => $flights,
            'numberOfPages' => $numberOfPages,
        ];
    }

    public static function show($id): array
    {
        return Flight::query()->find($id)->toArray();
    }

    public static function getFlightResponse($id): array
    {
        $flight = FlightController::show($id);
        return $flight + [
                'availableTickets' => SoldTicketController::getNumberOfAvailableTickets($flight['id']),
                'ticketType' => SoldTicketController::DEFUALT_TICKET_TYPE,
            ];
    }

    public static function hasAvailableTicket($id): bool
    {
        $numberOfSoldTickets = SoldTicketController::getSoldTicketsByFlightId($id);
        $flight = FlightController::show($id);
        $passengerLimit = Aircraft::query()->find($flight['aircraft_id'])->toArray()['passenger_limit'];

        return $numberOfSoldTickets < $passengerLimit;
    }

    public function cancelFlight($id): int
    {
        return Flight::query()->where(compact('id'))->update(['is_cancelled' => true]);
    }
}
