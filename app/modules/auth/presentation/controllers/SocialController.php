<?php
declare(strict_types=1);

namespace Raledge\Modules\Auth\Controllers;
use Phalcon\Http\Request;
use Raledge\Modules\Auth\Models\Users;
use Raledge\Domain\Services\NotFoundService;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class SocialController extends ControllerBase
{

    public function indexAction(){}

    public function followAction($followed_user_id){

        $sessions = $this->getDI()->getShared("session");

        if (!$sessions->has("user_id")) {
            return NotFoundService::NotFound404();
        }

        $user_id = $sessions->get("user_id");
        
        try{
            $this->followService->execute(
                $user_id,
                $followed_user_id
            );

        }catch (Exception $e){
            echo "<h1> failed follow user </h1>.";
        }
        
        return $this->response->redirect('/timeline/index/explore');
    }
    
}

