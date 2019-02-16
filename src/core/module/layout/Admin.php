<?php
##version
namespace bear\module\layout;
use bear\Bear;
use bear\extend\db\Db;
use bear\sys\config\Config;
use bear\extend\db\database\Schema;

class Admin
{
    public function index(){
        // return Bear::make('form')
        // ->addAlert('alert','Alert提示信息','danger')
        // ->addText('text','单行文本信息','')
        // ->addRadio('radio','单选按钮',['选项一','选项三'])
        // ->addCheckbox('radio','多选按钮',['选项一','选项三'])
        // ->addDate('date', '选择时间')
        // ->addSelect('test','普通下拉',['test1','test2','test4'])
        // ->addSelect('test','普通下拉选择多个',['test1','test2','test4'],'',['multiple'=>''])
        // ->fetch();

        //菜单
        $defaultmenu = include ROOT_PATH."/../application/common/menu/admin.php";
        //无限分类处理
        $data['html'] = $this->treeMenu($defaultmenu['adminmenu']);
        return Bear::make('layout')->admin($data);
    }

    private function treeMenu($menu,$parentkey=0,$level = 0,$parenturl=""){
        $parentlevel = 0;
        $clss = $level>0?"collapse  two-level-menu":"list-group";
        $id   = $level>0?"":"mainnav-menu";
        $html = '<ul class="'.$clss.'" id="'.$id.'">';
        $level++;
        foreach ($menu as $k => $v) {
            $v['url'] = isset($v['url'])?$v['url']:'';
            $v['ico'] = isset($v['ico'])?$v['ico']:'';
            $v['name'] = isset($v['name'])?$v['name']:'';
            if(isset($v['child'])&&is_array($v['child'])){
                $html .= '<li class="" url="'.$v['url'].'" key="'.$k.'" levelid="'.$v['url'].'-'.$k.'-'.$level.'" parentlevelid="'.$parenturl.'-'.$parentkey.'-'.($level-1).'" parentkey="'.$parentkey.'" level="'.$level.'" parentlevel="'.$parentlevel.' " ><a href="javascript:;" > <i class="fa '.$v['ico'].'"></i><span class="menu-title">'.$v['name'].'</span><i class="arrow"></i></a>';
                $html.=self::treeMenu($v['child'],$k,$level);
                $html.='</li>';

            }else{
                $html .= '<li class="checkmenu" url="'.$v['url'].'"  levelid="'.$v['url'].'-'.$k.'-'.$level.'" parentlevelid="'.$parenturl.'-'.$parentkey.'-'.($level-1).'" key="'.$k.'" parentkey="'.$parentkey.'" level="'.$level.'" parentlevel="'.$parentlevel.' " ><a href="javascript:;" > <i class="fa '.$v['ico'].'"></i><span class="menu-title">'.$v['name'].'</span></a></li>';
            }

        }
        $html.="</ul>";
        return $html;
    }
    public function welcome(){
        return Bear::make('layout')->welcome();
    }

}