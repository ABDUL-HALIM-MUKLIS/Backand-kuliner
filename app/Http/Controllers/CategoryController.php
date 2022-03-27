<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoris;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $categoris = Categoris::query();

            return DataTables::of($categoris)
            ->addIndexColumn()
            ->addColumn('action', 'categoris.dt-action')
            ->toJson();
        }

        return view('categoris.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        Categoris::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name)

        ]);
        session()->flash('success', 'Successfully add category');

        return redirect()->route('category.index');
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
    public function edit(Categoris $category)
    {
        return view('categoris.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoris $category)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name)
        ]);

        session()->flash('info','Category Success is Update');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoris $category)
    {
        if ($category->delete()){
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
