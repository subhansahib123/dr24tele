<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Department;
use App\Models\Doctor;
class homeController extends Controller
{
    public function index(){
        $organizations=$this->allHospitals();
        return view('public_panel.index',compact('organizations'));
    }
    protected function allHospitals(){
        try{
             $organizations=Organization::has('department')->get();
            //  dd($organizations);
        }
        catch (\Exception $e){
            dd($e->getMessage());

        }
        return $organizations;


    }
    public function departmentsOfHospital($orgid){
        $departments=Department::has('doctor')->where('organization_id',$orgid)->get();
        return view('public_panel.departments',compact('departments'));
    }
    public function doctorsOfDepartment($dptId){
        $doctors=Doctor::has('schedule')->where('department_id',$dptId)->get();
        // dd($doctors);
        return view('public_panel.doctors',compact('doctors'));
    }
    public function scheduleOfDoctor($doctor_id){
        
    }
}
