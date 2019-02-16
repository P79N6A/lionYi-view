<?php
##version
namespace bear\module\layout;
use bear\Bear;
use bear\extend\db\Db;
use bear\sys\config\Config;
use bear\extend\db\database\Schema;

class Smartdb extends Base
{
  
  /**
   * [tableList 数据表列表]
   * @Author   Jerry
   * @DateTime 2018-08-27T20:34:48+0800
   * @Example  eg:
   * @return   [type]                   [description]
   */
  public function tableList($database=''){
    $database = $database?$database:Config::get('database.database');
    $tables =Schema::getAllTableInfo($database); 
    return Bear::make('table')
          ->addColumn('tablename','表名')
          ->addColumn('engine','引擎')
          ->addColumn('charset','编码')
          ->setData($tables['table'])
          ->addRightBtn('binddatabase','绑定数据',['icon'=>'fa fa-setting','href'=>'test'])
          ->fetch();
  }
  /**
   * [item 项目管理]
   * @Author   Jerry
   * @DateTime 2018-08-29T14:37:06+0800
   * @Example  eg:
   * @return   [type]                   [description]
   */
  public function item(){

    return Bear::make('table')
          ->setTitle('项目列表')
          ->addColumn('id','ID')
          ->addColumn('name','项目名称')
          ->addColumn('create_date','时间')
          ->addColumn('sort','排序')
          ->addColumn('url','数据地址','','callback',function($id){
              return '/superadmin/item/dataMsg?itemid=7';
          })
          ->addColumn('remark','remark')
          ->addRightBtn('itemEdit','修改',['href'=>$this->rote.'itemEdit?id={id}','icon'=>'glyphicon glyphicon-edit'])
          ->addRightBtn('baseSet','基本设置',['href'=>$this->rote.'baseSet?itemid={id}','icon'=>'glyphicon glyphicon-th'])
          ->addRightBtn('dataMsg','数据管理',['href'=>$this->rote.'dataMsg?itemid={id}','icon'=>'glyphicon glyphicon-floppy-disk'])
          ->addRightBtn('delete','删除项目',['href'=>$this->rote.'itemDel?itemid={id}','icon'=>'glyphicon glyphicon-trash','confirm'=>'true'])
          ->addTopBtn('edit','新建项目',['href'=>'itemEdit'])
          ->setData(Db::table('model_item')->paginate())
          ->fetch();

  }
  /**
   * [itemDel 删除项目]
   * @Author   Jerry
   * @DateTime 2018-09-03T14:14:10+0800
   * @Example  eg:
   * @return   [type]                   [description]
   */
  public function itemDel(){
    $itemid = isset($_GET['itemid'])?(int)$_GET['itemid']:0;
    if(!$itemid) return Bear::make('layout')->error('参数错误');
    // die;
    if(Db::table("model_item")->delete($itemid)){
      return Bear::make('layout')->success();
    }else{
      return Bear::make('layout')->error();
    }
  }
  /**
   * [baseSet 基本设置]
   * @Author   Jerry
   * @DateTime 2018-08-30T14:00:33+0800
   * @Example  eg:
   * @return   [type]                   [description]
   */
  public function baseSet(){
   ##表单类型
    $itemid     = isset($_GET['itemid'])?(int)$_GET['itemid']:0;
    $table      = $this->fItemidToTable($itemid);
    $attributes = ['table_show'=>'列表显示','form_edit'=>'可编辑','table_search'=>'列表可搜索','table_sort'=>'列表可排序'];
    if(Bear::isPost()){
      ##组合数据
      $input = $_POST;
      Db::table('models_field_setting')->where("`table` = '{$table}'")->delete();
      foreach ($input['field'] as $v) {
        $insert = [
          'field'     =>$v,
          'table'     =>$input['table'],
          'title'     =>$input[$v.'title'],
          'options'   =>$input[$v.'options'],
          'formtype'  =>$input[$v.'formtype'],
          'tips'      =>$input[$v.'tips'],
          'form_sort' =>$input[$v.'form_sort'],
          'list_sort' =>$input[$v.'list_sort'],
          'default'   =>isset($input[$v.'default'])?$input[$v.'default']:'',

        ];
        if(Db::table('models_field_setting')->where("`table` = '{$insert['table']}' and `field` = '{$insert['field']}'")->count()){
            Db::table('models_field_setting')->where("`table` = '{$insert['table']}' and `field` = '{$insert['field']}'")->update($insert);
        }else{
            Db::table('models_field_setting')->insert($insert);
        }

        ##设置属性
        $chooseAttr = [];
        if(isset($input[$v.'attribute'])){
            if(!is_array($input[$v.'attribute'])){
              $chooseAttr[] = $input[$v.'attribute'];
            }else{
              $chooseAttr = $input[$v.'attribute'];
            }
        }
        $attributeData = [];##插入的属性
        foreach (array_keys($attributes) as $k => $v) {
            $attributeData[$v] = in_array($v, $chooseAttr)?1:0;
        }
        Db::table('models_field_setting')->where("`table` = '{$insert['table']}' and `field` = '{$insert['field']}'")->update($attributeData);
    
        

      }
      Bear::returnJson(0);
      exit;
    }
    $formTypes    = [];
    foreach (Config::get('bear.bear_form_type') as $v) {
            $formTypes[$v] = $v;
            
    }
    
    
   
    ##设置值
    $allSetting         = Db::table('models_field_setting')->where("`table` = '{$table}'")->get();
    $settingsDefault    = [];
    ##当前表的所有字段
    $fields = Db::table($table,true)->getFields();
    $field  = $this->_fieldSort($table);
    // show($allSetting);
    ##排序和附默认值  BEGIN
    foreach ($fields as $k => $v) {
        ## 给字段附值
        foreach ($allSetting as $ksetting => $vsetting) {
          if($vsetting['field']==$k){
              $settingsDefault[$k] = $vsetting;
          }
        }
       
    }
    // ksort($field);
    ##判断值是否存在，并且重新附值
    foreach ($fields as $k => $v) {
      $settingsDefault[$k]['isshow']    = isset($settingsDefault[$k]['isshow'])?$settingsDefault[$k]['isshow']:'';
      $settingsDefault[$k]['options']   = isset($settingsDefault[$k]['options'])?$settingsDefault[$k]['options']:'';
      $settingsDefault[$k]['title']     = isset($settingsDefault[$k]['title'])?$settingsDefault[$k]['title']:'';
      $settingsDefault[$k]['formtype']  = isset($settingsDefault[$k]['formtype'])?$settingsDefault[$k]['formtype']:'';
      $settingsDefault[$k]['tips']      = isset($settingsDefault[$k]['tips'])?$settingsDefault[$k]['tips']:'';
      $settingsDefault[$k]['default']   = isset($settingsDefault[$k]['default'])?$settingsDefault[$k]['default']:'';
      $settingsDefault[$k]['table_show']   = isset($settingsDefault[$k]['table_show'])?$settingsDefault[$k]['table_show']:'';
      $settingsDefault[$k]['table_show']   = isset($settingsDefault[$k]['table_show'])?$settingsDefault[$k]['table_show']:'';
      $settingsDefault[$k]['form_edit']    = isset($settingsDefault[$k]['form_edit'])?$settingsDefault[$k]['form_edit']:'';
      $settingsDefault[$k]['table_search'] = isset($settingsDefault[$k]['table_search'])?$settingsDefault[$k]['table_search']:'';
      $settingsDefault[$k]['table_sort']   = isset($settingsDefault[$k]['table_sort'])?$settingsDefault[$k]['table_sort']:'';
    }
     ##排序和附默认值  END
     // show($settingsDefault);
    $data['formType']           = $formTypes;
    $data['field']              = $field;
    $data['table']              = $table;
    $data['settingsDefault']    = $settingsDefault;
    $data['attributes']         = $attributes;
    $data['sorUrl']             = $this->rote."sort?table={$table}&hideTop=true";
   return Bear::make('layout')->setTitle('字段基本设置')->fetch('layout/smartdb_baseset.tpl',$data);


  }
  /**
   * [_fieldSort 字段排序处理]
   * @Author   Jerry
   * @DateTime 2018-09-05T10:15:43+0800
   * @Example  eg:
   * @param    [type]                   $table [description]
   * @param    string                   $f     [form_sort:表单排序，list_sort：列表排序]
   * @return   [type]                          [description]
   */
  private  function _fieldSort($table,$f='form_sort',$unset=[]){
    ##设置值
    $allSetting   = Db::table('models_field_setting')->where("`table` = '{$table}'")->get();
    $fields = Db::table($table,true)->getFields();
    $sortField  = [];
    $mergeField = [];
    $loop = 1;
    foreach ($fields as $k => $v) {
      $loop++;
      ## 给数据库中存在字段附排序值
      foreach ($allSetting as $ksetting => $vsetting) {
          if($vsetting['field']==$k){
              $field[$vsetting[$f].'-'.$k]['field']  = $k;
              $field[$vsetting[$f].'-'.$k]['title']  = $vsetting['title']?$vsetting['title']:$k;
              $mergeField[] = $k;
          }
      }
      ##数据库中没有记录的值（新回的字段）
      if(!in_array($k, $mergeField)){
            $field[(count($fields)+$loop).'-'.$k]['field']  = $k;
            $field[(count($fields)+$loop).'-'.$k]['title']  = $k;
        }
    }
    ksort($field);
    foreach ($field as $k => $v) {
        if(in_array($v['field'], $unset)) unset($field[$k]);
    }
    return $field;
  }
  /**
   * [dataMsg 数据管理]
   * @Author   Jerry
   * @DateTime 2018-08-30T11:59:45+0800
   * @Example  eg:
   * @return   [type]                   [description]
   */
  public function dataMsg(){
    $itemid = isset($_GET['itemid'])?(int)$_GET['itemid']:0;
    $table = $this->fItemidToTable($itemid);
    if(!$table)echo "<script>alert('请先绑定需要管理的表');window.history.go(-1);</script>";
    if(!Db::table('models_field_setting')->where("`table` = '{$table}'")->count()) echo "<script>alert('请先进行基本设置');window.history.go(-1);</script>";

    ##查出列表显示的相关信息
    $listShow = Db::table('models_field_setting')->where("table_show = 1 and `table`='{$table}'")->orderBy('list_sort','asc')->field('title,field')->get();
    $html = Bear::make('table');
    foreach ($listShow as $v) {
       $html = $html->addcolumn($v['field'],$v['title']);
    }
    ##可搜索字段
    $search = Db::table('models_field_setting')->where("`table`='{$table}' and table_search = 1")->orderBy('list_sort','asc')->lists('field,title');
    if($search){
      $html = $html->setSearch($search);
    }
    
    $dataList = Db::table($table,true)->where(getSearch())->paginate(10);
    // show($dataList);
    return $html
            ->setData($dataList)
            ->addTopBtn('sort','列表排序',['url'=>$this->rote."sort?table={$table}&f=list_sort",'class'=>'bearAlert'])
            ->addRightBtn('edit','编辑',['href'=>$this->rote."dataEdit?itemid={$itemid}&id={id}"])
            ->addRightBtn('del','删除',['href'=>$this->rote."dataDel?itemid={$itemid}&id={id}"])
            // ->setPage($dataList->render())
            ->fetch();
    
  }

