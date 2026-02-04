<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $logs = Log::orderBy('created_at', 'desc')->paginate(10);

        return view('logs.logspage', compact('logs'));
    }
}

