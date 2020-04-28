<?php


namespace Raledge\Modules\Auth\Services;

use Raledge\Modules\Auth\InMemory\SocialRepository;

class FollowService{

    private $repository;

    public function __construct(SocialRepository $repository){
        $this->repository = $repository;
    }

    public function execute($user_id , $followed_user_id){
        try{
            $this->repository->follow($user_id , $followed_user_id);
        }catch (\Exception $exception){
            throw new \Exception();
        }
    }

}


?>