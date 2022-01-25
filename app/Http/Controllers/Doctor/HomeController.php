<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Patient\Appointment;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('doctor.home');
    }

    //
    public function showBookedAppts()
    {
        $apptDetails = DB::table('appointments')
            ->join('users', 'users.user_id', '=', 'appointments.user_id')
            ->select('users.user_id', 'users.firstname', 'users.lastname', 'users.email', 'appointments.*')
            ->where('doctor_id', [auth()->user()->user_id])->get();

        return view('doctor.appointments', compact('apptDetails'));
    }

    //
    public function destroyAppt(Request $request, $id)
    {
        Appointment::where('user_id', $id)->delete();
        return redirect('appointments');
    }
}

