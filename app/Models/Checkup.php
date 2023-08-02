<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patient_appointment()
    {
        return $this->belongsTo(PatientAppointment::class);
    }
}