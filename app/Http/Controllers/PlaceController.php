<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Place;
use Yajra\DataTables\DataTables;
use App\Models\SubDistrict;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $places = Place::with('subDistrict');

            return DataTables::of($places)
            ->addIndexColumn()
            ->addColumn('subDistrictName', function(Place $place){
                return $place->subDistrict->name;
            })
            ->addColumn('place-menu', 'place.place-link')
            ->addColumn('action', 'place.dt-action')
            ->rawColumns(['place-menu','action'])
            ->toJson();
        }

        return view('place.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('place.create', [
            'subDistricts' => SubDistrict::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required'],
            'address' => ['required'],
            'phone' => ['required','numeric'],
            'image' => ['required','image'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);


        $image = null;
        if($request->has('image')){
            $image = $request->file('image')->store('images/tempat');
        }

        Place::create([
            'sub_district_id' => $request->sub_district_id,
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $request->image,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        session()->flash('success','Successfully add Location');

        return redirect()->route('place.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        return view('place.edit',[
            'subDistricts' => SubDistrict::get(),
            'place' => $place
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required'],
            'address' => ['required'],
            'phone' => ['required','numeric'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);


        $image = $place->image;
        if($request->has('image')){
            if(Storage::exists($place->image)){

                Storage::delete($place->image);
            }
            $image = $request->file('image')->store('images/tempat');
        }

        $place->update([
            'sub_district_id' => $request->sub_district_id,
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $image,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        session()->flash('success','Successfully Update Location');

        return redirect()->route('place.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        if ($place->delete()){
            session()->flash('error','Data Deleted !');

            return response()->json([
                'success' => true,
            ]);
        };

        return response()->json([
            'success' => false,
        ]);
    }
}
