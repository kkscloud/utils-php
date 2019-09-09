<?php

namespace Fc\Utils\oss;


class OssFactory
{
    public function api(string $path = null): Oss
    {
        if ($path == null) {
            $path = dirname(__DIR__) . '/';
        }

        return new Oss(
            $path
        );
    }
}