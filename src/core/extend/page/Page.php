<?php
##version
namespace bear\extend\page;

use bear\extend\page\build\Base;

class Page
{
    protected static $link = null;

    public static function single()
    {
        if (is_null(self::$link)) {
            self::$link = new Base();
        }

        return self::$link;
    }

    public function __call($method, $params)
    {
        return call_user_func_array([self::single(), $method], $params);
    }
    public function __toString()
    {
        return self::$link->__toString();
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([self::single(), $name], $arguments);
    }
}