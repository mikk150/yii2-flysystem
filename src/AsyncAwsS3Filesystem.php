<?php

namespace creocoder\flysystem;

use AsyncAws\S3\S3Client;
use League\Flysystem\AsyncAwsS3\AsyncAwsS3Adapter;

class AsyncAwsS3Filesystem extends Filesystem
{
    public $accessKeyId;

    public $accessKeySecret;

    public $region;

    public $bucket;

    public $prefix = '';

    protected function prepareAdapter()
    {
        $client = new S3Client([
            'accessKeyId' => $this->accessKeyId,
            'accessKeySecret' => $this->accessKeySecret,
            'region' => $this->region,
        ]);

        return new AsyncAwsS3Adapter($client, $this->bucket, $this->prefix);
    }
}
