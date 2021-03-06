<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2871bc1e5062380f1a09f440842ad67
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Curl\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Curl\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-curl-class/php-curl-class/src/Curl',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2871bc1e5062380f1a09f440842ad67::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2871bc1e5062380f1a09f440842ad67::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
