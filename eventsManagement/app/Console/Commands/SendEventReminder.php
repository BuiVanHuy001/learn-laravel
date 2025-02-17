<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendEventReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder to user about their event will start soon';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $events = Event::with('attendees.user')->whereBetween('start_time', [now(), now()->addDay()])->get();

        $eventCount = $events->count();
        $eventLabels = Str::plural('event', $eventCount);

        $events->each(
            fn ($event) => $event->attendees->each(
                fn ($attendee)=> $attendee->user->notify(new EventReminderNotification($event))));
        $this->info("Found {$eventCount} {$eventLabels} starting soon");
    }
}
