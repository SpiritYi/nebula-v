<?php

namespace Code_base\Frame;

use Illuminate\Support\ServiceProvider;

/**
 * Class CtxServiceProvider
 * @package Code_base\Frame
 */

class CtxServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton('ctx_base', function() {
            return new Ctx();
        });
    }
}