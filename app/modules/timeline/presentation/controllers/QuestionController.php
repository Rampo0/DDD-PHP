<?php
declare(strict_types=1);

namespace Raledge\Modules\Timeline\Controllers;

use Raledge\Domain\Models\AuthModel;
use Raledge\Modules\Question\Forms\QuestionForm;
use Raledge\Modules\Question\Forms\ReplyForm;
use Raledge\Modules\Question\Models\Questions;
use Raledge\Modules\Auth\Models\Followers;
use Raledge\Modules\Auth\Models\Users;

class QuestionController extends ControllerBase
{

    public function indexAction(){}

    public function detailAction($question_id){

        $question = Questions::findFirst($question_id);
        
        $this->view->question = $question;
        $this->view->questionForm = new QuestionForm();
        $this->view->replyForm = new ReplyForm();

        try{
            $replies = $this->getRepliesQuestionService->execute($question_id);
        }catch (\GetRepliesQuestionException $e){
            echo "Failed get replies.";
        }

        $this->view->replies = $replies;
        
    }

    public function editAction($question_id){
        $question = Questions::findFirst($question_id);
        
        $this->view->question = $question;
        $this->view->questionForm = new QuestionForm();

    }


}

