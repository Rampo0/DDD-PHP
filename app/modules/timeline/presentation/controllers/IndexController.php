<?php
declare(strict_types=1);

namespace Raledge\Modules\Timeline\Controllers;

use Raledge\Domain\Models\AuthModel;
use Raledge\Modules\Question\Forms\QuestionForm;
use Raledge\Modules\Question\Models\Questions;
use Raledge\Modules\Auth\Models\Followers;
use Raledge\Modules\Auth\Models\Users;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $sessions = $this->getDI()->getShared("session");

        if (!$sessions->has("user_id")) {
            return $this->response->redirect("/auth");
        }

        $this->view->questionForm = new QuestionForm();

        $user_id = $this->getDI()->getShared("session")->get('user_id');

        try{
            $questions = $this->getRelateQuestionService->execute($user_id);
        }catch(\GetRelateQuestionsException $e){
            echo "Error retrieve questions";
        }

        $this->view->questions = $questions;

    }

    public function questionAction(){
        $user_id = $this->getDI()->getShared("session")->get('user_id');
        $this->view->myQuestion = Questions::find(
            [
                'conditions' => 'posted_by_id = :user_id:',
                'bind'       => [
                    'user_id' => $user_id,
                ],
                'order'      => 'id desc',
            ]
        );

        $this->view->questionForm = new QuestionForm();
    }

    public function answerAction(){

    }

    public function exploreAction(){
        try{
            $users = $this->discoverUserService->execute();
        }catch (\DiscoverUserException $e){
            print("discover error");
        }

        $this->view->discoveredUsers = $users;
        $this->view->questionForm = new QuestionForm();

    }

}

