<?php
namespace bear\extend\oss\Result;

use bear\extend\oss\Core\OssException;

/**
 * Class GetLocationResult getBucketLocation接口返回结果类，封装了
 * 返回的xml数据的解析
 *
 * @package bear\extend\oss\Result
 */
class GetLocationResult extends Result
{

    /**
     * Parse data from response
     * 
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        if (empty($content)) {
            throw new OssException("body is null");
        }
        $xml = simplexml_load_string($content);
        return $xml;
    }
}