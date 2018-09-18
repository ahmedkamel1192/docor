<?php

namespace App\Http\Controllers;
use App\DataTables\EventsDataTable;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $doctors = new EventsDataTable();
        return $doctors->render('Admin.index');
    }
    
}
