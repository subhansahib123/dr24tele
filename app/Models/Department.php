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
    ];
    public function organization()
    {
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function doctor()
    {
       return $this->hasMany(Doctor::class,'department_id');
    }
}
