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
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function department()
    {
        return $this->belongsTo(Doctor::class,'department_id');
    }
}
