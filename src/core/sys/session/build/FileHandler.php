<?php
##version
namespace bear\sys\session\build;

use  bear\sys\config\Config;

/**
 * 文件处理
 * Class FileHandler
 *
 */
class FileHandler implements AbSession
{
    use Base;
    protected $dir;
    protected $file;
    //连接
    public function connect()
    {
        $dir = Config::get('bear.bear_dir').Config::get('session.file.path');
        //创建目录
        if ( ! is_dir($dir)) {
            mkdir($dir, 0755, true);
            file_put_contents($dir.'/index.html', '');
        }
        $this->dir  = realpath($dir);
        $this->file = $this->dir.'/'.$this->session_id.'.php';
    }

    //读取数据
    public function read()
    {
        if ( ! is_file($this->file)) {
            return [];
        }

        return unserialize(file_get_contents($this->file));
    }

    //保存数据
    public function write()
    {
        // self::connect();
        $data = serialize($this->items);

        return file_put_contents($this->file, $data, LOCK_EX);
    }

    //垃圾回收
    public function gc()
    {
        foreach (glob($this->dir.'/*.php') as $f) {
            if (basename($f) != basename($this->file) && (filemtime($f) + $this->expire + 3600) < time()) {
                unlink($f);
            }
        }
    }
}