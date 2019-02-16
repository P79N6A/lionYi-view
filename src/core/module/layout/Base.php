<?php
##version
namespace bear\module\layout;
use bear\Bear;
use bear\extend\db\Db;
use bear\sys\config\Config;
use bear\extend\db\database\Schema;

class Base
{
   public $rote = '/superadmin/item/';
  /**
   * [fItemidToTable 根据ITEMID找表名]
   * @Author   Jerry
   * @DateTime 2018-08-31T16:36:34+0800
   * @Example  eg:
   * @param    [type]                   $itemid [description]
   * @return   [type]                           [description]
   */
 public function fItemidToTable($itemid){
  return Db::table('model_item')->where("id = '{$itemid}'")->pluck('table');
 }


   
}