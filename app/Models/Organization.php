<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $table="organizations";
    protected $fillable=[
        'name',
        'slug',
        'level'
    ];
    public function department()
    {
        return $this->hasMany(Department::class,'organization_id');
    }
    public function patient_organization()
    {
        return $this->hasOne(Patient_Organization::class,'organization_id');
    }

}
