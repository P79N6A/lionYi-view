<?php



if ( ! function_exists('show')) {
    /**
     * [show 获取请求头信息]
     * @Author   Jerry
     * @DateTime 2018-08-20T09:28:32+0800
     * @Example  eg:
     * @param    [type]                   $var [description]
     * @return   [type]                        [description]
     */
    function show($var){
        if (is_bool($var)) {
                var_dump($var);
            } else if (is_null($var)) {
                var_dump(NULL);
            } else {
                echo "<pre style='padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;'>" . print_r($var, true) . "</pre>";
            }
    }
}

if ( ! function_exists('returnJson')) {
    /**
     * [returnJson description]
     * @Author   Jerry
     * @DateTime 2018-08-20T09:28:28+0800
     * @Example  eg:
     * @param    integer                  $status [description]
     * @param    string                   $msg    [description]
     * @param    array                    $data   [description]
     * @return   [type]                           [description]
     */
    function returnJson($status=0,$msg=null,$data=[]){
        return \bear\Bear::returnJson($status,$msg,$data);
    }
}

if ( ! function_exists('getset')) {
    /**
     * [getset description]
     * @Author   Jerry
     * @DateTime 2018-08-20T09:28:35+0800
     * @Example  eg:
     * @param    [type]                   $name [description]
     * @return   [type]                         [description]
     */
    function getset($name,$file='web'){
        return \bear\sys\config\Config::get("{$file}.{$name}");
        
    }
}

if ( ! function_exists('getInput')) {
    /**
     * [getInput 获得参数]
     * @Author   Jerry
     * @DateTime 2018-08-20T09:28:35+0800
     * @Example  eg:
     * @param    [type]                   $name [description]
     * @return   [type]                         [description]
     */
    function getInput($key = '', $default = null, $filter = ''){
         if (0 === strpos($key, '?')) {
            $key = substr($key, 1);
            $has = true;
        }
        if ($pos = strpos($key, '.')) {
            // 指定参数来源
            list($method, $key) = explode('.', $key, 2);
            if (!in_array($method, ['get', 'post', 'put', 'patch', 'delete', 'route', 'param', 'request', 'session', 'cookie', 'server', 'env', 'path', 'file'])) {
                $key    = $method . '.' . $key;
                $method = 'param';
            }
        } else {
            // 默认为自动判断
            $method = 'param';
        }
        $request = new \bear\sys\request\Request;
        return isset($has)?\bear\sys\request\Request::has($key, $method, $default):\bear\sys\request\Request::$method($key, $default, $filter);
    }
}

if ( ! function_exists('getSearch')) {
    /**
     * [getSearch 获得搜索条件]
     * @Author   Jerry
     * @DateTime 2018-08-20T09:28:35+0800
     * @Example  eg:
     * @param    [type]                   $name [description]
     * @return   [type]                         [description]
     */
    function getSearch($where=''){
         $where = $where?'('.$where.') AND ':'';
         $searchField = getInput('searchfield');
         $searchValue = getInput('searchvalue');
         if($searchField!=''&&$searchValue!=''){
            $fields = explode("|", $searchField);
            foreach ($fields as $k => $v) {
                if($k==(count($fields)-1)){
                    $where .= ('`'.$v.'` like "%'.$searchValue.'%"');
                }else{
                    $where .= ('`'.$v.'` = "%'.$searchValue.'%" OR ');
                }
            }
         }
         return $where;

    }
}

if ( ! function_exists('getFilePath')) {
    /**
     * [getSearch 获得文件地址]
     * @Author   Jerry
     * @DateTime 2018-08-20T09:28:35+0800
     * @Example  eg:
     * @param    [type]                   $name [description]
     * @return   [type]                         [description]
     */
    function getFilePath($file=''){
        if(is_numeric($file)){
            $re = \bear\extend\db\Db::table('attachment')->where("id = '{$file}'")->field('driver,path')->first();
            if($re['driver']=='oss'){
                $data['file'] =  \bear\sys\config\Config::get('oss.host').'/'.$re['path'];
            }else{
                $data['file'] =  '/'.$re['path'];
            }
                $data['input'] = $file;
        }else{
                $data['file'] =  '/'.$file;
                $data['input'] =  '/'.$file;
        }
        // show($data);
        return $data;
    }
}
