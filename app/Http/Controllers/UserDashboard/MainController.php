<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        return view('dashboard.main'); // resources/views/Dashboard/main.blade.php
    }
}
