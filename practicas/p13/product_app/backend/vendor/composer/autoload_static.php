<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd0090c0b763f26d9b7ac0e9786f360c5
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MYAPI\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MYAPI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/backend/myapi',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd0090c0b763f26d9b7ac0e9786f360c5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd0090c0b763f26d9b7ac0e9786f360c5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd0090c0b763f26d9b7ac0e9786f360c5::$classMap;

        }, null, ClassLoader::class);
    }
}