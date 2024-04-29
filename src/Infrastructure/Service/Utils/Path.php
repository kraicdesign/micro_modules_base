<?php

declare(strict_types=1);

namespace MicroModule\Base\Infrastructure\Service\Utils;

class Path
{
    public static function resolve(string $filename)
    {
        return realpath($filename);
    }
}
