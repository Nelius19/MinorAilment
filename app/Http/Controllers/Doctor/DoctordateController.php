<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Doctor\Doctordates;

class DoctordateController extends Controller
{
    //
    public function storeDates(Request $request)
    {
        $doctorDates = Doctordates::create([
            'user_id' => auth()->user()->user_id,
            'doctor_dates' => $request->appointment_date
        ]);

        return response()->json($doctorDates);
    }

    //
    public function getDatesFor($id)
    {
        $dates = Doctordates::where('user_id', $id)->get();

        return response()->json($dates);
    }

    //
    public function destroy($id)
    {
        $dateDeleted = Doctordates::where('date_id', $id)
            ->where('user_id', auth()->user()->user_id)
            ->delete();

        return response()->json($dateDeleted);
    }
}

