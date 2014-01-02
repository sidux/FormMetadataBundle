<?php
/**
 * @codeCoverageIgnore
 */


$file = __DIR__.'/../vendor/autoload.php';
if (!file_exists($file)) {
    spl_autoload_register(function($class)
        {
            $file = __DIR__.'/../../../'.strtr($class, '\\', '/').'.php';
            if (file_exists($file)) {
                require $file;
                return true;
            }
        });
} else {
    require_once __DIR__.'/fixtures/framework/autoload.php';
    require_once $file;
}
