<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemsRate extends Model
{
    protected $table = 'user_menu_items_with_rates';
    protected $fillable = [
        'label',
        'user_account_id',
        'user_id',
        'menu_item_id',
        'menu_quantity_type',
        'quantity',
        'price',
    ];
    public function menuItems()
    {
        return $this->belongsTo('App\Models\MenuItems');
    }
}
