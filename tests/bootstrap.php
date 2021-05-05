<?php declare( strict_types = 1 );
namespace Medusa\Validation\Tests;

require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function(string $className): void {
    if (strpos($className, __NAMESPACE__) !== 0) {
        return;
    }
    $relative = str_replace(__NAMESPACE__ . '\\', '', $className);
    $path = __DIR__ . '/' . str_replace('\\', '/', $relative) . '.php';
    if (is_file($path)) {
        require_once $path;
    }
});
