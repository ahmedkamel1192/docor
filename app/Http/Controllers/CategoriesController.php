<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CategoriesDataTable;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Category;
class CategoriesController extends Controller
{
    //
    public function index()
    {
        $categories = new CategoriesDataTable();
        return $categories->render('Admin.index');
    }
    public function create()
    {
        return view('categories.create');
    }
    public function store (CreateCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
           
        ]);
        return redirect('/categories');
    }
    public function edit($id)
    {    
        $category = Category::find($id);
        return view('categories.edit',['category'=>$category]);
    }
    public function update(EditCategoryRequest $request,$id)
    {
        Category::where('id', $id)->update(
            [
            
            'name' => $request->name,
            ]);
            return redirect ('/categories');    }


    public function destroy($id)
    {
    
        $cat= Category::find($id);
        $cat->delete();
      
    }
}