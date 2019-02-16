<?php

namespace bear\extend\oss\Result;

use bear\extend\oss\Core\OssException;

/**
 * Class UploadPartResult
 * @package bear\extend\oss\Result
 */
class UploadPartResult extends Result
{
    /**
     * 结果中part的ETag
     *
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->header;
        if (isset($header["etag"])) {
            return $header["etag"];
        }
        throw new OssException("cannot get ETag");

    }
}