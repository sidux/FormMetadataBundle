<?php
/**
 * @codeCoverageIgnore
 */


$file = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
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
    //require_once __DIR__.'/fixtures/framework/autoload.php';
    require_once $file;
}


$annotation_namespace_path=__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.".." .DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;

\Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
    'Corleonis\FormMetadataBundle\Configuration',
    $annotation_namespace_path
);

