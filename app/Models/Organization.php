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
        'displayname',
        'contactperson_designation',
        'contactperson',
        'country',
        'state',
        'city',
        'email',
        'building',
        'district',
        'postalCode',
        'slug',
        'image',
        'uuid',
        'status',
        'level',
        'organization_id'
    ];
    public function department()
    {
        return $this->hasMany(Department::class,'organization_id');
    }
    public function user_organization()
    {
        return $this->hasOne(UsersOrganization::class,'organization_id');
    }
    public function eprescription()
    {
        return $this->hasMany(Eprescription::class, 'eprescription_id');
    }
}
