<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9f190a0e50fb0ffa57e69b5c0f129a03
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9f190a0e50fb0ffa57e69b5c0f129a03::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9f190a0e50fb0ffa57e69b5c0f129a03::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9f190a0e50fb0ffa57e69b5c0f129a03::$classMap;

        }, null, ClassLoader::class);
    }
}
