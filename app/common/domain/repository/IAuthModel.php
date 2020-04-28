<?php

namespace Raledge\Domain\Repository;

interface IAuthModel{
    public static function SignUp($controller);
    public static function Login($controller,$email , $password);
    public function Logout();
}

?>