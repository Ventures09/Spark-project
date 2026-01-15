<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentsDitController extends Controller
{
    // Method to show the DIT students page
    public function index()
    {
        // You can pass data from the database if needed
        // Example: $students = DitStudent::all();

        return view('students.studentspagedit'); // loads resources/views/studentspagedit.blade.php
    }
}
