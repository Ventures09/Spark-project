<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    
    public function index()
    {
        return view('students.studentspage'); // Make sure you create this view
    }
}
