<?php

namespace App\Http\Controllers\Api\Place;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;

class ShowPlaceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Place $place)
    {
        return new PlaceResource($place);
    }
}
