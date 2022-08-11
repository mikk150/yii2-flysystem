<?php

namespace creocoder\flysystem;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use yii\helpers\ArrayHelper;

class AwsS3Filesystem extends Filesystem
{
    public $s3ClientOptions;

    public $key;

    public $secret;

    public $credentials;

    public $region;

    public $bucket;

    /**
     * @var string
     */
    public $version;

    public $prefix = '';

    protected function prepareAdapter()
    {
        $options = ArrayHelper::merge($this->s3ClientOptions, [
            'region' => $this->region,
            'version' => ($this->version !== null ? $this->version : 'latest') 
        ]);

        if ($this->credentials !== null) {
            $options['credentials'] = $this->credentials;
        } else {
            $options['credentials'] = [
                'key' => $this->key,
                'secret' => $this->secret
            ];
        }
        $client = new S3Client($options);

        return new AwsS3V3Adapter($client, $this->bucket, $this->prefix);
    }
}
