<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf58a3d6e373a3a443e7ed9ac26ae473
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbf58a3d6e373a3a443e7ed9ac26ae473::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbf58a3d6e373a3a443e7ed9ac26ae473::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbf58a3d6e373a3a443e7ed9ac26ae473::$classMap;

        }, null, ClassLoader::class);
    }
}
