<?php

namespace Raledge\Domain\Models;

use Raledge\Domain\Repository\IAuthModel;
use Raledge\Modules\Auth\Models\Users;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class AuthModel implements IAuthModel
{

    public static function SignUp($controller){

        $user = new Users();
        $nickname = $controller->request->getPost('nickname');
        $password = $controller->request->getPost('password');
        $email = $controller->request->getPost('email');

        $user->nickname = $nickname;
        $user->email = $email;

        // Store the password hashed
        $user->password = $controller->security->hash($password);

        $user->save();

    }

    public static function Login($controller , $email , $password){
        $user = Users::findFirstByEmail($email);
  
        if($user){
            if($controller->security->checkHash($password, $user->password)){
                $sessions = $controller->getDI()->getShared("session");
                $sessions->set("user_id", $user->id);
                return true;
            } 
        }else{
            $controller->security->hash(rand());
        }
        return false;
    }

    public function Logout(){

    }

}

?>

