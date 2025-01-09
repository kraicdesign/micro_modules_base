<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Service\Utils;

class Path
{
    public static function resolve(string $filename)
    {
        return realpath($filename);
    }
}
