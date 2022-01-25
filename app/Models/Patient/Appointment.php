<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appt_id';

    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_date',
        'issue',
        'appt_nature'
    ];
}

