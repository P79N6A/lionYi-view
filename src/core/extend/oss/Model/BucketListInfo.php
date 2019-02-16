<?php

namespace bear\extend\oss\Model;

/**
 * Class BucketListInfo
 *
 * ListBuckets接口返回的数据类型
 *
 * @package bear\extend\oss\Model
 */
class BucketListInfo
{
    /**
     * BucketListInfo constructor.
     * @param array $bucketList
     */
    public function __construct(array $bucketList)
    {
        $this->bucketList = $bucketList;
    }

    /**
     * 得到BucketInfo列表
     *
     * @return BucketInfo[]
     */
    public function getBucketList()
    {
        return $this->bucketList;
    }

    /**
     * BucketInfo信息列表
     *
     * @var array
     */
    private $bucketList = array();
}