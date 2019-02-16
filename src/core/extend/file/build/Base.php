<?php 

##version

// CREATE TABLE `attachment` (
//   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
//   `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
//   `path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
//   `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图路径',
//   `mime` varchar(64) NOT NULL DEFAULT '' COMMENT '文件mime类型',
//   `ext` char(4) NOT NULL DEFAULT '' COMMENT '文件类型',
//   `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
//   `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
//   `sha1` char(40) NOT NULL DEFAULT '' COMMENT 'sha1 散列值',
//   `driver` varchar(16) NOT NULL DEFAULT 'local' COMMENT '上传驱动',
//   `download` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
//   `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
//   `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
//   `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
//   `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
//   PRIMARY KEY (`id`)
// ) ENGINE=MyISAM AUTO_INCREMENT=4144 DEFAULT CHARSET=utf8 COMMENT='附件表';
namespace bear\extend\file\build;
use bear\sys\config\Config;
use bear\extend\oss\Oss;
use bear\extend\db\Db;
class Base
{
    //上传类型
    protected $type = 'jpg,jpeg,gif,png,zip,rar,doc,txt,pem';
    //上传文件大小
    protected $size = 100000000;
    //上传路径
    protected $path = 'attachment';
    //错误信息
    protected $error;
    // 文件hash信息
    protected $hash = [];

    public function __construct()
    {

        if(is_array(Config::get('upload'))){
            foreach (Config::get('upload') as $k => $v) {
            $this->$k = $v;
          }   
        }
    }

    //设置属性
    public function __call($name, $arguments)
    {
        $this->$name = current($arguments);

        return $this;
    }



    /**
     * 上传
     *
     * @param null $fieldName 字段名
     *
     * @return array|bool
     * @throws Exception
     */
    public function upload($fieldName = null)
    {
        
        if ( ! $this->createDir()) {
            return false;
        }
        $files        = $this->format($fieldName);
        $uploadedFile = [];
        //验证文件
        if ( ! empty($files)) {
            foreach ($files as $v) {
                $v['md5']      = md5_file($v['tmp_name']);
                $v['sha1']     = sha1_file($v['tmp_name']);
               
                $info          = pathinfo($v ['name']);
                $v["ext"]      = isset($info ["extension"]) ? $info['extension'] : '';
                $v['filename'] = isset($info['filename']) ? $info['filename'] : '';
                $v['basename'] = $info['basename'];
                //新文件名
                $v['filename'] = $info['filename'];
                if ( ! $this->checkFile($v)) {
                    continue;
                }
                // show($v);
                if(Config::get('upload.filter')){
                    ##开启过滤功能，避免重复上传
                    if(!Db::table('attachment')->where("`md5` = '".$v['md5']."'")->count()){
                        $upFile = $this->save($v); 
                        Db::table('attachment')->where("`md5` = '".$v['md5']."'")->insert($upFile);  
                    }
                    $upFile =   Db::table('attachment')->where("`md5` = '".$v['md5']."'")->first();
                }else{
                     $upFile = $this->save($v); 
                }
                
                if ($upFile) {
                    $uploadedFile[] = $upFile;
                }
            }
        }

        return $uploadedFile;
    }

    /**
     * 储存文件
     *
     * @param string $file 储存的文件
     *
     * @return boolean
     */
    private function save($file)
    {
        if (Config::get('upload.mold') == 'oss') {
            //阿里oss
            $d = Oss::uploadFile($file['name'], $file['tmp_name']);
            if ( ! isset($d['info']) || ! isset($d['info']['url'])) {
                return false;
            }
            $filePath = $d['info']['url'];
        } else {
            $fileName = mt_rand(1, 9999).time().".".$file['ext'];
            $filePath = $this->path.'/'.$fileName;
            if ( ! move_uploaded_file($file ['tmp_name'], $filePath) && is_file($filePath)) {
                $this->error('移动临时文件失败');

                return false;
            }
        }
        $file['path']      = $filePath;
        $file['uptime']    = time();
        $file['fieldname'] = $file['fieldname'];
        $file['name']      = $file['filename']; //旧文件名
        $file['size']      = $file['size'];
        $file['ext']       = $file['ext'];
        $file['dir']       = $this->path;
        $file['image']     = preg_match('/\.(jpg|png|gif|bmp)/i',$filePath);
        $file['driver']    = Config::get('upload.mold');
        $file['create_time']    = time();
        $file['mime']       = $file['type'];
        // $file['update_time']    = Config::get('upload.mold');


        return $file;
    }

    //将上传文件整理为标准数组
    private function format($fieldName)
    {
        if ($fieldName == null) {
            $files = $_FILES;
        } else if (isset($_FILES[$fieldName])) {
            $files[$fieldName] = $_FILES[$fieldName];
        }

        if ( ! isset($files)) {
            $this->error = '没有任何文件上传';

            return false;
        }
        $info = [];
        $n    = 0;
        foreach ($files as $name => $v) {
            if (is_array($v ['name'])) {
                $count = count($v ['name']);
                for ($i = 0; $i < $count; $i++) {
                    foreach ($v as $m => $k) {
                        $info [$n] [$m] = $k [$i];
                    }
                    $info [$n] ['fieldname'] = $name; //字段名
                    $n++;
                }
            } else {
                $info [$n]               = $v;
                $info [$n] ['fieldname'] = $name; //字段名
                $n++;
            }
        }

        return $info;
    }

    //创建目录
    private function createDir()
    {
        if ( ! is_dir($this->path) && ! mkdir($this->path, 0755, true)) {
            throw new Exception("上传目录创建失败");
        }

        return true;
    }

    private function checkFile($file)
    {
        if ($file ['error'] != 0) {
            $this->error($file ['error']);

            return false;
        }
        if ( ! is_array($this->type)) {
            $this->type = explode(',', $this->type);
        }
        if ( ! in_array(strtolower($file['ext']), $this->type)) {
            $this->error = '文件类型不允许';

            return false;
        }
        if (strstr(strtolower($file['type']), "image") && ! getimagesize($file['tmp_name'])) {
            $this->error = '上传内容不是一个合法图片';

            return false;
        }
        if ($file ['size'] > $this->size) {
            $this->error = '上传文件大于'.$this->size;

            return false;
        }

        if ( ! is_uploaded_file($file ['tmp_name'])) {
            $this->error = '非法文件';

            return false;
        }

        return true;
    }

    private function error($error)
    {
        switch ($error) {
            case UPLOAD_ERR_INI_SIZE :
                $this->error = '上传文件超过PHP.INI配置文件允许的大小';
                break;
            case UPLOAD_ERR_FORM_SIZE :
                $this->error = '文件超过表单限制大小';
                break;
            case UPLOAD_ERR_PARTIAL :
                $this->error = '文件只上有部分上传';
                break;
            case UPLOAD_ERR_NO_FILE :
                $this->error = '没有上传文件';
                break;
            case UPLOAD_ERR_NO_TMP_DIR :
                $this->error = '没有上传临时文件夹';
                break;
            case UPLOAD_ERR_CANT_WRITE :
                $this->error = '写入临时文件夹出错';
                break;
            default:
                $this->error = '未知错误';
        }
    }

    /**
     * 返回上传时发生的错误原因
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 下载文件
     *
     * @param        $filepath 文件地址
     * @param string $name     下载后的新文件名
     */
    public function download($filepath, $name = '')
    {
        if (is_file($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.($name ?: basename($filepath)));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: '.filesize($filepath));
            readfile($filepath);
        }
    }
    
}