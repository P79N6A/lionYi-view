<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace bear\extend\wx\build\material;

use bear\curl\Curl;
use bear\extend\wx\build\Base;

/**
 * 素材管理
 * Class Material
 *
 * @package bear\extend\wx\build
 */
class App extends Base
{
    use Media, Matter, News;

    /**
     * 获取素材总数
     *
     * @return array|mixed
     */
    public function total()
    {
        $url = $this->apiUrl
            ."/cgi-bin/material/get_materialcount?access_token={$this->accessToken}";

        return $this->get(Curl::get($url));
    }

    /**
     * 获取素材列表
     *
     * @param $param
     *
     * @return array|mixed
     */
    public function lists($param)
    {
        $url     = $this->apiUrl
            ."/cgi-bin/material/batchget_material?access_token="
            .$this->getAccessToken();
        $content = Curl::post($url,
            json_encode($param, JSON_UNESCAPED_UNICODE));

        return $this->get($content);
    }
}