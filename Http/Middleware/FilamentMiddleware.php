<?php

namespace Modules\Notify\Http\Middleware;

use Nwidart\Modules\Laravel\Module;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Modules\Xot\Http\Middleware\XotBaseFilamentMiddleware;

class FilamentMiddleware extends XotBaseFilamentMiddleware
{
    public static string $module = 'Notify';
    public static string $context = 'filament';

   
}
