<?php
declare(strict_types=1);

namespace Raledge\Modules\Question;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Raledge\Modules\Question\InMemory\QuestionRepository;
use Raledge\Modules\Question\InMemory\RepliesRepository;
use Raledge\Modules\Question\Services\UpdateQuestionService;
use Raledge\Modules\Question\Services\DeleteQuestionService;
use Raledge\Modules\Question\Services\AskQuestionService;
use Raledge\Modules\Question\Services\ReplyQuestionService;

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
            'Raledge\Modules\Question\Controllers' => __DIR__ . '/presentation/controllers/',
            'Raledge\Modules\Question\Models' => __DIR__ . '/application/domain/models/',
            'Raledge\Modules\Question\Forms' => __DIR__ . '/application/domain/forms/',
            'Raledge\Modules\Question\Repository' => __DIR__ . '/application/domain/repository/',
            'Raledge\Modules\Question\Services' => __DIR__ . '/application/services/',
            'Raledge\Modules\Question\InMemory' => __DIR__ . '/infrastructure/persistence/',
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

        $di->setShared('askQuestionService' ,function(){
            return new AskQuestionService(new QuestionRepository());
        });

        
        $di->setShared('updateQuestionService' ,function(){
            return new UpdateQuestionService(new QuestionRepository());
        });

        
        $di->setShared('deleteQuestionService' ,function(){
            return new DeleteQuestionService(new QuestionRepository());
        });

        
        $di->setShared('replyQuestionService' ,function(){
            return new ReplyQuestionService(new RepliesRepository());
        });

    }
}
