<?php

namespace App\Models;

use App\Models\Place;
use App\Models\Categoris;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    public function getImageUrlAttribute()
    {
        if($this->image){
            return asset($this->image);
        }

        return asset('images/default.png');
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function category(){
        return $this->belongsTo(Categoris::class, 'categori_id');
    }
    
}
