<?php
##version
namespace bear\sys;
use bear\sys\config\Config;
use bear\Bear;
use bear\sys\session\Session;
use bear\sys\crypt\Crypt;


class Sys
{
	/**
	 * [token description]
	 * @Author   Jerry
	 * @DateTime 2018-09-04T09:54:36+0800
	 * @Example  eg:
	 * @param    string                   $name [description]
	 * @return   [type]                         [description]
	 */
    public static function token($name = '__token__')
    {

        $token = Crypt::encrypt($_SERVER['REQUEST_TIME_FLOAT']);
        if (Bear::isAjax()||Bear::isPost()) {
            header($name . ': ' . $token);
        }
        Session::set($name,$token);
        return $token;
    }
   

   
    /**
     * [returnJson description]
     * @Author   Jerry
     * @DateTime 2018-08-16T11:24:49+0800
     * @Example  eg:
     * @return   [type]                   [description]
     * 
     */
    public static function returnJson($status=0,$msg=null,$data=[]){
        $data['href'] = isset($data['href'])?$data['href']:'JavaScript:history.go(-1)';##,_parentReload:关闭当前窗口，刷新父级 ,JavaScript:history.go(-1):返回上一页
        $data['target'] =  isset($data['target'])?$data['target']:'';'_self';##_blank：新窗口打开,_self:当前窗口打开
        // $data = array_merge_recursive($srData,$data);
         echo  json_encode([
        'status'=>(int)$status,
        'msg'   =>is_null($msg)?Config::get("msg.msg.{$status}"):($msg?$msg:''), ##当MSG为NULL时，MSG不会选择配置项里面的信息
        'data'  =>$data?$data:'',
        ],JSON_UNESCAPED_UNICODE);
        exit() ;
    }
    /**
     * [isPost 判断是否为post]
     * @Author   Jerry
     * @DateTime 2018-08-20T16:39:58+0800
     * @Example  eg:
     * @return   boolean                  [description]
     */
    public static function isPost()
    {
       return isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD'])=='POST';  
    }
  
    /**
     * [isGet description]
     * @Author   Jerry
     * @DateTime 2018-08-20T16:39:13+0800
     * @Example  eg:
     * @return   boolean                  [description]
     */
    public static function isGet()
    {
       return isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD'])=='GET';   
    }
     
   /**
    * [is_ajax description]
    * @Author   Jerry
    * @DateTime 2018-08-20T16:39:39+0800
    * @Example  eg:
    * @return   boolean                  [description]
    */
    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH'])=='XMLHTTPREQUEST'; 
    }
    /**
     * [is_cli description]
     * @Author   Jerry
     * @DateTime 2018-08-20T16:39:51+0800
     * @Example  eg:
     * @return   boolean                  [description]
     */
    public static function isCli()
    {
        return (PHP_SAPI === 'cli' OR defined('STDIN'));  
    }

}