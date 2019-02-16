<?php
##version
namespace bear\extend\oss;

use bear\extend\oss\build\Base;


class Oss
{
    /**
     * 驱动
     *
     * @var null
     */
    protected static $link = null;

    /**
     * 获取驱动
     *
     * @return \houdunwang\oss\build\Base|null
     */
    public static function single()
    {
        if ( ! self::$link) {
            self::$link = new Base();
        }

        return self::$link;
    }

    /**
     * 对象调用
     *
     * @param $method
     * @param $params
     *
     * @return mixed
     */
    public function __call($method, $params)
    {
        return call_user_func_array([self::single(), $method], $params);
    }

    /**
     * 静态调用
     *
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([self::single(), $name], $arguments);
    }
}