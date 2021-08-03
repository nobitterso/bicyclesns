<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BicycleController extends Controller
{
   public function add()
  {
     return view('admin.bicycle.create');
  }
  public function create(Request $request)
  {
      return redirect('admin/bicycle/create');
  }  


}
