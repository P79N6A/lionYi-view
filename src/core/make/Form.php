<?php
##version
##表单
namespace bear\make;
// use \bear\
use bear\sys\crypt\Crypt;
// use bear\sys\session\Session;
use bear\sys\Sys;
class Form extends Base
{
   
   protected $type = 'form';
    /**
	 * [button 添加按钮]
	 * @Author   Jerry
	 * @DateTime 2018-08-13T17:32:12+0800
	 * @Example  eg:
	 * @return   [type]                   [description]
	 */
	public function addButton($field,$title,$param){
		$param = $this->_setParam($field,$title,$param);##参数设置
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
    	$param = $this->_setParam($tag,$title,$param);
    	$param['param']['attribute'] = $param['attribute'];
        $this->_document['_topBtn'][] =[
            'title' =>$title,
            'tag'   =>$tag,
            'param' =>$param['param']
        ]; 
        return $this;
    }
	/**
	 * [addSelectGroup description]
	 * @Author   Jerry
	 * @DateTime 2018-08-15T14:22:38+0800
	 * @Example  eg:
	 */
	// public function selectGroup($field,$title,$options,$default='',$param=[]){
		// $value['field'] = $field;
		// $value['title'] = $title;
		// $value['default'] = $default;
		// $value['param'] = $param;
		// $value['name'] = 'selectgroup';
		// foreach ($options as $k => &$v) {
		// 		foreach ($v as $ki => &$vi) {
		// 			if(is_array($vi)){
		// 				$vi['value'] = isset($vi['value'])?$vi['value']:'';
		// 			}
		// 		}
		// }
		// $value['options'] = $options;
		// $this->_document['_input'][] = $value;
		// return $this;
	// }
	/**
	 * [addHidden 隐藏域]
	 * @Author   Jerry
	 * @DateTime 2018-08-30T09:50:58+0800
	 * @Example  eg:
	 * @param    [type]                   $field   [description]
	 * @param    [type]                   $default [description]
	 */
	public function addHidden($field,$default,$param=[]){
		$this->_addFormValue('hidden',$field,'hidden','',$default,[]);
		return $this;
	}
	/**
	 * [addHr Hr 分隔线]
	 * @Author   Jerry
	 * @DateTime 2018-08-30T14:30:55+0800
	 * @Example  eg:
	 */
	public function addHr(){
		$this->_addFormValue('hr','hr','hr','','',[]);
		return $this;
	}
	/**
	 * [addStatic 静态文本]
	 * @Author   Jerry
	 * @DateTime 2018-08-30T14:34:54+0800
	 * @Example  eg:
	 */
	public function addStatic($value){
		$this->_addFormValue('static',$value,'static','','',[]);
		return $this;
	}
	/**
	 * [addForms 添加多个]
	 * @Author   Jerry
	 * @DateTime 2018-08-20T15:24:03+0800
	 * @Example  eg:
	 * @param    [type]                   $forms [description]
	 */
	public function Forms($forms){
		if(!is_array($forms)) throw new \Exception("多表单必须为数组", -1);
		foreach ($forms as $k => $v) {
			$v['type'] 		= isset($v['type'])?$v['type']:'text';
			$v['field'] 	= isset($v['field'])?$v['field']:'';
			$v['title'] 	= isset($v['title'])?$v['title']:'';
			$v['default']	= isset($v['default'])?$v['default']:'';
			$v['param']		= isset($v['param'])?$v['param']:[];
			$method = 'add'.ucfirst($v['type']);
			$this->$method($v['field'],$v['title'],$v['default'],$v['param']);
		}
		// show($this);
		return $this;
	}
	// protected $rule =   [
 //        'name'  => 'require|max:25',
 //        'age'   => 'number|between:1,120',
 //        'email' => 'email',    
 //    ];
    
 //    protected $message  =   [
 //        'name.require' => '名称必须',
 //        'name.max'     => '名称最多不能超过25个字符',
 //        'age.number'   => '年龄必须是数字',
 //        'age.between'  => '年龄只能在1-120之间',
 //        'email'        => '邮箱格式错误',    
 //    ];
	/**
	 * [setValidate description]
	 * @Author   Jerry
	 * @DateTime 2018-08-21T14:35:30+0800
	 * @Example  eg:
	 */
	public function setValidate($rule=[],$msg=[]){
		$token = Sys::token();
		$validate = [
			'rule'=>$rule,
			'msg'=>$msg

		];

		$this->_document['validate'] = Crypt::encrypt(serialize($validate),$token);
		$this->_document['token'] = $token;
		return $this;
	}

    /**
     * [setTrigger description]
     * @Author   Jerry
     * @DateTime 2018/8/25-23:02
     * @param $field            触发的字段
     * @param string $value     值为什么时候触发
     * @param string $show       显示哪条
     * @Example  eg:
     * @return   [type]                   [description]
     */
	public function setTrigger($field,$value='',$show=''){
        $this->_document['_trigger'][] = [
            'field'     =>$field,
            'value'     =>$value,
            'show'      =>explode(",",$show),

        ];
        return $this;
    }
	/**
	 * [_setValue 设置值]
	 * @Author   Jerry
	 * @DateTime 2018-08-14T15:51:47+0800
	 * @Example  eg:
	 * @param    [type]                   $name    [description]
	 * @param    [type]                   $field   [description]
	 * @param    [type]                   $title   [description]
	 * @param    [type]                   $default [description]
	 * @param    [type]                   $param   [description]
	 */
	protected function _addFormValue($type,$field,$title,$options=[],$default='',$param=[]){
		if(!$type||!$field||!$title) throw new \Exception("标题:{$title},字段:{$field},类型:{$type}", -1);
		$this->_document['_input'] = isset($this->_document['_input'])?$this->_document['_input']:[];
		$this->_document['_input'][] = [
			'field'		=>	$field,
			'title'		=>	$title,
			'default'	=>	$default,
			'param'	=>	$param,
			'type'		=>	$type,
			'options'	=>	$options,
		];
		
		
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
		}elseif(count($param)>1){
			$type = strtolower(str_replace('add', '', $name));
			$field		= isset($param[0])?$param[0]:'';
			$title 		= isset($param[1])?trim($param[1],':').':':'';
			if(isset($param[2])&&is_array($param[2])){
				##当$param[2]值为数组,参数为OPTIONS时，
				$default = isset($param[3])?$param[3]:'';
				$options = $param[2];
				$param 	= isset($param[4])?$param[4]:[];
			}else{
				$default = isset($param[2])?$param[2]:'';
				$options = [];
				$param 	= isset($param[3])?$param[3]:[];
			}
			// show($default);
			$this->_addFormValue($type,$field,$title,$options,$default,$param);

		}
		return $this;
	}



	
   
}
