<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eprescription extends Model
{
    use HasFactory;

    protected $fillable=[
        'organization_id',
        'doctor_id',
        'patient_id',
        'appointment_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class,'organization_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class,'doctor_id');
    }

    public function eprescriptiondetail()
    {
        return $this->hasMany(EprescriptionDetail::class, 'eprescription_id');
    }
}
