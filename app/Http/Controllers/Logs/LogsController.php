<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    /**
     * Show the logs page.
     */
    public function index()
    {
        return view('logs.logspage'); // Make sure you create this view
    }
}
