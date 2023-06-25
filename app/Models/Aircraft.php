<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'passenger_limit',
    ];

    public function flight(){
        return $this->belongsTo(Flight::class, 'aircraft_id', 'id');
    }
}
