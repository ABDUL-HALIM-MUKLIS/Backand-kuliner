<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoris extends Model
{
    use HasFactory;

    //relationship with menu
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
