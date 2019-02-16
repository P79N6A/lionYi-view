<?php
##version
namespace bear\module\layout;
use bear\Bear;
use bear\extend\db\Db;
use bear\sys\config\Config;
use bear\extend\db\database\Schema;

class Wx extends Base
{
 
/**
	 * [replyList 关键字回复列表]
	 * @Author   Jerry
	 * @DateTime 2018-08-25T14:06:26+0800
	 * @Example  eg:
	 * @return   [type]                   [description]
	 */
	public function replyList(){
		$table 	='wx_reply';
		$pages 	= (int)getInput('pages')>0?(int)getInput('pages'):1;
		$row 	= 30;
		$start 	= ($pages-1)*$row;
		return Bear::make('table')
			->addColumn('id','id')
			->addColumn('title','标题')
			->addColumn('type','回复类型')
			->addTopBtn('edit','添加')
			// ->setPk('id')
			->setData(Db::table($table)->limit($start,$row)->get())
			->fetch();
			
	}
	/**
	 * [editReply description]
	 * @Author   Jerry
	 * @DateTime 2018-08-25T16:06:32+0800
	 * @Example  eg:
	 * @return   [type]                   [description]
	 */
	public function editReply(){
		$table 	='wx_reply';
		if(Bear::isPost()){
			if(p::save($_POST,$table)==true){
				Bear::returnJson(0,null,['href'=>p::getGoUrl()]);
			}
			exit;
		}
		return Bear::make('form')
			->addText('title','标题')
			->addImg('link','封面图')
			->addTextarea('content','内容')
            ->addRadio('type','类型',explode(',','text,images,news,voice,music,video'))
            ->setTrigger('type','1,news','link')
			->setValidate(
				[
			        'title|标题'  => 'require',
			        'content|内容'  => 'require', 
			    ]
				)
			->fetch();
	}
	/**
	 * [members 微信用户]
	 * @Author   Jerry
	 * @DateTime 2018-09-07T12:12:25+0800
	 * @Example  eg:
	 * @return   [type]                   [description]
	 */
	public function members(){



	}
	/**
	 * [membersgroup 用户分组]
	 * @Author   Jerry
	 * @DateTime 2018-09-07T12:13:00+0800
	 * @Example  eg:
	 * @return   [type]                   [description]
	 */
	public function membersgroup(){

	}

   
}