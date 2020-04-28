<?php

namespace Raledge\Modules\Auth\Repository;

interface IUserRepository{
    public function SignUp($nickname, $email , $password, $security);
    public function Login($email , $password, $controller);
    public function Logout();
}

?>