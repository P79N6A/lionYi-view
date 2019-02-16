<?php
##version
##基本类
namespace bear\make;
use bear\sys\config\Config;
use bear\sys\Sys;
// use bear\Mark;
// use bear\smarty;
class Base 
{
	protected $_document = [
		'title'=>'',
		'action'=>'',
		'method'=>'post',
		'_thead'=>[],
		'_column'=>[],

	];
	// protected $_document[];
	/**
	 * [setTitle 设置标题]
	 * @Author   Jerry
	 * @DateTime 2018-08-13T17:26:00+0800
	 * @Example  eg:
	 */
	// public function setTitle($title=''){
	// 	$this->_document['title'] = $title;
	// 	return $this;
	// }
	/**
	 * [setInfo addAlert]
	 * @Author   Jerry+
	 * @DateTime 2018-08-13T17:35:05+0800
	 * @Example  eg:
	 * @param    [type]                   $info [description]
	 * @param    [type]                   $kind [description]
	 */
	public function addAlert($field='',$info='',$kind='success',$param=[]){
		$param = $this->_setParam($field,$info,$param);##参数设置
		$alert['field'] = $field;
		$alert['title'] = $info;
		$alert['kind'] = $kind;
		$alert['param'] = $param['param'];
		$this->_document['_alert'] = $alert;
		return $this;
	}
	
  

	/**
	 * [_setParam 设置参数]
	 * @Author   Jerry
	 * @DateTime 2018-08-14T15:38:09+0800
	 * @Example  eg:
	 * @param    [type]                   $field  [description]
	 * @param    [type]                   $param [description]
	 */
	protected function _setParam($field,$title,$param){
        $formatParam = [];
        switch ($this->type){
            case 'form';
                $param['class']             = isset($param['class'])?$param['class']:' bear-form-'.$field;
                $param['id']                = isset($param['id'])?$param['id']:' bear-form-'.$field;

                $param['class']             .= ' bear-make-'.$field;
                $param['id']                = isset($param['id'])?$param['id']:'bear-make-'.$field;
                $param['name']              = isset($field)?$field:'';
                $param['placeholder']       = isset($param['placeholder'])?$param['placeholder']:'';##框架默认值
                $param['verify']            = isset($param['verify'])?$param['verify']:'';##验证规则
                // $param['autocomplete']      = isset($param['autocomplete'])?$param['autocomplete']:'';
                $param['alt']               = isset($param['alt'])?$param['alt']:'';
                // $param['readOnly']          = isset($param['readOnly'])?$param['readOnly']:false;
                $param['tips']              = isset($param['tips'])?$param['tips']:''; ##INPUT下方的提示
                $param['options']           = isset($param['options'])?$param['options']:'';##参数，如：SELECT 的OPTIONS
                // $param['disabled']          = isset($param['disabled'])?$param['disabled']:'';
                // $param['datetype']          = isset($param['datetype'])?$param['datetype']:'';##时间选择器
                // $param['format']            = isset($param['format'])?$param['format']:'';##时间格式
                // $param['range']             = isset($param['range'])?$param['range']:'';
                // $param['min']               = isset($param['min'])?$param['min']:'';
                // $param['max']               = isset($param['max'])?$param['max']:'';
                // if($)
                // show($param);
                ## 组合attribute
                   $attribute = '';
                   foreach ($param as $atrName=>$atrValue) {
                       if($atrName=='class'||$atrName=='id') continue;
                       $attribute.= " {$atrName}='{$atrValue}'";
                   }
                   // show($attribute);
                   // show($param);
                $formatParam['param']         = $param;
                $formatParam['attribute']     = $attribute;
                break;
            case 'table':
                $param['class']             = isset($param['class'])?$param['class']:' bear-table-'.$field;
                $param['id']                = isset($param['id'])?$param['id']:' bear-table-'.$field;
                ##URL生成（每个路由规则都不一样在，这只是个概念）
                switch ($field) {
                    case 'add':
                        $param['icon']  = isset($param['icon'])?$param['icon']:'glyphicon glyphicon-plus';
                        break;
                    case 'edit':
                         $param['icon'] = isset($param['icon'])?$param['icon']:'glyphicon glyphicon-edit';
                         $param['href']  =isset($param['href'])?$param['href']:$field.'?id={id}';
                        break;
                    case 'del':
                         $param['icon'] = isset($param['icon'])?$param['icon']:'glyphicon glyphicon-remove';
                        break;
                     case 'back':
                         $param['icon'] = isset($param['icon'])?$param['icon']:'glyphicon glyphicon-chevron-left';
                         $param['href'] = isset($param['href'])?$param['href']:"JavaScript:history.go(-1)";
                        break;
                    case 'down':
                         $param['icon'] = isset($param['icon'])?$param['icon']:'glyphicon glyphicon-download-alt';
                        break;
                }
                $param['href']  =isset($param['href'])?$param['href']:$field;
                $formatParam = $param;
                break;
        }

		return $formatParam;
	}

   

