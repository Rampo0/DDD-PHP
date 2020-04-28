<?php


namespace Raledge\Modules\Timeline\Services;

use Raledge\Modules\Timeline\InMemory\ExploreRepository;

class GetRelateQuestionService{

    private $repository;

    public function __construct(ExploreRepository $repository){
        $this->repository = $repository;
    }

    public function execute($user_id){
        try{
            $questions = $this->repository->getRelateQuestionFromUserId($user_id);
        }catch (\Exception $exception){
            throw new \Exception();
        }

        return $questions;
    }

}


?>