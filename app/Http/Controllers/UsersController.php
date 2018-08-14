<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;

class UsersController extends Controller
{
    public function index()
    {
        $users = new UsersDataTable();
        return $users->render('Admin.index');
    }}
