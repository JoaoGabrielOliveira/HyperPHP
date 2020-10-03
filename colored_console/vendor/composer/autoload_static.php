<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitee247c70e3717936a6c20df8062fea07
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hyper\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hyper\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Hyper\\Console' => __DIR__ . '/../..' . '/src/console.php',
        'Hyper\\Console\\Color' => __DIR__ . '/../..' . '/src/color.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitee247c70e3717936a6c20df8062fea07::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitee247c70e3717936a6c20df8062fea07::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitee247c70e3717936a6c20df8062fea07::$classMap;

        }, null, ClassLoader::class);
    }
}