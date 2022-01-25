<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    // 
    public function index()
    {
        $bookedAppt = $this->bookedApptmt();
        $doctorDetails = $this->docID();

        return view('patient.homepage', compact('bookedAppt', 'doctorDetails'));
    }

    // call back function
    public function bookedApptmt()
    {
        return DB::table('appointments')->where('user_id', auth()->user()->user_id)->get();
    }

    // // call back function 2
    public function docID()
    {
        $doc_id = DB::table('appointments')->where('user_id', auth()->user()->user_id)->count();
        if ($doc_id == 0) {
            return null;
        }
        else{
            $doc_id = DB::table('appointments')->select('doctor_id')->where('user_id', auth()->user()->user_id)->get();
            return DB::table('users')->select('firstname', 'lastname', 'email')->where('user_id', $doctor_id = $doc_id[0]->doctor_id)->get();
        }
        
    }
}