   	/**
   	 * [fetch 分配模板]
   	 * @Author   Jerry
   	 * @DateTime 2018-08-13T15:17:58+0800
   	 * @Example  eg:
   	 * @return   [type]                   [description]
   	 */
    public function fetch($template = '', $vars = [], $replace = [], $config = []){
    	$this->__otherSetting();
    	$this->__compile();
    	// require_once __DIR__.'/smarty/libs/Smarty.class.php';
      // $smarty = new \Smarty;
      require_once(__DIR__.'/smarty/libs/SmartyBC.class.php');
      $smarty = new \SmartyBC();
  		$smarty->setCompileDir(Config::get('bear.bear_dir').Config::get('bear.smarty_compile_dir'))->setCacheDir(Config::get('bear.bear_dir').Config::get('bear.smarty_cache_dir'));

  		$smarty->force_compile = true;
  		// $smarty->debugging = true;
  		$smarty->caching = true;
  		$smarty->cache_lifetime = 120;
      $smarty->left_delimiter = '{{<';
      $smarty->right_delimiter = '>}}';
      $smarty->assign('pages',isset($_GET['pages'])?(int)$_GET['pages']:1);
      if(getInput('searchvalue')){
        ##TABLE搜索处理
        $smarty->assign('searchvalue',getInput('searchvalue'));
      }
  		$smarty->assign($vars);
  		$template = $template?str_replace(".tpl", "", $template):$this->type;
  		$template = Config::get('bear.smarty_template_dir').$template.'.tpl';
  		if(!$smarty->templateExists($template)) throw new \Exception($template.'模板不存在', 2003);
  		$smarty->assign($this->_document);
  		return   $smarty->fetch($template);

    }

