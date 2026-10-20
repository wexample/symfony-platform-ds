<?php

namespace Wexample\SymfonyPlatformDs\Traits;

use Wexample\SymfonyHelpers\Traits\BundleClassTrait;
use Wexample\SymfonyPlatformDs\WexampleSymfonyPlatformDsBundle;

trait SymfonyPlatformDsBundleClassTrait
{
    use BundleClassTrait;

    public static function getBundleClassName(): string
    {
        return WexampleSymfonyPlatformDsBundle::class;
    }
}
