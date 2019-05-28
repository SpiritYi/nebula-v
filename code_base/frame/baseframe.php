<?php

namespace Code_base\Frame;

class BaseFrame {

    protected $component = array();

    /**
     * @var Ctx
     */
    protected $ctx;
    protected $preClass;

    public function __construct($ctx = null) {
        $this->ctx = $ctx ? : $this;
        $this->preClass = get_class($this);
    }

    //魔术方法加载类
    public function __get($name) {
        if (!isset($this->component[$name])) {
            $func = 'get' . $name;
            if (method_exists($this, $func)) {                          //如果重载实现了get{$name} 直接调用重载方法
                $this->component[$name] = $this->$func();
            } else {                                                    //根据business ctx 构造下面的类
                $preClassArr = explode('\\', $this->preClass);
                array_pop($preClassArr);
                $classNameArr = array_map(function($v) {
                    return ucfirst($v);
                }, array_merge($preClassArr, explode('_', $name)));
                $class = implode('\\', $classNameArr);
                if (!class_exists($class)) {
                    trigger_error('Frame __get class name null:' . $class);
                }
                $this->component[$name] = new $class($this->ctx);
            }
        }
        return $this->component[$name];
    }
}