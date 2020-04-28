<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    // 'Raledge\Models' => APP_PATH . '/common/models/',
    'Raledge'        => APP_PATH . '/common/library/',
    'Raledge\Domain\Models' => APP_PATH . '/common/domain/models',
    'Raledge\Domain\Repository' => APP_PATH . '/common/domain/repository',
    'Raledge\Domain\Services' => APP_PATH . '/common/domain/services',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Raledge\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Raledge\Modules\Timeline\Module' => APP_PATH . '/modules/timeline/Module.php',
    'Raledge\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php',
    'Raledge\Modules\Auth\Module'     => APP_PATH . '/modules/auth/Module.php',
    'Raledge\Modules\Question\Module'     => APP_PATH . '/modules/question/Module.php',
]);

$loader->register();
