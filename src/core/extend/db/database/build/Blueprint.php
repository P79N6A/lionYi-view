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

use bear\sys\config\Config;
use bear\extend\db\database\Schema;
use bear\extend\db\Db;

/**
 * 表结构生成器
 * Class Blueprint
 *
 * @package 
 */
class Blueprint
{
    use Field;
    //不加前缀的表
    protected $noPreTable;
    //数据表
    protected $table;
    //表注释
    protected $tableComment;

    public function __construct($table, $tableComment = '')
    {
        $this->noPreTable   = $table;
        $this->table        = Config::get('database.prefix').$table;
        $this->tableComment = $tableComment;
    }

    /**
     * 新建表
     *
     * @return bool
     */
    public function create()
    {
        $sql         = "CREATE TABLE ".$this->table.'(';
        $instruction = [];
        foreach ($this->fields as $n) {
            if ( ! empty($n['unsigned'])) {
                $n['sql'] .= " unsigned ";
            }
            if (empty($n['null'])) {
                $n['sql'] .= ' NOT NULL';
            }
            if (isset($n['default'])) {
                $n['sql'] .= " DEFAULT ".$n['default'];
            }
            if (isset($n['comment'])) {
                $n['sql'] .= " COMMENT '{$n['comment']}'";
            }
            $instruction[] = $n['sql'];
        }
        $sql .= implode(',', $instruction);
        //索引
        if ($this->keys) {
            $sql .= ','.implode(',', $this->keys);
        }
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET UTF8 COMMENT='{$this->tableComment}'";

        return Db::execute($sql);
    }

    /**
     * 修改字段
     *
     * @return bool
     */
    public function change()
    {
        $sql = 'ALTER TABLE '.$this->table." MODIFY ";
        foreach ($this->fields as $n) {
            if (Schema::fieldExists($n['field'], $this->noPreTable)) {
                if ( ! empty($n['unsigned'])) {
                    $n['sql'] .= " unsigned ";
                }
                if (empty($n['null'])) {
                    $n['sql'] .= ' NULL';
                }
                if ( ! empty($n['default'])) {
                    $n['sql'] .= " DEFAULT ".$n['default'];
                }
                if ( ! empty($n['comment'])) {
                    $n['sql'] .= " COMMENT '{$n['comment']}'";
                }
                $s = $sql.$n['sql'];

                return Db::execute($s);
            }
        }
    }

    /**
     * 添加字段
     *
     * @return bool
     */
    public function add()
    {
        $sql = 'ALTER TABLE '.$this->table." ADD ";
        foreach ($this->fields as $n) {
            if ( ! Schema::fieldExists($n['field'], $this->noPreTable)) {
                if ( ! empty($n['unsigned'])) {
                    $n['sql'] .= " unsigned ";
                }
                if (empty($n['null'])) {
                    $n['sql'] .= ' NOT NULL';
                }
                if ( ! empty($n['default'])) {
                    $n['sql'] .= " DEFAULT ".$n['default'];
                }
                if ( ! empty($n['comment'])) {
                    $n['sql'] .= " COMMENT '{$n['comment']}'";
                }
                $s = $sql.$n['sql'];

                return Db::execute($s);
            }
        }
    }

    /**
     * 生成索引
     *
     * @return bool
     */
    protected function createIndex()
    {
        foreach ($this->fields as $field) {
            if ( ! empty($field['index'])) {
                Schema::addIndex($this->noPreTable, $field['index']);
            }
            if ( ! empty($field['unique'])) {
                Schema::addUnique($this->noPreTable, $field['index']);
            }
        }

        return true;
    }
}