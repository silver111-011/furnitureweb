<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    public function furniture()
    {
        return $this->belongsTo(Furnitures::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
