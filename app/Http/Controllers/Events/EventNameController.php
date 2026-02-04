<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Log; // Include the Log model

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

        // Log event creation
        Log::create([
            'action' => 'create',
            'module' => 'Event',
            'details' => 'Event "' . $event->name . '" created by ' . ($request->session()->get('email') ?? 'Guest'),
        ]);

        // Redirect to eventname.blade.php
        return redirect()->route('events.show', $event->id);
    }

    // Show single event page
    public function show(Event $event)
    {
        return view('eventname', compact('event'));
    }

    // Delete an event
    public function destroy(Event $event, Request $request)
    {
        $eventName = $event->name;
        $event->delete();

        // Log event deletion
        Log::create([
            'action' => 'delete',
            'module' => 'Event',
            'details' => 'Event "' . $eventName . '" deleted by ' . ($request->session()->get('email') ?? 'Guest'),
        ]);

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
