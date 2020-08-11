<?php

namespace App\Listeners;

use App\Events\SiteCreated;
use App\Repositories\WidgetRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateWidgetForSite
{
    /**
     * Handle the event.
     *
     * @param  SiteCreated  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof SiteCreated) {

            /** @var WidgetRepository $widgetRepo */
            $widgetRepo = app(WidgetRepository::class);
            $site = $event->getSite();
            $widgetRepo->createForSite($site);
        }
    }
}
