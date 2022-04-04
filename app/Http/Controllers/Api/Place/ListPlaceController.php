<?php

namespace App\Http\Controllers\Api\Place;

use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListPlaceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $places = Place::paginate(10);
        return PlaceResource::collection($places);
    }
}
