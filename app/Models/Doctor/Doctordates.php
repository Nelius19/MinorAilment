<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctordates extends Model
{
    use HasFactory;

    protected $primaryKey = 'date_id';

    protected $fillable = [
        'user_id',
        'doctor_dates'
    ];
}

