<?php


namespace Raledge\Modules\Auth\Services;

use Raledge\Modules\Auth\InMemory\UserRepository;

class LoginService{

    private $repository;

    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    public function execute($email ,$password, $controller){
        try{
            $user = $this->repository->Login($email, $password, $controller);
        }catch (\Exception $exception){
            throw new \Exception();
        }
        return $user;
    }

}


?>