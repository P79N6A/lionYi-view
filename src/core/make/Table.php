<?php
##version
##表格
namespace bear\make;
use bear\Bear;
// use \bear\
class Table extends Base
{
    protected $type = 'table';
    public  function test(){
        return $this;
    }

    /**
     *[Function 添加列]
     * @Funtion addColumn.
     * @Author: JerryChen
     * @Date: 18-8-22 上午10:56
     * @Example:  eg:
     * @Return  [type]  [description]
     */
    public function addColumn($field='',$title='',$param=[],$type='',$callback='',$callbackMethod=''){
        $this->_assembleThead($field,$title,$param);
        $this->_document['_thead'][] = $this->_assembleThead($field,$title,$param);
        $_column = [
            'title'         =>$title,
            'param'         =>$param,
            'field'         =>$field,
            'type'          =>$type,
            'callback'      =>$callback,
            'callbackMethod'=>$callbackMethod,
        ];
        $this->_document['_column'][] = $_column;
        return $this;
    }
    /**
     * [setData description]
     * @Author   Jerry
     * @DateTime 2018-08-22T12:55:21+0800
     * @Example  eg:
     */
    public function setData($data){
        $data = (object)$data;
        if($data){
            $this->_document['_src'] =isset($data->res)?$data->res:[];
            $this->_document['_pages'] = isset($data->render)?$data->render:''; 
        }
       
        return $this;
    }
    /**
     * [setSearch 设置搜索]
     * @Author   Jerry
     * @DateTime 2018-09-06T14:16:12+0800
     * @Example  eg: setSearch(['id'=>'主键','title'=>'标题'])
     */
    public function setSearch($field){
        $this->_document['_search'] = $field;
        if(!empty($field)) $this->_document['_search_all'] = implode("|", array_keys($field));
        return $this;
    }
    /**
     * [addTopBtn description]
     * @Author   Jerry
     * @DateTime 2018-08-25T15:24:59+0800
     * @Example  eg:
     * @param    [type]                   $tag   [eg :add edit delete]
     * @param    [type]                   $title [description]
     * @param    array                    $param [description]
     */
    public function addTopBtn($tag,$title='',$param=[]){
        $this->_document['_topBtn'][] =[
            'title' =>$title,
            'tag'   =>$tag,
            'param' =>$this->_setParam($tag,$title,$param)
        ]; 
        return $this;
    }
    /**
     * [addRightBtn description]
     * @Author   Jerry
     * @DateTime 2018-08-27T21:49:34+0800
     * @Example  eg:
     * @param    [type]                   $tag   [description]
     * @param    [type]                   $title [description]
     * @param    array                    $param [description]
     */
     public function addRightBtn($tag,$title='',$param=[]){
        $param['class'] = isset($param['class'])?$param['class']:' btn-xs';
        $this->_document['_rightBtn'][] =[
            'title' =>$title,
            'tag'   =>$tag,
            'param' =>$this->_setParam($tag,$title,$param)
        ]; 
        return $this;
    }
    /**
     * [setPages 分页 合并到设置数据一起]
     * @Author   Jerry
     * @DateTime 2018-08-23T10:36:02+0800
     * @Example  eg:
     * @param    [type]                   $count [description]
     * @param    integer                  $limit [description]
     * @param    integer                  $showPageStep [分页显示的前后页码步长]
     */
    // public function setPages($render){
    //     $this->_document['_pages'] = $render;
    //     return $this;
    // }
    /**
     * [setThead 组合表头参数]
     * @Author   Jerry
     * @DateTime 2018-08-22T11:56:31+0800
     * @Example  eg:
     * @param    [type]                   $field [description]
     * @param    [type]                   $title [description]
     * @param    [type]                   $param [description]
     */
    private function _assembleThead($field,$title,$param){
        $thead = [];
        if(is_array($param)&&count($param)>0){
            foreach ($param as $k => $v) {
               $thead[$k] = $v;
            }
        }
        $thead['field'] = $field;
        $thead['title'] = $title;
        return  $thead;
    }
    /**
     * [__callback description]
     * @Author   Jerry
     * @DateTime 2018-08-14T15:56:50+0800
     * @Example  eg:
     * @return   [type]                   [description]
     */
    public function __call($name,$param){
        if(count($param)==1){
            if(substr($name, 0,3)=='set'){
                $this->_document[strtolower(substr($name, 3))] = current($param);##添加属性  
            }
        }
        return $this;
    }
   
}
