<?php

namespace App\Http\Controllers\Api;
use App\Category;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $current_user = auth()->user();
      //  return $current_user;
     $all_cats = Category::all();

     return response()->json(['message'=>$all_cats]);
    }
    public function getDoctorsByCategory($id)
    {

        $category=Category::find($id);
        $doctors=$category->users->where('type','=','doctor');
        return response()->json(['message'=>$doctors]);
    }
}
