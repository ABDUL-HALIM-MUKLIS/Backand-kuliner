<?php

namespace App\Http\Controllers\Api\Place;

use config;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;

class RelatedPlaceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Place $place)
    {
        $relatedPlace = $place->subDistrict->places()
        ->whereNotIn('id', [$place->id])
        ->inRandomOrder()
        ->get()
        ->take(config('kuliner.related_place_limit'));
        return PlaceResource::collection($relatedPlace);
    }
}
