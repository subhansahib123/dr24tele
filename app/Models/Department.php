<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table="departments";
    protected $fillable=[
        'name',
        'slug',
        'image',
        'organization_id',
        'level',
        'display_name',
        'uuid',
        'status'
    ];
    public function organization()
    {
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function doctor()
    {
       return $this->hasMany(Doctor::class,'department_id');
    }
    public function specialization()
    {
        return $this->hasOne(SpecializedDepartment::class,'department_id');
    }
}
