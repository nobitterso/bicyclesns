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

      $bicycle = new bicycle;
      $form = $request->all();

     
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $bicycle->image_path = basename($path);
      } else {
          $bicycle->image_path = null;
      }

     
      unset($form['_token']);
     
      unset($form['image']);

     
      $bicycle->fill($form);
      $bicycle->save();
      return redirect('admin/bicycle/create');
  }  
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          $posts = Bicycle::where('title', $cond_title)->get();
      } else {
          $posts = Bicycle::all();
      }
      return view('admin.bicycle.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }


  public function edit(Request $request)
  {
      $news = Bicycle::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('admin.news.edit', ['news_form' => $bicycle]);
  }


  public function update(Request $request)
  {
  
      $this->validate($request, bicycle::$rules);
    
      $bicycle = bicycle::find($request->id);

      $bicycle_form = $request->all();
      unset($bicycle_form['_token']);

      $bicycle->fill($bicycle_form)->save();

      return redirect('admin/bicycle');
  }



}
