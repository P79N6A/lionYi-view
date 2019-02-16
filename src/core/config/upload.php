<?php
// CREATE TABLE `attachment` (
//   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
//   `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
//   `path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
//   `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图路径',
//   `mime` varchar(64) NOT NULL DEFAULT '' COMMENT '文件mime类型',
//   `ext` char(4) NOT NULL DEFAULT '' COMMENT '文件类型',
//   `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
//   `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
//   `sha1` char(40) NOT NULL DEFAULT '' COMMENT 'sha1 散列值',
//   `driver` varchar(16) NOT NULL DEFAULT 'local' COMMENT '上传驱动',
//   `download` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
//   `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
//   `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
//   `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
//   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
//   PRIMARY KEY (`id`)
// ) ENGINE=MyISAM AUTO_INCREMENT=4144 DEFAULT CHARSET=utf8 COMMENT='附件表';
return [
    /*
    |--------------------------------------------------------------------------
    | 上传类型
    |--------------------------------------------------------------------------
    | local:本地上储存  oss: 阿里云OSS储存,需要设置oss.php配置文件
    */
    'mold' => 'oss',
    // 'mold' => 'local',

    /*
    |--------------------------------------------------------------------------
    | 类型
    |--------------------------------------------------------------------------
    | 允许上传的文件类型
    */
    'type' => 'jpg,jpeg,gif,png,zip,rar,doc,txt,pem',

    /*
    |--------------------------------------------------------------------------
    | 允许上传的文件大小单位KB
    |--------------------------------------------------------------------------
    */
    'size' => 5000000,

    /*
    |--------------------------------------------------------------------------
    | 上传文件的保存目录
    |--------------------------------------------------------------------------
    */
    'path' => 'attachment/'.date('Y/m/d'),

    'filter'=> false,## 开启此功能需要和MYSQL搭配使用，会检查数据库中图片HASH来判断是否存在此图片，如果存在就不会上传


];