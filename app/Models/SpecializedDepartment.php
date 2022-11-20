<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializedDepartment extends Model
{
    use HasFactory;
    protected $table="specialized_departments";
    protected $fillable=[
        'specialization_id',
        'department_id',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    public function specialization()
    {
        return $this->belongsTo(DepartmentSpecializations::class,'specialization_id');
    }
}
