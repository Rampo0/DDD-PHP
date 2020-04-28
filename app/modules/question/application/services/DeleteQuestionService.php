<?php


namespace Raledge\Modules\Question\Services;

use Raledge\Modules\Question\InMemory\QuestionRepository;

class DeleteQuestionService{

    private $repository;

    public function __construct(QuestionRepository $repository){
        $this->repository = $repository;
    }

    public function execute($question_id){
        try{
            $this->repository->Delete($question_id);
        }catch (\Exception $exception){
            throw new \Exception();
        }
    }

}


?>