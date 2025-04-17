<?php

declare(strict_types=1);

namespace Modules\Notify\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class Notify extends Notification implements ShouldQueue {
    use Queueable;
    /**
     * All of the notification routing information.
     *
     * @var array
     */
    public $routes = [];

    public function __construct(string $channel, string $route) {
        $this->routes[$channel] = $route;
    }

    /** Get the notification routing information for the given driver.
     *
     * @param string $driver
     *
     * @return mixed
     */
    public function routeNotificationFor($driver) {
        return $this->routes[$driver] ?? null;
    }
}
