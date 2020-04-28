<?php


namespace Raledge\Modules\Auth\Services;

use Raledge\Modules\Auth\InMemory\UserRepository;

class RegisterService{

    private $repository;

    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    public function execute($nickname, $email ,$password, $security){
        try{
            $this->repository->SignUp($nickname, $email, $password, $security);
        }catch (\Exception $exception){
            throw new \Exception();
        }
    }

}


?>