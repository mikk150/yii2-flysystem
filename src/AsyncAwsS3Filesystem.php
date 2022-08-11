<?php

namespace creocoder\flysystem;

use AsyncAws\S3\S3Client;
use League\Flysystem\AsyncAwsS3\AsyncAwsS3Adapter;
use yii\helpers\ArrayHelper;

class AsyncAwsS3Filesystem extends Filesystem
{
    public $s3ClientOptions;

    public $accessKeyId;

    public $accessKeySecret;

    public $region;

    public $bucket;

    public $prefix = '';

    protected function prepareAdapter()
    {
        $options = ArrayHelper::merge($this->s3ClientOptions, [
            'accessKeyId' => $this->accessKeyId,
            'accessKeySecret' => $this->accessKeySecret,
            'region' => $this->region,
        ]);

        $client = new S3Client($options);

        return new AsyncAwsS3Adapter($client, $this->bucket, $this->prefix);
    }
}
