<?php


namespace Raledge\Modules\Timeline\Services;

use Raledge\Modules\Timeline\InMemory\ExploreRepository;

class DiscoverUserService{

    private $repository;

    public function __construct(ExploreRepository $repository){
        $this->repository = $repository;
    }

    public function execute(){
        try{
            $users = $this->repository->discoverUsers();
        }catch (\Exception $exception){
            throw new \Exception();
        }

        return $users;
    }

}


?>