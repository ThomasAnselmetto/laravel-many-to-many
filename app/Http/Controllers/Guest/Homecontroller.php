<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
   public function index() {
    //    $recent_projects = Project::where('published',1)->orderBy('updated_at','DESC')->limit(8)->get();
    //    $highlight_projects = Project::where('published',1)->orderBy('updated_at','DESC')->limit(8)->get();
    //     return view('guest.home','recent_projects');
    }
}