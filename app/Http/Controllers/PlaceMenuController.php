<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Models\Place;
use App\Models\Menu;
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
            ->rawColumns(['image','action'])
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
    public function store(Request $request, Place $place, Menu $menu)
    {
        $this->validate($request,[
            'name' => 'required','unique:menus,name,'.$menu->id,
            'description' => 'required',
            'categori_id' => 'required',
            'price' => ['required','numeric'],
        ]);
        $image = null;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('images/menus');
        }
            $place->menus()->create([
                'place_id' => $place->id,
                'slug' => \Str::slug($request->name),
                'categori_id' => $request->categori_id,
                'name' => $request->name,
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
    public function edit(Place $place, Menu $menu)
    {
        return view('place.menus.edit',[
            'place' => $place,
            'menu' => $menu,
            'categoris' => categoris::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place, Menu $menu)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'categori_id' => 'required',
            'price' => ['required','numeric'],
        ]);

        
        $image = $menu->image;

        if($request->hasFile('image')){
            if(Storage::exists($image)){
                Storage::delete($image);
            }
            $image = $request->file('image')->store('images/menus');
        }

        $menu->update([
            'name' => $request->name ?? $menu->name,
            'slug' => $request->name ? \Str::slug($request->name) : $menu->slug,
            'description' => $request->description ?? $menu->description,
            'categori_id' => $request->categori_id ?? $menu->categori_id,
            'image' => $image,
            'price' => $request->price ?? $menu->price,
        ]);

        return redirect()->route(
            'menu.index',[
                'place' => $place
            ]
        )->with('success','Menu berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place, Menu $menu)
    {
        if($menu){
            if(Storage::exists($menu->image)){
                Storage::delete($menu->image);
            }
            $menu->delete();

            session()->flash('error','Menu berhasil dihapus');

            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
                'success' => true,
            ]);
    }
}
