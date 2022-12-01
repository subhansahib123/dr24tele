<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table="patients";
    protected $fillable =[
        'status',
        'user_id',
        'image',
        'organization_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function appointment()
    {
       return $this->hasMany(Appointment::class,'patient_id');
    }
    public function feedback()
    {
        return $this->hasMany(PatientsFeedback::class,'patient_id');
    }
    public function familyMembers()
    {
        return $this->hasMany(FamilyMembers::class,'patient_id');
    }
    public function eprescription()
    {
        return $this->hasMany(Eprescription::class, 'eprescription_id');
    }
}
