<?php
/** -------------------------------------------------------------------
 * |[bear 小熊PHP开发助手]
 * | 个人博客地址:www.jerryblog.cn
 * |-------------------------------------------------------------------
 * |Author: JerryChen <502443279@qq.com>
 * '-------------------------------------------------------------------
 * */
##version
namespace  bear\extend\db\database\build;

use Closure;
use bear\sys\config\Config;
use bear\extend\db\database\Schema;

/**
 * 数据库操作
 * Class Base
 *
 * @package houdunwang\database\build
 */
class Base
{
    //操作表
    protected $table;
    //执行动作
    protected $exe;
    //连接
    protected $driver;

    public function __construct()
    {
        $class = '\\bear\\extend\\db\\database\build\\'.ucfirst(Config::get('database.driver'));

        $this->driver = new $class();
    }

    /**
     * 创建表
     *
     * @param string  $table   表名
     * @param Closure $callback
     * @param string  $comment 表注释
     *
     * @return bool
     */
    public function create($table, Closure $callback, $comment = '')
    {
        if (Schema::tableExists($table)) {
            return true;
        }
        $Blueprint = new Blueprint($table, $comment);
        $callback($Blueprint);

        return $Blueprint->create();
    }

    public function table($table, Closure $callback)
    {
        $Blueprint = new Blueprint($table, 'alert');
        $callback($Blueprint);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->driver, $name], $arguments);
    }
}