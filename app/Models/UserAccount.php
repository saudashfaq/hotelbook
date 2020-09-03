<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    public $incrementing = true;
    protected $table = 'user_accounts';
    protected $fillable = [
        'business_type',
        'opens_at',
        'closes_at',
        'day_type',
    ];
    public function user()
    {
        return $this->hasOne('App\User');
    }
    public function venues()
    {
        return $this->hasMany('App\Venues');
    }
}
