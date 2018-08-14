<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\DoctorsDataTable;


class DoctorsController extends Controller
{
    public function index()
    {
        $doctors = new DoctorsDataTable();
        return $doctors->render('Admin.index');
    }
}
