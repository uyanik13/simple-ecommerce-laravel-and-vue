<?php

namespace Evention;

use Evention\Contracts\CoreContract;
use Evention\Providers\CommandsServiceProvider;
use Evention\Providers\EventionServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class Core
{
    /**
     * The Evention Shop CMS version.
     *
     * @var string
     */
    const VERSION = '0.1';

    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * @var array
     */
    protected $aliases = [
        'core'                 => [CoreContract::class, Core::class],
    ];

    /**
     * Core constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
        $this->registerCoreContainerAliases();
    }

    /**
     * Get the version number of the cms.
     *
     * @return string
     */
    public function version()
    {
        return static::VERSION;
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        $this->app->instance('core', $this);
    }

    /**
     * Register all of the base service providers.
     *
     * @return void
     */
    protected function registerBaseServiceProviders()
    {
        $this->app->register(new CommandsServiceProvider($this->app));
    }

    /**
     * Register the core class aliases in the container.
     *
     * @return void
     */
    public function registerCoreContainerAliases()
    {
        foreach ($this->aliases as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->app->alias($key, $alias);
            }
        }
    }
}