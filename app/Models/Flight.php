<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id',
        'aircraft',
        'source',
        'destination',
        'take_off',
        'is_cancelled'
    ];

    protected $dates = ['take_off'];

    public function aircraft(){
        return $this->hasOne(Aircraft::class, 'id', 'aircraft_id');
    }

    public function airline(){
        return $this->hasOne(Airline::class, 'id', 'airline_id');
    }

    public function sold_ticket(){
        return $this->belongsTo(SoldTicket::class, 'flight_id', 'id');
    }
}
