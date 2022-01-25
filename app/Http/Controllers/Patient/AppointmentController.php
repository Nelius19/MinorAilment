<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Doctor\Doctordates;
use App\Models\Patient\Appointment;

class AppointmentController extends Controller
{
    //
    public function index()
    {
        return view('patient.appointment');
    }

    //
    public function getDates()
    {
        $apptDate = DB::table('doctordates')->get();
        return response()->json($apptDate);
    }

    //
    public function bookAppt(Request $request, $id)
    {
        $appt = Appointment::create([
            'user_id' => auth()->user()->user_id,
            'doctor_id' => $id,
            'appointment_date' => $request->input('dateTime'),
            'issue' => $request->input('issue'),
            'appt_nature' => $request->input('appt_nature')
        ]);

        return response()->json($appt);
    }
}

