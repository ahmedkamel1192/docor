<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CategoriesDataTable;


class CategoriesController extends Controller
{
    //
    public function index()
    {
        $categories = new CategoriesDataTable();
        return $categories->render('Admin.index');
    }
}
