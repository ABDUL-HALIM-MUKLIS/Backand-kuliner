<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubDistrict;
use Yajra\DataTables\DataTables;

class SubDistrictController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()){
            $subDistricts = SubDistrict::query();

            return DataTables::of($subDistricts)->addIndexColumn()->toJson();
        }
        return view('sub-district.index');
    }
}
