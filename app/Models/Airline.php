<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function flight(){
        return $this->belongsTo(Flight::class, 'airline_id', 'id');
    }
}
