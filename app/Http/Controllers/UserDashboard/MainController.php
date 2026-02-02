<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class MainController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        // Fetch total events from database
        $totalEvents = Event::count();

        return view('dashboard.main', compact('totalEvents')); 
        // Now $totalEvents is available in the Blade
    }
}
