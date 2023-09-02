<?php

namespace App\Listeners;

use App\Events\RichiestaApaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RichiestaApaListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RichiestaApaEvent  $event
     * @return void
     */
    public function handle(RichiestaApaEvent $event)
    {
        //
    }
}
