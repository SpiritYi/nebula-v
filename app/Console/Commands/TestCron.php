<?php

namespace App\Console\Commands;

use App\Console\CronBase;

class TestCron extends CronBase {

    protected $signature = 'TestCron:run';

    protected $description = 'Test code';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $this->ctx->base->trade->manager_earn->test();
    }
}