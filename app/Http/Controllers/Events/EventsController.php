<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    
    public function index()
    {
        return view('events.eventspage'); // Make sure you create this view
    }
}
