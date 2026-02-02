<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventNameController extends Controller
{
    // Handle modal form submission from eventspage.blade.php
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string',
            'event_date' => 'required|date',
            'event_day'  => 'required|string',
        ]);

        $event = Event::create([
            'name' => $request->event_name,
            'date' => $request->event_date,
            'day'  => $request->event_day,
        ]);

        // Redirect to eventname.blade.php
        return redirect()->route('events.show', $event->id);
    }

    // Controller for eventname.blade.php
    public function show(Event $event)
    {
        return view('eventname', compact('event'));
    }
    
    public function destroy(Event $event)
{
    $event->delete();
    return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
}


}
