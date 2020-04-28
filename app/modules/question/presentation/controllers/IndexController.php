<?php
declare(strict_types=1);

namespace Raledge\Modules\Question\Controllers;
use Phalcon\Http\Request;
use Raledge\Domain\Services\NotFoundService;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Raledge\Modules\Question\Forms\QuestionForm;
use Raledge\Modules\Question\Forms\ReplyForm;

class IndexController extends ControllerBase
{
    public function indexAction(){
    }

    public function createAction(){
        
        if (!$this->security->checkToken()) {
            return NotFoundService::NotFound404();
        }

        $question_form = new QuestionForm();
        if($question_form->isValid($this->request->getPost())){
            
            try{
                $this->askQuestionService->execute(
                    $this->request->getPost('question'),
                    $this->request->getPost('posted_by_id')
                );
            }catch (\CreateQuestionException $e) {
                print("error create question");
            }
           
        }
        return $this->response->redirect('/timeline/index/question');
    }

    public function updateAction(){
        if (!$this->security->checkToken()) {
            return NotFoundService::NotFound404();
        }

        $question_form = new QuestionForm();
        if($question_form->isValid($this->request->getPost())){
            
            try{
                $this->updateQuestionService->execute(

                    // posted_by_id = question_id
                    $this->request->getPost('posted_by_id'),
                    // question = new_question
                    $this->request->getPost('question')
                );
            }catch (\CreateQuestionException $e) {
                print("error create question");
            }
           
        }
        return $this->response->redirect('/timeline/index/question');
    }


    public function deleteAction($question_id){
        try{
            $this->deleteQuestionService->execute(
                $question_id
            );
        }catch (\DeleteQuestionException $e) {
            print("error delete question");
        }

        return $this->response->redirect('/timeline/index/question');
    }

    public function replyAction(){
        if (!$this->security->checkToken()) {
            return NotFoundService::NotFound404();
        }

        $reply_form = new ReplyForm();
        if($reply_form->isValid($this->request->getPost())){
            
            try{
                $this->replyQuestionService->execute(
                    $this->request->getPost('reply'),
                    $this->request->getPost('question_id')
                );
            }catch (\CreateRepliesException $e) {
                print("error create replies");
            }
           
        }
        return $this->response->redirect('/');
    }

}

