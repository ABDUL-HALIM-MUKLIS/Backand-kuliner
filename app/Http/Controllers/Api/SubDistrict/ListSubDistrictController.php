<?php

namespace App\Http\Controllers\Api\SubDistrict;

use App\Models\SubDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubDistrictResource;

class ListSubDistrictController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $subdistricts = SubDistrict::withCount('places')->get();

        return SubDistrictResource::collection($subdistricts);
    }
}
