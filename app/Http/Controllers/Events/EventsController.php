<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

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

        Event::create([
            'name' => $request->name,
            'date' => $request->date,
            'day'  => $request->day,
        ]);

        return redirect()->route('events.index');
    }

    // Show single event page
    public function show(Event $event)
    {
        return view('events.eventname', compact('event'));
    }

    public function destroy(Event $event)
{
    // Delete the event from the database
    $event->delete();

    // Redirect back to the event list with a success message
    return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
}

}
