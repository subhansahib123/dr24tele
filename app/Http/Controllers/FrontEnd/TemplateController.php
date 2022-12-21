<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSpecializations;
use App\Models\DoctorSpecialization;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
   public function aboutUs()
   {
      return view('public_panel.template_pages.aboutUs');
   }
   public function contactUs()
   {
      return view('public_panel.template_pages.contactUs');
   }

   public function blogGrid()
   {
      return view('public_panel.template_pages.blogLayout.blogGrid');
   }
   public function blogRightSidebar()
   {
      return view('public_panel.template_pages.blogLayout.blogRightSidebar');
   }
   public function blogLeftSidebar()
   {
      
      $departmentSpecializations = DepartmentSpecializations::has('Department')->get();
      $doctorSpecializations = DoctorSpecialization::has('specializedDoctor')->get();

      return view('public_panel.template_pages.blogLayout.blogLeftSidebar',compact('departmentSpecializations','doctorSpecializations'));
   }
   public function leftSidebar()
   {
      return view('public_panel.template_pages.singleBlog.leftSidebar');
   }
   public function rightSidebar()
   {
      return view('public_panel.template_pages.singleBlog.rightSidebar');
   }
   public function noSidebar()
   {
      return view('public_panel.template_pages.singleBlog.noSidebar');
   }
   public function bookAppointment()
   {
      return view('public_panel.template_pages.bookAppointment');
   }
   public function ourTeam()
   {
      return view('public_panel.template_pages.ourTeam');
   }
   public function faq()
   {
      return view('public_panel.template_pages.faq');
   }
   public function privacyPolicy()
   {
      return view('public_panel.template_pages.privacyPolicy');
   }
   public function errorPage()
   {
      return view('public_panel.template_pages.errorPage');
   }
   public function termsOfService()
   {
      return view('public_panel.template_pages.termsOfService');
   }
   public function testimonials()
   {
      return view('public_panel.template_pages.testimonials');
   }
   public function pricingPlan()
   {
      return view('public_panel.template_pages.pricingPlan');
   }
}
