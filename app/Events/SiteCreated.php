<?php

namespace App\Events;

use App\Models\Site;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SiteCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \App\Models\Site */
    private $site;

    /**
     * Create a new event instance.
     *
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * @return Site
     */
    public function getSite() : Site
    {
        return $this->site;
    }
}
