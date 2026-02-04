<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Log; // Make sure to import Log

class EventsController extends Controller
{
    // Show all events
    public function index()
    {
        $events = Event::orderBy('date', 'asc')->get();
        return view('events.eventspage', compact('events'));
    }

    // Store new event
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'day'  => 'required|string',
        ]);

        $event = Event::create([
            'name' => $request->name,
            'date' => $request->date,
            'day'  => $request->day,
        ]);

        // Log the event creation
        Log::create([
            'action' => 'create',
            'module' => 'Event',
            'details' => "Event '{$event->name}' created",
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    // Show single event page
    public function show(Event $event)
    {
        return view('events.eventname', compact('event'));
    }

    // Delete event
    public function destroy(Event $event)
    {
        $eventName = $event->name;

        // Delete the event from the database
        $event->delete();

        // Log the deletion
        Log::create([
            'action' => 'delete',
            'module' => 'Event',
            'details' => "Event '{$eventName}' deleted",
        ]);

        // Redirect back to the event list with a success message
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
