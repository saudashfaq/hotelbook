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
        return $this->hasMany('App\Models\Venues');
    }
    public function menuItems()
    {
        return $this->hasMany('App\Models\MenuItems');
    }
    public function menuPackageRate()
    {
        return $this->hasMany('App\Models\MenuPackageRate');
    }
    public function menuItemsRate()
    {
        return $this->hasOne('App\Models\MenuItemsRate');
    }
    public function menuPackageRateBridge()
    {
        return $this->belongsTo('App\Models\MenuPackageBridge');
    }
}
