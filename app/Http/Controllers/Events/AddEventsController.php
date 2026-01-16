<?php

namespace App\Http\Controller\Events;

use Illuminate\Http\Request;
use App\Models\Event;

class AddEventsController extends Controller
{
    /**
     * Show Add Event form
     */
    public function create()
    {
        return view('addevents');
    }

    /**
     * Store event
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_date' => 'required|date',
            'day'        => 'required|string',
            'event_name' => 'required|string|max:255',
        ]);

        Event::create([
            'event_date' => $request->event_date,
            'day'        => $request->day,
            'event_name' => $request->event_name,
        ]);

        return redirect()->back()->with('success', 'Event added successfully');
    }
}
