<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\User;
use App\Models\SubDistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;
    
    public function getImageUrlAttribute() {
        if ($this->image) {
            return asset($this->image);
        }

        return 'https://via.placeholder.com/150';
    }

    public function ScopeSearchPlace(Builder $builder, $search){
        
        return $builder->where('name', 'like', '%' . $search . '%')
        ->orWhere('address', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->orWhereHas('subDistrict', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function subDistrict(){
        return $this->belongsTo(SubDistrict::class);
    }

    public function menus(){
        return $this->hasMany(Menu::class);
    }

    //relationship user_place
    public function users(){
        return $this->belongsToMany(User::class, 'place_user');
    }
}
