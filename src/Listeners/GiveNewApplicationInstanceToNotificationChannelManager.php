<?php

namespace Laravel\Octane\Listeners;

use Illuminate\Notifications\ChannelManager;

class GiveNewApplicationInstanceToNotificationChannelManager
{
    /**
     * Handle the event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function handle($event)
    {
        if (! $event->sandbox->resolved(ChannelManager::class)) {
            return;
        }

        with($event->sandbox->make(ChannelManager::class), function ($manager) use ($event) {
            $manager->setContainer($event->sandbox);
            $manager->forgetDrivers();
        });
    }
}
