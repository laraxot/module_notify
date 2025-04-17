<?php

declare(strict_types=1);

namespace Modules\Notify\Providers;

use Modules\Xot\Providers\XotBaseServiceProvider;
use Illuminate\Support\Facades\Notification;

class NotifyServiceProvider extends XotBaseServiceProvider {
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;
    public string $module_name = 'notify';

    public function bootCallback(): void {
        // BladeService::registerComponents($this->module_dir.'/../View/Components', 'Modules\\Media');
        Notification::extend('esendex', function ($app) {
            return new \Modules\Notify\Notifications\Channels\EsendexChannel();
        });
    }
}
