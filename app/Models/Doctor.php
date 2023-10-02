<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient_appointments()
    {
        return $this->hasMany(PatientAppointment::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function doctor_specializations()
    {
        return $this->hasMany(DoctorSpecialization::class);
    }

}