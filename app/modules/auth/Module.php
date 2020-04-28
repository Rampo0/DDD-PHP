<?php
declare(strict_types=1);

namespace Raledge\Modules\Auth;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Raledge\Modules\Auth\Services\RegisterService;
use Raledge\Modules\Auth\Services\LoginService;
use Raledge\Modules\Auth\Services\FollowService;
use Raledge\Modules\Auth\InMemory\UserRepository;
use Raledge\Modules\Auth\InMemory\SocialRepository;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Raledge\Modules\Auth\Controllers' => __DIR__ . '/presentation/controllers/',
            'Raledge\Modules\Auth\Models' => __DIR__ . '/application/domain/models/',
            'Raledge\Modules\Auth\Forms' => __DIR__ . '/application/domain/forms/',
            'Raledge\Modules\Auth\Repository' => __DIR__ . '/application/domain/repository/',
            'Raledge\Modules\Auth\Services' => __DIR__ . '/application/services/',
            'Raledge\Modules\Auth\InMemory' => __DIR__ . '/infrastructure/persistence/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Setting up the view component
         */
        $di->set('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(__DIR__ . '/views/');

            $view->registerEngines([
                '.volt'  => 'voltShared',
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        });

        $di->setShared('registerService', function(){
            return new RegisterService(new UserRepository);
        });

        $di->setShared('loginService', function(){
            return new LoginService(new UserRepository);
        });

        $di->setShared('followService', function(){
            return new FollowService(new SocialRepository);
        });

    }
}
