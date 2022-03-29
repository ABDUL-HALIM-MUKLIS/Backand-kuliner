<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Place;
use App\Models\categoris;

class PlaceMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Place $place)
    {
        if($request->ajax()){
            $menus = $place->menus;
            return DataTables::of($menus)
            ->addIndexColumn()
            ->editColumn('image', function($menu){
                return '<img src="'.$menu->image_url.'">';
            })
            ->addColumn('action','place.menus.dt-action')
            ->rawColumns(['image'],['action'])
            ->toJson();
        };
        return view('place.menus.index',[
            'place' => $place
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Place $place)
    {
        return view('place.menus.create',[
            'categoris' => categoris::get(),
            'place' => $place
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Place $place)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'categori_id' => 'required',
            'price' => 'required',
            'image' => 'required'
        ]);
        $image = null;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('images/menus');
        }
            $place->menus()->create([
                'place_id' => $place->id,
                'categori_id' => $request->categori_id,
                'name' => $request->name,
                'slug' => \Str::slug($request->name),
                'image' => $image,
                'description' => $request->description,
                'price' => $request->price,
            ]);
    
            return redirect()->route(
                'menu.index',[
                    'place' => $place
                ]
            )->with('success','Menu berhasil ditambahkan');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
