<?php


namespace Raledge\Modules\Question\Services;

use Raledge\Modules\Question\InMemory\RepliesRepository;

class ReplyQuestionService{

    private $repository;

    public function __construct(RepliesRepository $repository){
        $this->repository = $repository;
    }

    public function execute($reply_message ,$question_id){
        try{
            $this->repository->Create($reply_message, $question_id);
        }catch (\Exception $exception){
            throw new \Exception();
        }
    }

}


?>