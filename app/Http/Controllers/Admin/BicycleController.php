<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\bicycle;

class BicycleController extends Controller
{
   public function add()
  {
     return view('admin.bicycle.create');
  }
  public function create(Request $request)
  {
       $this->validate($request, bicycle::$rules);

      $news = new bicycle;
      $form = $request->all();

     
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
          $news->image_path = null;
      }

     
      unset($form['_token']);
     
      unset($form['image']);

     
      $news->fill($form);
      $news->save();
      return redirect('admin/bicycle/create');
  }  


}
