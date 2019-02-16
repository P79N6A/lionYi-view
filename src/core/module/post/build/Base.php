<?php
##version
#配置项
namespace bear\module\post\build;
use bear\Bear;
use bear\extend\db\Db;
use bear\sys\config\Config;
use bear\sys\session\Session;
use bear\sys\validate\Validate;
use bear\sys\crypt\Crypt;
class Base
{
	public $gourl;
    /**
     * [save description]
     * @Author   Jerry
     * @DateTime 2018-08-20T17:40:19+0800
     * @Example  eg:
     * @param    [type]                   $data       [post数据]
     * @param    string                   $table      [存的表名]
     * @param    string                   $configName [配置项名]
     * @return   [type]                               [BOOL]
     */
    public function save($data,$table,$pk=''){
        if(!$data) throw new \Exception("数据不能为空", -1);
        if(!$table) throw new \Exception("表名必填", -1);
        if(!$pk){
            ##表的主键
            $pk = Db::table($table)->getPrimaryKey();
        }

        // Validate::check($data,unserialize(Crypt::decrypt($data['validate'],$data['token'])));
      // show(Validate::getError());


        // die;
    	if(Bear::isPost()){
    		if(isset($data['extra'])) unset($data['extra']);
            if(Session::get('__token__')!=$data['token']){
                Bear::returnJson(-10);
            }
            unset($data['token']);

            if((int)$data[$pk]){
                $pkValue = $data[$pk];
                unset($data[$pk]);
                // show([$pk=>$pkValue]);
                ##修改
                Db::table($table)->where("$pk='$pkValue'")->update($data);
            }else{
                ##新加
               Db::table($table)->insert($data);
            }
            $this->gourl= $data['gourl'];
    		return true;
    	}
    }
    /**
     * [getGourl description]
     * @Author   Jerry
     * @DateTime 2018-08-25T21:08:29+0800
     * @Example  eg:
     * @return   [type]                   [description]
     */
    public function getGoUrl(){
        return $this->gourl;
    }
    /**
     * [form 表单]
     * @Author   Jerry
     * @DateTime 2018-08-20T15:09:02+0800
     * @Example  eg:
     * @return   [type]                   [description]
     */
    public function form($setting,$url=''){
        return Bear::make('form')->setAction($url)->addForms($setting)->fetch();
    }
    /**
     * [save description]
     * @Author   Jerry
     * @DateTime 2018-08-20T17:40:19+0800
     * @Example  eg:
     * @param    [type]                   $data       [post数据]
     * @param    string                   $table      [存的表名]
     * @param    string                   $configName [配置项名]
     * @return   [type]                               [BOOL]
     */
    public function saveSetting($data,$table='setting',$configName='web'){
        if(Bear::isPost()){
            if(isset($data['extra'])) unset($data['extra']);
            if(Session::get('__token__')!=$data['token']){
                Bear::returnJson(-10);
            }
            unset($data['token']);
            foreach ($data as $k => $v) {
                if(Db::table($table)->where("varname='{$k}'")->count()>0){
                    ##修改
                    Db::table($table)->where("varname='{$k}'")->update(['value'=>serialize($v)]);
                }else{
                    ##新加
                    Db::table($table)->where("varname='{$k}'")->insert(['varname'=>$k,'value'=>serialize($v)]);
                    
                }
            }
            
            if(is_array($re = Db::table($table)->get())){
                $setting = [];
                foreach ($re as $k => $v) {
                    // show($v);
                    $setting[$v['varname']] = ($v['value']?@unserialize($v['value']):'');
                }
            }
            Config::write($setting,$configName);
            return true;
            exit();
        }
    }

    /**
     * [login description]
     * @Author   Jerry
     * @DateTime 2018-08-21T11:39:38+0800
     * @Example  eg:
     * @param    [type]                   $table        [表名]
     * @param    [type]                   $useFildName  [数据库中用户字段名]
     * @param    [type]                   $pwdFieldName [数据库中密码字段名]
     * @return   [type]                                 [description]
     */
   public function login($table='users',$useFildName='user_name',$pwdFieldName='password',$saltFieldName='salt'){
     if(Bear::isPost()){
        $user = htmlspecialchars(trim($_POST['email']));
        $pwd = htmlspecialchars(trim($_POST['password']));
        if(!$userinfo = Db::table($table)->where("{$useFildName} = '{$user}'")->field([$pwdFieldName,$useFildName,$saltFieldName])->first()){
            Bear::returnJson(1104);
        }else{
            if($this->encode_pwd($pwd,$userinfo[$saltFieldName])==$userinfo[$pwdFieldName]){
                Bear::returnJson(0,'登陆成功');
            }else{
                Bear::returnJson(1105);
            }

        }
      }
   } 

   private function encode_pwd($password, $salt)
    {
        $password = md5(md5($password) . $salt);

        return $password;
    }
   
}