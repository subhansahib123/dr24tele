<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientsFeedback extends Model
{
    use HasFactory;
    protected $table="patients_feedback";
    protected $fillable=[
        'patient_id',
        'doctor_id',
        'rating',
        'feedback',
    ];
    
    public function doctor()
    {
        
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function patient()
    {
        
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
