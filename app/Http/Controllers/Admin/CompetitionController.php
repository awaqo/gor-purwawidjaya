<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Http\Requests\StoreCompetitionRequest;
use App\Http\Requests\UpdateCompetitionRequest;
use Carbon\Carbon;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competition = Competition::get();

        // foreach ($competition as $a) {
        //     $tempDateStart = Carbon::createFromFormat('Y-m-d', $a->date_start)->isoFormat('dddd, DD-MM-Y');
        //     $tempDateEnd = Carbon::createFromFormat('Y-m-d', $a->date_end)->isoFormat('dddd, DD-MM-Y');
        //     $arrDate[] = array(
        //         'date_start' => $tempDateStart,
        //         'date_end' => $tempDateEnd
        //     );
        // }
  
        return view('admin.competition.index', compact('competition'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompetitionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Competition $competition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competition $competition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompetitionRequest $request, Competition $competition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competition $competition)
    {
        //
    }
}
