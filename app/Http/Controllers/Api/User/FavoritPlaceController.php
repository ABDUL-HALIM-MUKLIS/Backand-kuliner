<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoritPlaceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Place $place)
    {
        if(collect($request->user()->places()->toggle($place->id))->get('attached')){
            return response()->json([
                'message' => 'Favorite',
                'status' => 'success'
            ],201);
        }else {
            return response()->json([
                'message' => 'Unfavorite',
                'status' => 'success'
            ],201);
        }
    }
}
