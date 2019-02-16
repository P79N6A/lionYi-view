<?php

namespace bear\extend\oss\Result;

use bear\extend\oss\Core\OssException;
use bear\extend\oss\OssClient;

/**
 *
 * @package bear\extend\oss\Result
 */
class SymlinkResult extends Result
{
    /**
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET] = rawurldecode($this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET]);
        return $this->rawResponse->header;
    }
}

