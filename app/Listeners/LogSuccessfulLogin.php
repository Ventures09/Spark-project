<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Log;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        Log::create([
            'action' => 'login',
            'module' => 'Authentication',
            'details' => 'User '.$event->user->name.' logged in',
        ]);
    }
}
