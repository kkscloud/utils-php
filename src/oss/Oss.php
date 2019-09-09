<?php

namespace Fc\Utils\Oss;

use Dotenv\Dotenv;
use OSS\Core\OssException;
use OSS\OssClient;

class Oss
{
    private static $accessKeyId = "";
    private static $accessKeySecret = "";
    private static $endpoint = "";

    public function __construct(string $paths)
    {
        $d = Dotenv::create($paths, '.env');
        $d->load();

        self::$accessKeyId = getenv('ALIYUN_ACCESS_KEY');
        self::$accessKeySecret = getenv('ALIYUN_ACCESS_SECRET');
        self::$endpoint = getenv('ALIYUN_OSS_ENDPOINT');
    }

    public function hello()
    {
        return 'hello oss util';
    }

    public function upload($object, $filePath, $bucket = 'default')
    {
        return self::uploadToOss($object, $filePath, $bucket);
    }

    public function getMd5FileName($filename)
    {
        $realName = '';
        $fileName = explode('.', $filename);
        if (count($fileName) > 1) {
            $fileType = $fileName[count($fileName) - 1];
            unset($fileName[count($fileName) - 1]);
            $s = '';
            foreach ($fileName as $k => $v) {
                $s .= $v;
            }
            $realName = md5($s . microtime()) . '.' . $fileType;
        }

        return $realName;
    }

    private static function uploadToOss($object, $filePath, $bucket = 'default')
    {
        $data = new \stdClass();

        try {
            $ossClient = new OssClient(self::$accessKeyId, self::$accessKeySecret, self::$endpoint);
            $result = $ossClient->uploadFile($bucket, $object, $filePath);

            $data->code = 0;
            $data->content = $result['info']['url'];
        } catch (OssException $e) {
            $data->code = -1;
            $data->content = $e->getMessage();
        }

        return $data;
    }
}