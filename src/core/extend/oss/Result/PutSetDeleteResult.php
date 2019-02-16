<?php

namespace bear\extend\oss\Result;


/**
 * Class PutSetDeleteResult
 * @package bear\extend\oss\Result
 */
class PutSetDeleteResult extends Result
{
    /**
     * @return array()
     */
    protected function parseDataFromResponse()
    {
        $body = array('body' => $this->rawResponse->body);
        return array_merge($this->rawResponse->header, $body);
    }
}
