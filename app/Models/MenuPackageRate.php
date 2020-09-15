<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPackageRate extends Model
{
    protected $table = 'user_menu_package_with_rates';
    protected $fillable = [
        'user_account_id',
        'user_id',
        'price',
        'descrtiption',
    ];
}
