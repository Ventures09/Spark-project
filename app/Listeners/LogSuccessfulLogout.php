<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\Log;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        Log::create([
            'action' => 'logout',
            'module' => 'Authentication',
            'details' => 'User '.$event->user->name.' logged out',
        ]);
    }
}
