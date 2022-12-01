<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table="doctors";
    protected $fillable=[
        "status",
        'user_id',
        'department_id',
        'image',
        'specialization_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    public function appointment()
    {
       return $this->hasMany(Appointment::class,'doctor_id');
    }

    public function schedule()
    {
       return $this->hasMany(Schedule::class,'doctor_id');
    }
    public function feedback()
    {
        return $this->hasMany(PatientsFeedback::class,'doctor_id');
    }
    public function specialization()
    {
        return $this->belongsToMany(DoctorSpecialization::class,'specialized_doctors','doctor_id','specialization_id');
    }

    public function eprescription()
    {
        return $this->hasMany(Eprescription::class, 'eprescription_id');
    }
}
