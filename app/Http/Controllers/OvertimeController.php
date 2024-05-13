<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Overtime;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dashboard()
    {
        $overtimes = Overtime::where('user_id', auth()->id())
                            ->where('date', '>', now())
                            ->get();

        $overtimesForCalendar = $overtimes->map(function ($overtime) {
            return [
                'title' => $overtime->hours . ' hours',
                'start' => $overtime->date,
            ];
        });

        return view('dashboard', ['overtimes' => $overtimesForCalendar]);
    }

    public function showDashboard()
    {
        $overtimes = Overtime::all(); // Fetch all overtimes from the database

        return view('dashboard', ['overtimes' => $overtimes]);
    }

    public function add(Request $request)
    {
        // Validate and save the overtime data...
        
        // Return a response
        return response()->json([
            'Date' => $request->date,
            'Localization' => $request->localization,
            'Daytime' => $request->daytime,
        ]);
    }


    

}
