<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table="appointments";
    protected $fillable=[
        'start',
        'end',
        'description',
        'doctor_id',
        'patient_id',
        'slot_id'

    ];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function schedule()
    {
        return $this->hasOne(Schedule::class,'slot_id','id');
    }
}
