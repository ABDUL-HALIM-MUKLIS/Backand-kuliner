<?php

namespace App\Http\Controllers\Api\Menu;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use App\Http\Controllers\Controller;

class ListMenuController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Place $place)
    {
        $menus = $place->menus()->paginate(10);
        // dd($menus);
        return MenuResource::collection($menus);
    }
}
