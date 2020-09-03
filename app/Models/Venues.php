<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venues extends Model
{
    protected $table = 'venue_slots';
    protected $fillable = [
        'user_account_id',
        'user_id',
        'venue_name',
        'venue_type_id',
        'min_guests',
        'max_guests',
        'day_type',
        'uses_time_slots',
        'max_occupied_time_length'
    ];
}
