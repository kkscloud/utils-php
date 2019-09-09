<?php

require_once "../vendor/autoload.php";
require_once "../src/small/Small.php";
require_once "../src/oss/Oss.php";
require_once "../src/oss/OssFactory.php";
require_once "../src/sms/SmsUtil.php";

use Fc\Utils\Oss\OssFactory;
use Fc\Utils\Small\Small;
use Fc\Utils\Sms\SmsUtil;

$configPath = dirname(__DIR__);

$s = (new OssFactory)->api($configPath)->upload('fc/a', 'a.png');
var_dump($s);

$s = (new SmsUtil($configPath))->send(13395058888, "hello fc test");
var_dump($s);

$a = Small::getRandomNum(6);
$b = Small::getRandomStr(18, 'upper');
$c = Small::getMsTime();
$d = Small::getUUID('upper');
echo 'getRandomNum():   ' . $a . PHP_EOL;
echo 'getRandomStr():   ' . $b . PHP_EOL;
echo 'getMsTime():      ' . $c . PHP_EOL;
echo 'getUUID():        ' . $d . PHP_EOL;