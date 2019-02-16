<?php
##version

namespace bear\sys\session;

use  bear\sys\config\Config;

/**
 * SESSION处理
 * Class Session
 *
 * @package 
 */
class Session
{
    //操作驱动
    protected static $link;

    /**
     * 生成实例
     *
     * @return null|static
     */
    public static function single()
    {
        if (is_null(self::$link)) {
            $driver = ucfirst(Config::get('session.driver'));
            // show($driver);
            $class  = 'bear\\sys\\session\\build\\'.$driver.'Handler';
            self::$link = new $class();
            self::$link->bootstrap();
        }
        return self::$link;
    }

    public function __call($method, $params)
    {
        return call_user_func_array([self::single(), $method], $params);
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([static::single(), $name], $arguments);
    }
}