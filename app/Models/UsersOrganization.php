<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersOrganization extends Model
{
    use HasFactory;
    protected $table="users_organizations";
    protected $fillable=[
        "registration_code",
        "status",
        "organization_id",
        "user_id"
    ];
    public function organization()
    {
       return $this->belongsTo(Organization::class,'organization_id');
    }
    public function user()
    {
       return $this->belongsTo(User::class,'user_id');
    }

}
