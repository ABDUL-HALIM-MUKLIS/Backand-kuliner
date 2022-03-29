<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Place;

class Menu extends Model
{
    use HasFactory;

    public function getImageUrlAttribute()
    {
        if($this->image){
            return asset($this->image);
        }
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }
}
