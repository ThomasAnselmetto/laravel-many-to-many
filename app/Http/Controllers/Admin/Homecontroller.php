<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// quando creo il controller e gli faccio gestire una rotta devo ricordarmi di spostare la funzione nel controller stesso se lo gestisce index metto index qua e nella route
class Homecontroller extends Controller
{
   public function index(){
        return view('admin.home');
    }
}