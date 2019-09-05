<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb49db23bb36cbca79e5e6329c583cd81
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pds\\Skeleton\\' => 13,
        ),
        'D' => 
        array (
            'DebToox\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pds\\Skeleton\\' => 
        array (
            0 => __DIR__ . '/..' . '/pds/skeleton/src',
        ),
        'DebToox\\' => 
        array (
            0 => __DIR__ . '/../..' . '/DebToox',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb49db23bb36cbca79e5e6329c583cd81::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb49db23bb36cbca79e5e6329c583cd81::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
