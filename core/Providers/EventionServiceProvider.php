<?php

namespace Evention\Providers;

use Evention\Contracts\CoreContract;
use Illuminate\Support\ServiceProvider;

class EventionServiceProvider extends ServiceProvider
{
    /**
     * Create a new service provider instance.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        $app->make(CoreContract::class);

        parent::__construct($app);
    }
}