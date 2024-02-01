<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facility = Facility::get();
        return view('admin.facility.index', compact('facility'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facility.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Facility::create([
            'fac_name' => $request->fac_name,
        ]);

        return redirect()->route('admin.facility')->with('successAddFac', 'Berhasil menambahkan data fasilitas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $facility = Facility::where('id', $id)->first();
        return view('admin.facility.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Facility::findOrFail($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('admin.facility')->with('successEditFac', 'Berhasil mengedit data fasilitas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $dataTarget = Facility::findOrFail($request->fac_id);
        $dataTarget->delete();

        return redirect()->route('admin.facility')->with('successDeleteFac', 'Berhasil menghapus data fasilitas');
    }
}
