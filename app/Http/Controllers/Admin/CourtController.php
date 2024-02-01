<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Http\Requests\StoreCourtRequest;
use App\Http\Requests\UpdateCourtRequest;
use App\Models\CourtImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourtController extends Controller
{
    public function getAll()
    {
        $court = Court::get();
        return view('admin.court.index', compact('court'));
    }

    public function editCourt(string $id)
    {
        $court  = Court::where('id', $id)->first();
        return view('admin.court.edit', compact('court'));
    }

    public function addCourt()
    {
        return view('admin.court.add');
    }

    public function updateCourt(Request $request, $id)
    {
        $item = Court::findOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->court_name, '-');
        $item->update($data);

        return redirect()->route('admin.court.manage')->with('successEditCourt', 'Informasi lapangan berhasil diubah');
    }

    public function storeCourt(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->court_name, '-');
        Court::create($data);

        return redirect()->route('admin.court.manage')->with('successAddCourt', 'Berhasil menambahkan lapangan baru');
    }

    public function destroyCourt(Request $request)
    {
        $dataTarget = Court::findOrFail($request->court_id);
        $dataTarget->delete();

        return redirect()->route('admin.court.manage')->with('successDeleteCourt', 'Lapangan berhasil dihapus');
    }


    // detail lapangan

    public function show(string $id)
    {
        $court = Court::where('id', $id)->first();
        $courtImage = CourtImages::where('court_id', $id)->orderByDesc('id')->get();
        return view('admin.court.detail.detail', compact('court', 'courtImage'));
    }

    public function editPhoto(string $id)
    {
        $item  = CourtImages::findOrFail($id);
        $court  = Court::where('id', $item->court_id)->first();
        return view('admin.court.detail.form', compact('item', 'court'));
    }

    public function addPhoto($id)
    {
        $court  = Court::where('id', $id)->first();
        return view('admin.court.detail.form', compact('court'));
    }

    public function updatePhoto(Request $request, $id)
    {
        $item  = CourtImages::findOrFail($id);
        $data = $request->all();

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = uniqid() . '.' . $extension;

            $data['image'] = $request->file('image')->storeAs('assets/court', $imageName, 'public');
            Storage::delete('public/' . $item->image);  
        }

        $item->update($data);

        return redirect()->back()->with('successEditPhoto', 'Foto lapangan berhasil diubah');
    }

    public function storePhoto(Request $request)
    {
        $data = $request->all();

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = uniqid() . '.' . $extension;

            $data['image'] = $request->file('image')->storeAs('assets/court', $imageName, 'public');  
        }

        CourtImages::create($data);

        return redirect()->back()->with('successAddPhoto', 'Foto lapangan berhasil ditambahkan');
    }

    public function destroyPhoto(Request $request)
    {
        $dataTarget = CourtImages::findOrFail($request->court_image_id);

        $data = CourtImages::where('id', $request->court_image_id)->first();
        Storage::delete('public/' . $data->image);

        $dataTarget->delete();

        return back()->with('successDeletePhoto', 'Foto lapangan berhasil dihapus');
    }
}