    /**
	 * [__compile 编译处理数据]
	 * @Author   Jerry
	 * @DateTime 2018-08-14T16:36:59+0800
	 * @Example  eg:
	 * @return   [type]                   [description]
	 */
	protected function  __compile(){
        switch ($this->type){
            case 'form';
            $editor = ['ueditor']; ##所有编辑器类型 
            if(isset($this->_document['_input'])){
                $_input = $this->_document['_input'];
                   if(is_array($_input)){
                    foreach ($_input as $k => &$v) {
                        ##表单所有种类
                        $_form_types[$v['type']] = $v['type'];
                        

                        $v['param']['class'] = isset($v['param']['class'])?$v['param']['class']:'';
                        $v['param']['class'] .=' bear-form-'.$v['type'];
                        ##触发器
                        // show($this->_document['_trigger']);
                        if(isset($this->_document['_trigger'])){
                            $_trigger = $this->_document['_trigger'];
                            foreach ($_trigger as $ktrigger => $vtrigger) {
                                   $triggerValue = $vtrigger['value'];
                                    $triggerShow  = $vtrigger['show'];
                                    $triggerField = $vtrigger['field'];
                                     if($v['field']==$triggerField){
                                        $v['param']['data-trigger']          =  $triggerValue;
                                        $v['param']['data-trigger-even']     =  $v['type'];
                                        switch ($v['type']){
                                            case 'text':
                                            case 'textarea':
                                            case 'password':
                                               $v['param']['class']            .= ' bear-trigger-blur';
                                                break;
                                            case 'radio':
                                            case 'checkbox':
                                            case 'switch' :
                                                $v['param']['class']            .= ' bear-trigger-click';
                                                break;

                                            case 'select':
                                            case 'selectgroup':
                                            case 'selectsearch' :
                                            case 'date':
                                            case 'img':
                                                  $v['param']['class']            .= ' bear-trigger-change';
                                                 break;
                                        }
                                    }
                                    if(in_array($v['field'],$triggerShow)){
                                        $v['triggerShow'] = ' bear-trigger-show bear-'.$triggerField.'-trigger-show';
                                        $v['triggerHide'] = ' bear-hide';##隐藏当前表单行
                                     }
                                }
                                
                            }
                                $formatParam    = $this->_setParam($v['field'],$v['title'],$v['param']);
                                $v['param']     = $formatParam['param'];
                                $v['attribute'] = $formatParam['attribute'];
                                if(is_array($v['options'])){
                                    foreach ($v['options'] as $ki => &$vi) {
                                        if(is_array($vi)){
                                            ##给OPTIONS每个参数设置懂性
                                            $vi['value']     = isset($vi['value'])?$vi['value']:'';
                                            $formatParam     = $this->_setParam($field.$ki,$ki,$vi);
                                            $vi['param']     = $formatParam['param'];
                                            $vi['attribute'] = $formatParam['attribute'];
                                        }
                                    }
                                }

                                ##值处理
                                if($v['type']=='img'){
                                    $v['default'] = getFilePath($v['default']);
                                }

                        }


                    }
                    $this->_document['_form'] = $_input;
                    $this->_document['_form_types'] = $_form_types;
                   }


                break;
            case 'table':
            	$_column 	   = $this->_document['_column'];
            	$_src 		   = isset($this->_document['_src'])?$this->_document['_src']:[];
            	$_thead		   = $this->_document['_thead'];
            	$urlParam    = $this->urlParam;
              $_rightBtn   = isset($this->_document['_rightBtn'])?$this->_document['_rightBtn']:[];
              $pk          = $this->_document['pk'];
            	##前排选择框 Begin
            	$this->_document['checkbox'] =isset($this->_document['checkbox'])?$this->_document['checkbox']:true;
            	##前排选择框 End
                #
            	##算表格一共几列 Start
                 
                 if(isset($this->_document['checkbox'])){
                    $checkboxThead = $this->_document['checkbox']?1:0;
                 }else{
                    $checkboxThead = 0;
                 }
                 $this->_document['_countThead'] = count($this->_document['_thead'])+$checkboxThead+(isset($this->_document['_rightBtn'])?1:0);
                 ##算表格一共几列 End
                 #
            	##排序处理  Begin
            	$orderfield = isset($_GET['orderfield'])?$_GET['orderfield']:'';
            	$ordervalue = isset($_GET['ordervalue'])?$_GET['ordervalue']:'';
            	$sorttype = '';
            	##排序处理  End
            	##分页处理  Begin
            	$this->_document['pageUrl'] = $this->forMatUrl($urlParam,['page']);
            	##分页处理  End
            	##表头设置
            	
            	foreach ($_thead as $k => &$v) {
                  $v['title'] = $v['title']?$v['title']:$v['field'];
            		##排序
            		if(isset($v['sort'])){
            			if($orderfield==$v['field']){
            				$sorttype = $ordervalue=='asc'?'desc':'asc';
            			}else{
            				$sorttype = 'asc';
            			}
            			$urlParam['orderfield'] = $v['field'];
            			$urlParam['ordervalue'] = $sorttype;
            			$href = http_build_query($urlParam);
            			$v['title'] = $v['title']."<div class='bear-sort'><a href='?".$href."' class='fa fa-sort-alpha-".$sorttype."'></a></div>";
            			unset($v['sort']);
            			
            		}
            		if(isset($v['edit'])){
            			unset($v['edit']);
            			// $v['templet'] = '#bear-edit-btn';
            			$v['even'] = 'edit';
            		}
            		
            	}
            	// show($_thead);
            	$this->_document['_thead']	= $_thead;
            	
            	#表数据
            	$data = [];
            	if(is_array($_column)&&is_array($_src)){
            		foreach ($_column as $k => $v) {
            			foreach ($_src as $ksrc => $vsrc) {
                    ##编辑区 callback回调等相关处理
                    switch ($v['type']) {
                        case 'text':
                            $data[$ksrc][$v['field']] = isset($vsrc[$v['field']])?"<a href='javascript:;' bear-edit-type='".$edittype."' lay-event='edit' class='bear-edit-btn'>".$vsrc[$v['field']]."</a>":'';
                            $data[$ksrc]['even'] = 'edit';
                          break;
                         case 'callback':
                          // if($v['callback']) {
                            // $callback = new $v['callback'];
                            // show($callback);
                          // }
                         show($v['callback']);
                         // show($v['callback']->this);
                         show(gettype($v['callback']));
                         // show($v['callback']->this['rote']);
                         // die;
                            // return $v['callback'];
                             $data[$ksrc][$v['field']] = $v['callback'];
                             // call_user_func_array($v['callback'],'test');
                          break;
                        default:
                          $data[$ksrc][$v['field']] = isset($vsrc[$v['field']])?$vsrc[$v['field']]:'';
                          break;
                      }


                      ##右侧按钮
                      if($_rightBtn){
                          $pkValue = isset($vsrc[$pk])?$vsrc[$pk]:'';
                          foreach ($_rightBtn as $vbtn) {
                              //HREF and url 处理
                              $vbtn['param']['href'] = $this->_replaceUrl($vbtn['param']['href'],$vsrc);
                              if(isset($vbtn['param']['url'])){
                                  $vbtn['param']['url'] =  $this->_replaceUrl($vbtn['param']['url'],$vsrc);
                              }


                              //HREF and url 处理
                              ##confirm 处理
                             if(isset($vbtn['param']['confirm'])){
                                $vbtn['param']['class'] .= ' bear-confirm';
                                $vbtn['param']['url']    = isset($vbtn['param']['href'])?$vbtn['param']['href']:'';
                                $vbtn['param']['href']   = 'javascript:;';
                             }
                             
                             $vbtn['param'] = $this->_setParam($vbtn['tag'],$vbtn['title'],$vbtn['param']);
                             $data[$ksrc]['rightBtn'][$vbtn['tag']] = $vbtn; 
                          }
                       }
            				
            			}

            		}
                    $this->_document['_data']       = $data;
            	}

                break;

        }

		// return $param;
	} 
    private function _replaceUrl($url,$data){
        preg_match_all('/(?<=\{)([^\}]*?)(?=\})/' , $url , $match);
        if(is_array($match[0])){
            foreach ($match[0] as $khref => $vhref) {
                $varValue = isset($data[$vhref])?$data[$vhref]:'';##变量值
                $url= str_replace('{'.$vhref.'}',$varValue,$url);
            }

        }
        return $url;
    }
    /**
     * [otherSetting 其它设置]
     * @Author   Jerry
     * @DateTime 2018-08-21T10:35:53+0800
     * @Example  eg:
     * @return   [type]                   [description]
     */
    private function __otherSetting(){
    	##URL参数处理
    	$this->urlParam                      =$_GET;
      $this->_document['static_host']      = 'http://bear.jerryblog.cn/bear/';##静态文件地址
    	$this->_document['type']             = $this->type;##当前MAKE类型
    	$this->_document['token']            = isset($this->_document['token'])?$this->_document['token']: Sys::token();##当前TOKEN
      $this->_document['pk']               = isset($this->_document['pk'])?$this->_document['pk']: 'id';##默认主键
      // show($_SERVER);
      $this->_document['_header']['url']   = isset($_SERVER['REDIRECT_URL'])?$_SERVER['REDIRECT_URL']:'';##当前URL地址
      $_headerParam = '';
      ##这拼接的参数，避免拼很长/superadmin/item/dataMsg?itemid=7&searchfield=dec&searchvalue=MYSQL&searchfield=dec|file&searchvalue=MYSQL
      $cancelParam = ['searchfield','searchvalue'];
      if(getInput()){
          foreach (getInput() as $k => $v) {
              if(in_array($k, $cancelParam)){
                continue;
              }
              $_headerParam .=$k.'='.$v.'&';
          }
      }
      $this->_document['_header']['param'] = $_headerParam;##当前URL地址
      if(getInput('hideTop')){
        $this->_document['hideTop'] = true;
      }else{
        $this->_document['hideTop'] = false;
      }
     switch ($this->type){
            case 'form';
                 $this->_document['goUrl'] = isset($this->_document['goUrl'])?$this->_document['goUrl']: 'JavaScript:history.go(-1)';##提交成功后回调的URL
    			       $this->_document['validate'] = isset($this->_document['validate'])?$this->_document['validate']: '';##提交成功后回调的URL
                break;
            case 'table':
       			    
                 
                break;

        }
    	
    }
    /**
     * [forMatUrl 拼接URL参数]
     * @Author   Jerry
     * @DateTime 2018-08-23T14:12:16+0800
     * @Example  eg:
     * @param    [type]                   $arr   [description]
     * @param    [type]                   $unsets [description]
     * @return   [type]                          [description]
     */
    private function  forMatUrl($arr,$unsets=[]){
    	$url = '?';
    	if(!$arr) return ;
    	foreach ($arr as $k => $v) {
    		if(!in_array($k, $unsets)){
    			$url.=$k.'='.$v.'&';
    		}
    	}
    	return Rtrim($url,'&');
    }
   
   
}
