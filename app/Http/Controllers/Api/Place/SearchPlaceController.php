<?php

namespace App\Http\Controllers\Api\Place;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;

class SearchPlaceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $place = $place->newQuery();
        // if ($request->has('search')) {
        //     $place->where('name', 'like', '%' . $request->search . '%')
        //     ->orWhere('address', 'like', '%' . $request->search . '%')
        //     ->orWhere('description', 'like', '%' . $request->search . '%')
        //     ->orWherehas('subDistrict', function ($query) use ($request) {
        //         $query->where('name', 'like', '%' . $request->search . '%');
        //     });
        // }
        $place = Place::searchPlace($request->search);

        return PlaceResource::collection($place->paginate(10));
    }
}
