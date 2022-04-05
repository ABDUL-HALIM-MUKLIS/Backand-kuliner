<?php

namespace App\Http\Controllers\Api\SubDistrict;

use App\Models\SubDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubDistrictResource;

class ShowSubDistrictController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, SubDistrict $subDistrict)
    {
        $subDistrict = $subDistrict->loadCount('places');
        return new SubDistrictResource($subDistrict);
    }
}
