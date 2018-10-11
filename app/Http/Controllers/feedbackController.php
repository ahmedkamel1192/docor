<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\FeedbackDataTable;
use App\Feedback;

class feedbackController extends Controller
{
    public function index()
    {
        $doctors = new FeedbackDataTable();
        return $doctors->render('Admin.index');
    }

    public function Store(Request $request)
    {
        Feedback::create([
            'feedback' => $request->text,
        ]);
    }
}
