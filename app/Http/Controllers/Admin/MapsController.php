<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maps;
use App\Http\Requests\StoreMapsRequest;
use App\Http\Requests\UpdateMapsRequest;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maps = Maps::get();
        return view('admin.maps.index', compact('maps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.maps.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Maps::create([
            'source' => $request->source,
        ]);

        return redirect()->route('admin.maps')->with('successAddMaps', 'Berhasil menambahkan data source google maps');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maps $maps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $maps = Maps::where('id', $id)->first();
        return view('admin.maps.edit', compact('maps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Maps::findOrFail($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('admin.maps')->with('successEditMaps', 'Berhasil mengedit data source google maps');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $dataTarget = Maps::findOrFail($request->source_id);
        $dataTarget->delete();

        return redirect()->route('admin.maps')->with('successDeleteMaps', 'Berhasil menghapus data source google maps');
    }
}
