<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Furnitures extends Model
{
    protected $table = 'furniture';
    public function seller()
    {
        return $this->belongsTo(User::class,'seller_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