  /**
   * [dataEdit 编辑数据]
   * @Author   Jerry
   * @DateTime 2018-08-31T16:29:31+0800
   * @Example  eg:
   * @return   [type]                   [description]
   */
  public function dataEdit(){
    ##所有字段
     $itemid = (int)getInput('itemid');
     $table = $this->fItemidToTable($itemid);
     ##主键
     $pk = Db::table($table,true)->getPrimaryKey();
     if($id = getInput($pk)){
        ##数据库数据
        @extract(Db::table($table,true)->where("`{$pk}` = '{$id}'")->first());
     }
     ##设置值
      $allSetting   = Db::table('models_field_setting')->where("`table` = '{$table}'")->get();
      $fields = Db::table($table,true)->getFields();
      $sortField  = [];
      $mergeField = [];
      $field      = [];
      foreach ($fields as $k => $v) {
        ## 给数据库中存在字段附排序值
        foreach ($allSetting as $ksetting => $vsetting) {
            if($vsetting['field']==$k){
                $field[$vsetting['form_sort'].'-'.$k]['field']     = $k;
                $field[$vsetting['form_sort'].'-'.$k]['title']     = $vsetting['title']?$vsetting['title']:$k;
                $field[$vsetting['form_sort'].'-'.$k]['options']   = $vsetting['options']?$vsetting['options']:'';
                $field[$vsetting['form_sort'].'-'.$k]['formtype']  = $vsetting['formtype']?$vsetting['formtype']:'text';
                $field[$vsetting['form_sort'].'-'.$k]['tips']      = $vsetting['tips']?$vsetting['tips']:'';
                $field[$vsetting['form_sort'].'-'.$k]['default']   = isset($$k)?$$k:($vsetting['default']?$vsetting['default']:'');
                $mergeField[] = $k;
            }
        }
        ##数据库中没有记录的值（新回的字段）
        if(!in_array($k, $mergeField)){
              $field[$vsetting[$f].'-'.$k]['field']     = $k;
              $field[$vsetting[$f].'-'.$k]['title']     = $k;
              $field[$vsetting[$f].'-'.$k]['options']   = '';
              $field[$vsetting[$f].'-'.$k]['formtype']  = 'text';
              $field[$vsetting[$f].'-'.$k]['tips']      = '';
              $field[$vsetting[$f].'-'.$k]['default']   = '';
          }
      }
      ksort($field);

      ##去掉基本设置中不允许编辑的表单
       foreach ($field as $k=>$v) {
        ## 给数据库中存在字段附排序值
        foreach ($allSetting as $ksetting => $vsetting) {
            if($vsetting['field']==$v['field']&&$vsetting['form_edit']!=1) unset($field[$k]);
        }
      }

      ##组合表单
      $Form = Bear::make('form');
      foreach ($field as $key => $v) {
            $method = 'add'.ucfirst($v['formtype']);
           
            if($v['options']){
              $Form = $Form->$method($v['field'],$v['title'],$v['options'],$v['default']);
            }else{

              $Form = $Form->$method($v['field'],$v['title'],$v['default']);
            }
            
      }
      return $Form
      ->addTopBtn('sort','表单排序',['url'=>$this->rote."sort?table={$table}&hideTop=true",'class'=>'bearAlert','icon'=>'fa fa-sort-alpha-asc'])
      ->addTopBtn('baseSet','基本设置',['url'=>$this->rote."baseSet?itemid={$itemid}",'class'=>'bearAlert','icon'=>'glyphicon glyphicon-th'])
      ->fetch();

  }
  /**
   * [sort description]
   * @Author   Jerry
   * @DateTime 2018-08-31T17:06:46+0800
   * @Example  eg:
   * @return   [type]                   [description]
   */
  public function sort(){
    $table = getInput('table');
    $f  = getInput('f')?getInput('f'):'form_sort';
    if(!$table) return Bear::make('layout')->error('参数错误');
    if(Bear::isPost()){
      $data = getInput('post.');
      if(is_array($data)&&$data){
        foreach ($data as $k => $v) {
         if(Db::table('models_field_setting')->where("`table` = '{$table}' and `field` = '{$k}'")->count()){
             DB::table('models_field_setting')->where(" `field` = '{$k}' and `table`='{$table}'")->update([$f=>$v]);
         }else{
            DB::table('models_field_setting')->insert([$f=>$v,'table'=>$table,'field'=>$k]);
         }
        }
      }
      returnJson(0,null,['href'=>'parentReload']);
      exit;
    }
    if($f=='form_sort'){
        $unset =Db::table('models_field_setting')->where("`table` = '{$table}' and form_edit != 1")->lists('field');
    }else{
        $unset =Db::table('models_field_setting')->where("`table` = '{$table}' and table_show != 1")->lists('field');
    }
    ##排序后的字段
    $field = $this->_fieldSort($table,$f,$unset);
    return Bear::make('layout')->sort($field);
  }
  /**
   * [itemEdit 编辑项目]
   * @Author   Jerry
   * @DateTime 2018-08-29T14:37:14+0800
   * @Example  eg:
   * @return   [type]                   [description]
   */
  public function itemEdit(){
    if(Bear::isPost()){
        if(Bear::module('post')->save($_POST,'model_item')==true){
            Bear::returnJson(0);
        }
        exit();
     } 
     ##所有表
    $allTable =Schema::getAllTableInfo(Config::get('database.database')); 
    ##已被选择的表
    $chooseTable = Db::table('model_item')->lists('table');
    
    $tables = [];
    foreach ($allTable['table'] as $key => $v) {
      if(!in_array($key, $chooseTable)) $tables[$key] = $key;
      
    }
    if($id = isset($_GET['id'])?(int)$_GET['id']:0){
      @extract($info = Db::table('model_item')->where("id = '{$id}'")->first());
      
    }

    return Bear::make('form')
        ->setTitle('编辑项目')
        ->addText('name','项目名称',isset($name)?$name:'')
        ->addSelect('table','选择表',$tables,isset($table)?$table:'')
        // ->addSelect('single','是否单页',[1=>'单页',2=>'分类'],isset($single)?$single:'')
        ->addText('bind_field','关联字段',isset($bind_field)?$bind_field:'')
        ->addSelect('table_child','子表',$tables,isset($table_child)?$table_child:'')
        ->setTrigger('single','2','bind_field,table_child')
        ->addHidden('id',$id)
        ->addTextarea('remark','备注',isset($remark)?$remark:'')
        ->fetch();
    
       
  }


   
}