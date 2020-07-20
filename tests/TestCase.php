<?php

namespace Tests;

use App\Exceptions\Handler;
use App\Models\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $oldExceptionHandler;

    /**
     * @param null|User $user
     * @return $this
     */
    protected function signIn($user = null)
    {
        $user = $user ?: create(User::class);

        $this->actingAs($user);

        return $this;
    }

    /**
     * Setup the test environment.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }

    /**
     * @return $this|BaseTestCase
     */
    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}