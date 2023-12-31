<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function doctor_specializations()
    {
        return $this->hasMany(DoctorSpecialization::class);
    }

    public function patient_appointments()
    {
        return $this->hasMany(PatientAppointment::class);
    }
}