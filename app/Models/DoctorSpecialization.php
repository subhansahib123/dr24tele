<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialization extends Model
{
    use HasFactory;
    protected $table='doctor_specializations';
    protected $fillable=[
        'name'
    ];
    public function specializedDoctor()
    {
        return $this->hasMany(DoctorSpecialization::class,'specializations_id');
    }
}

