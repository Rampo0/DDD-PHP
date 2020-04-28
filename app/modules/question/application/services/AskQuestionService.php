<?php


namespace Raledge\Modules\Question\Services;

use Raledge\Modules\Question\InMemory\QuestionRepository;

class AskQuestionService{

    private $repository;

    public function __construct(QuestionRepository $repository){
        $this->repository = $repository;
    }

    public function execute($question, $posted_by_id){
        try{
            $this->repository->Create($question, $posted_by_id);
        }catch (\Exception $exception){
            throw new \Exception();
        }
    }

}


?>