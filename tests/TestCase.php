<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Exception;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    /**
     * Create a model factory and forget observers so events do not trigger actions.
     */
    public function factoryWithoutObservers($class, $name = 'default') {
        $class::flushEventListeners();
        return factory($class, $name);
    }



    // Use this version if you're on PHP 7
    protected function disableExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}

            public function report(Exception $e)
            {
                // no-op
            }

            public function render($request, Exception $e) {
                throw $e;
            }
        });
    }


}
