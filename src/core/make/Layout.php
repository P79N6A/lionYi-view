<?php
##version
##表格
namespace bear\make;
use bear\Bear;
// use \bear\
class Layout extends Base
{
    protected $type = 'layout';
   
    /**
     * [error description]
     * @Author   Jerry
     * @DateTime 2018-09-03T14:21:35+0800
     * @Example  eg:
     * @param    [type]                   $msg  [错误信息]
     * @param    integer                  $time [时间]
     * @param    type                   $type [error 404 500]
     * @return   []                         []
     */
    public function error($msg='操作失败',$time=3000){
        $data['msg'] = $msg;
        $data['time'] = $time;
        return $this->fetch('layout/error',$data);
    }

    /**
     * [success description]
     * @Author   Jerry
     * @DateTime 2018-09-03T15:08:26+0800
     * @Example  eg:
     * @param    string                   $msg  [description]
     * @param    integer                  $time [description]
     * @return   [type]                         [description]
     */
    public function success($msg='操作成功',$backurl='',$time=3000){
        $data['msg'] = $msg;
        $data['time'] = $time;
        $data['backurl'] = $backurl;
        return $this->fetch('layout/success',$data);
    }
    /**
     * [welcome 欢迎页]
     * @Author   Jerry
     * @DateTime 2018-08-31T17:08:23+0800
     * @Example  eg:
     * @return   [type]                   [description]
     */
    public function welcome(){

        return   $this->fetch('layout/welcome');
    }
     /**
     * [sort 设置排序]
     * @Author   Jerry
     * @DateTime 2018-08-31T17:08:16+0800
     * @Example  eg:
     * @return   [type]                   [data [id=>'1',title=>'test']]
     */
    public function sort($data=[]){
        if(!$data) return Bear::make('layout')->error('数据不能为空');
        $data['data'] = $data;
        return $this->fetch('layout/sort',$data);
    }

    /**
     * [admin 后台管理页面]
     * @Author   Jerry
     * @DateTime 2018/9/16-21:16
     * @param array $data
     * @Example  eg:
     * @return   [type]                   [description]
     */
    public function admin($data = []){

        return $this->fetch('layout/admin',$data);
    }
    /**
     * [rbac 用户组授权]
     * @Author   Jerry
     * @DateTime 2018/9/16-09:30
     * @param array $data
     * @Example  eg:roleID
     * @return   [type]                   [description]
     */
    public function rbac($data=[]){

        return $this->fetch('layout/rbac',$data);
    }
    /**
     * [__callback description]
     * @Author   Jerry
     * @DateTime 2018-08-14T15:56:50+0800
     * @Example  eg:
     * @return   [type]                   [description]
     */
    public function __call($name,$param){
        // $access = ['addText','addPassword','addCheckbox','addRadio','addSwitch','addSelect','addSelectSearch','addTextarea','addDate','addImg'];
        // if(!in_array($name, $access)) throw new \Exception($name." no this method ", -1);
        if(count($param)==1){
            if(substr($name, 0,3)=='set'){
                ##eg setTitlte('test');
                $this->_document[strtolower(substr($name, 3))] = current($param);##添加属性 
            }
        }
        return $this;
    }
   
}
