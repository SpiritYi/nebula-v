<?php

namespace Code_base\Frame;

use Code_base\Base;

/**
 * Class Ctx
 * @author Wings Chen
 * @version 2018/05/13
 *
 * @property Base\Ctx $base
 */

class Ctx extends BaseFrame {

    public function getBase() {
        return new Base\Ctx($this);
    }

}