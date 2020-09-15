<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPackageBridge extends Model
{
    protected $table = "user_menu_packages_bridge_with_menu_items";
    protected $fillable = [
        'menu_item_id',
        'user_menu_packages_with_rate_id',
        'menu_quantity_type_id',
        'quantity',
    ];
}
