<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table="roles";
    protected $fillable =[
        'name',
        'slug',
    ];
    public function user_role()
    {
       return $this->hasMany(User_Role::class,'role_id');
    }
}
