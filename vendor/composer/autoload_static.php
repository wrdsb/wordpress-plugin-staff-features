<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit72b8db49e3912194fea2197523d8b062
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WRDSB\\Staff\\' => 12,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WRDSB\\Staff\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit72b8db49e3912194fea2197523d8b062::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit72b8db49e3912194fea2197523d8b062::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit72b8db49e3912194fea2197523d8b062::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit72b8db49e3912194fea2197523d8b062::$classMap;

        }, null, ClassLoader::class);
    }
}