<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldTicket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'flight_id',
        'type'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function flight(){
        return $this->hasOne(Flight::class, 'id', 'flight_id');
    }
}
