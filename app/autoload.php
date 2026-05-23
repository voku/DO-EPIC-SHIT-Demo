<?php

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require ROOT . '/vendor/autoload.php';

if (!class_exists('RedBean_Facade') && class_exists(\RedBeanPHP\R::class)) {
  class_alias(\RedBeanPHP\R::class, 'RedBean_Facade');
}

if (!class_exists('RedBean_SimpleModel') && class_exists(\RedBeanPHP\SimpleModel::class)) {
  class_alias(\RedBeanPHP\SimpleModel::class, 'RedBean_SimpleModel');
}

if (!class_exists('Twig_Environment') && class_exists(\Twig\Environment::class)) {
  class_alias(\Twig\Environment::class, 'Twig_Environment');
}

if (!class_exists('Twig_Loader_Filesystem') && class_exists(\Twig\Loader\FilesystemLoader::class)) {
  class_alias(\Twig\Loader\FilesystemLoader::class, 'Twig_Loader_Filesystem');
}

if (!class_exists('Twig_Extension') && class_exists(\Twig\Extension\AbstractExtension::class)) {
  class_alias(\Twig\Extension\AbstractExtension::class, 'Twig_Extension');
}

if (!class_exists('Twig_SimpleFunction') && class_exists(\Twig\TwigFunction::class)) {
  class_alias(\Twig\TwigFunction::class, 'Twig_SimpleFunction');
}

if (!class_exists('Twig_Autoloader') && class_exists(\Twig\Environment::class)) {
  class Twig_Autoloader
  {
    public static function register()
    {
      return true;
    }
  }
}

/*
|--------------------------------------------------------------------------
| Register The RedSlim Auto Loader
|--------------------------------------------------------------------------
|
| We register an auto-loader "behind" the Composer loader that can load
| model classes on the fly.
|
*/

// Autoloader to load classes in /app/models/
spl_autoload_register(
  function ($class) {
    if (0 !== strpos($class, 'Model_')) {
      return;
    }

    if (is_file($file = ROOT . '/app/models/' . $class . '.php')) {
      require $file;
    }
  }
);
