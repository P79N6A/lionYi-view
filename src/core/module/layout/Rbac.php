<?php
##version
namespace bear\module\layout;
use bear\Bear;
use bear\extend\db\Db;
use bear\sys\config\Config;
use bear\extend\db\database\Schema;

class Rbac extends Base
{
    /**
     * [adminGroup 后台组]
     * @Author   Jerry
     * @DateTime 2018/9/16-08:29
     * @Example  eg:
     * @return   [type]                   [description]
     */
public function adminGroup(){
//    show(Db::table('admin')->get());
    return Bear::make('table')
        ->addColumn('name','组名')
//        ->addColumn('groupname','组名')
        ->setData(Db::table('role_group')->get())
        ->addRightBtn('edit')
        ->addTopBtn('edit')
        ->addRightBtn('del')
        ->addRightBtn('auth','授权',['url'=>"rbac?id={id}",'icon'=>'','class'=>'bearAlert btn-xs'])
//        ->addRightBtn('setpwd','修改密码',['href'=>'','icon'=>''])
        ->fetch();
}

    /**
     * [edit 编辑分组]
     * @Author   Jerry
     * @DateTime 2018/9/16-08:56
     * @Example  eg:
     * @return   [type]                   [description]
     */
public function edit(){
    $id = (int)getInput('id');
    $name = Db::table('role_group')->where("id = '{$id}'")->pluck('name');
    $name = $name?$name:'';
    if(Bear::ispost()){
        $data =getInput();
        if($id){
            Db::table('role_group')->where("id = '{$id}'")->update($data);
        }else{
            Db::table('role_group')->insert($data);
        }
        returnJson(0);
        exit;
    }
    return Bear::make('form')
            ->addText('name','组名',$name)
            ->addHidden('id',$id)
            ->fetch();

}

    /**
     * [setpwd 设置密码]
     * @Author   Jerry
     * @DateTime 2018/9/16-08:56
     * @Example  eg:
     * @return   [type]                   [description]
     */
public function setpwd(){

}

    /**
     * [rbac rbac权限处理]
     * @Author   Jerry
     * @DateTime 2018/9/16-18:52
     * @Example  eg:
     * @return   [type]                   [description]
     */
public function rbac(){
    $id = (int)getInput('id');
    if(!$id) Bear::make('layout')->error('参数错误');
    if(Bear::isPost()){
        $request = getInput();
        $power = isset($request['power'])?$request['power']:[];
        if($power){
            Db::table('role_group_access')->where("role_id = '{$id}'")->delete();

            foreach ($power as $item) {
                Db::table('role_group_access')->insert([
                   'create_date'=>date('Y-m-d H:i:s'),
                   'url'        =>trim($item,'/'),
                   'role_id'    =>$id,

                ]);
            }
        }
        returnJson(0,null,['href'=>'parentReload']);
        exit();
    }
    ##当前权限组的权限列表
    $roles = Db::table('role_group_access')->where("role_id = '{$id}'")->lists('url');
//    show($roles);
    $data['menus'] = include ROOT_PATH."/../application/common/menu/admin.php";
    $data['roles'] = $roles;
    return Bear::make('layout')->rbac($data);
}

   
}