<?php
declare(strict_types=1);

namespace Raledge\Modules\Timeline;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Raledge\Modules\Timeline\Services\DiscoverUserService;
use Raledge\Modules\Timeline\Services\GetRelateQuestionService;
use Raledge\Modules\Timeline\Services\GetRepliesQuestionService;
use Raledge\Modules\Timeline\InMemory\ExploreRepository;

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
            'Raledge\Modules\Timeline\Controllers' => __DIR__ . '/presentation/controllers/',
            'Raledge\Modules\Timeline\Models' => __DIR__ . '/application/domain/models/',
            'Raledge\Modules\Timeline\Forms' => __DIR__ . '/application/domain/forms/',
            'Raledge\Modules\Timeline\Repository' => __DIR__ . '/application/domain/repository/',
            'Raledge\Modules\Timeline\Services' => __DIR__ . '/application/services/',
            'Raledge\Modules\Timeline\InMemory' => __DIR__ . '/infrastructure/persistence/',

            'Raledge\Modules\Question\Forms' => __DIR__ . '/../question/application/domain/forms/',
            'Raledge\Modules\Question\Models' => __DIR__ . '/../question/application/domain/models/',

            'Raledge\Modules\Auth\Models' => __DIR__ . '/../auth/application/domain/models/',

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

        $di->setShared('discoverUserService', function(){
            return new DiscoverUserService(new ExploreRepository);
        });

        $di->setShared('getRelateQuestionService', function(){
            return new GetRelateQuestionService(new ExploreRepository);
        });

        $di->setShared('getRepliesQuestionService', function(){
            return new GetRepliesQuestionService(new ExploreRepository);
        });

    }
}
