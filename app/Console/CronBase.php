<?php

namespace App\Console;

use Code_base\Frame\Ctx;
use Illuminate\Console\Command;

class CronBase extends Command {

    /**
     * @var Ctx
     */
    public $ctx = null;

    public function __construct() {
        parent::__construct();
        $this->ctx = app('ctx_base');
    }
}