<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7b04a3912bdba4799feecc704fcd7e6b
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
        'Hyper\\System\\ConfigurationFile' => __DIR__ . '/../..' . '/src/system/configuration-file.php',
        'Hyper\\System\\ConfigurationManager' => __DIR__ . '/../..' . '/src/system/configuration-manager.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7b04a3912bdba4799feecc704fcd7e6b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7b04a3912bdba4799feecc704fcd7e6b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7b04a3912bdba4799feecc704fcd7e6b::$classMap;

        }, null, ClassLoader::class);
    }
}
