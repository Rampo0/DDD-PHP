<?php


namespace Raledge\Modules\Question\Services;

use Raledge\Modules\Question\InMemory\QuestionRepository;

class UpdateQuestionService{

    private $repository;

    public function __construct(QuestionRepository $repository){
        $this->repository = $repository;
    }

    public function execute($question_id , $new_question){
        try{
            $this->repository->Update($question_id , $new_question);
        }catch (\Exception $exception){
            throw new \Exception();
        }
    }

}


?>