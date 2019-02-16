<?php

namespace bear\extend\oss\Result;


/**
 * Class BodyResult
 * @package bear\extend\oss\Result
 */
class BodyResult extends Result
{
    /**
     * @return string
     */
    protected function parseDataFromResponse()
    {
        return empty($this->rawResponse->body) ? "" : $this->rawResponse->body;
    }
}