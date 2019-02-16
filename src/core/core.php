<?php
##version
##生成器
namespace core;
use core\sys\config\Config;
use core\sys\Sys;
require __DIR__.'/sys/Helper.php';
class Bear extends Sys
{
	/**
	 * [make 实例入口]
	 * @Author   Jerry
	 * @DateTime 2018-08-13T15:15:46+0800
	 * @Example  eg:
	 * @param    string                   $type [description]
	 * @return   [type]                         [description]
	 */
    public static function make($type='Table'){
    	$type = ucfirst($type);
        $class = '\\bear\\make\\'. $type;
        if (!class_exists($class)) {
            throw new Exception($type . '生成器不存在', 1002);
        }

        return new $class;
    }

    public static function extend($type='attach'){

        $class = '\\bear\\extend\\'.$type.'\\'. ucfirst($type);
        if (!class_exists($class)) {
            throw new Exception($type . '扩展不存在', 1003);
        }
        return new $class;	
    }

   public static function module($type='smartdb'){

        $class = '\\bear\\module\\'.$type.'\\build\\Base';
        if (!class_exists($class)) {
            throw new Exception($type . '扩展不存在', 1003);
        }
        return new $class;  
    }
   

   
}
