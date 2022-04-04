<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubDistrict;
use App\Models\Menu;

class Place extends Model
{
    use HasFactory;
    
    public function getImageUrlAttribute() {
        if ($this->image) {
            return asset($this->image);
        }

        return 'https://via.placeholder.com/150';
    }

    public function subDistrict(){
        return $this->belongsTo(SubDistrict::class);
    }

    public function menus(){
        return $this->hasMany(Menu::class);
    }
}
