<?php


namespace Raledge\Modules\Timeline\Services;

use Raledge\Modules\Timeline\InMemory\ExploreRepository;

class GetRepliesQuestionService{

    private $repository;

    public function __construct(ExploreRepository $repository){
        $this->repository = $repository;
    }

    public function execute($question_id){
        try{
            $replies = $this->repository->getRepliesQuestion($question_id);
        }catch (\Exception $exception){
            throw new \Exception();
        }

        return $replies;
    }

}


?>