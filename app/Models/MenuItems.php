<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    protected $table = 'menu_items';
    protected $fillable = [
        'user_account_id',
        'menu_type_id',
        'name',
        'status',
    ];
}
