<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentSpecializations extends Model
{
    use HasFactory;
    protected $table='department_specializations';
    protected $fillable=[
        'name'
    ];
    public function specializedDepartment()
    {
        return $this->hasMany(SpecializedDepartment::class,'specialization_id');
    }
    public function Department()
    {
        return $this->belongsToMany(Department::class,'specialized_departments','specialization_id','department_id');
    }
}
