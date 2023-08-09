<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkup()
    {
        return $this->hasOne(Checkup::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}