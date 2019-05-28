<?php

namespace Code_base\Base;

use Code_base\Frame\BaseFrame;

/**
 * Class Ctx
 * @package Code_base\Base
 *
 * @property Trade\Ctx $trade
 */
class Ctx extends BaseFrame {

    public function getTrade() {
        return new Trade\Ctx($this->ctx);
    }
}