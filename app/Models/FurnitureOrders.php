<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureOrders extends Model
{
    protected $table ='furniture_orders';
    public function furniture()
    {
        return $this->belongsTo(Furnitures::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
