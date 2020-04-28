<?php
declare(strict_types=1);

namespace Raledge\Modules\Auth\Controllers;
use Phalcon\Http\Request;
use Raledge\Modules\Auth\Models\Users;
use Raledge\Modules\Auth\Forms\RegisterForm;
use Raledge\Modules\Auth\Forms\LoginForm;
use Raledge\Domain\Services\NotFoundService;
use Raledge\Domain\Models\AuthModel;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class IndexController extends ControllerBase
{

    public function indexAction(){
        $regFrom = new RegisterForm();
        $this->view->regForm = $regFrom; 

        $loginForm = new LoginForm();
        $this->view->loginForm = $loginForm;

        $sessions = $this->getDI()->getShared("session");

        if ($sessions->has("user_id")) {
            return $this->response->redirect("/");
        }

    }

    public function logoutAction(){
        $sessions = $this->getDI()->getShared("session");
        $sessions->remove("user_id");

        return $this->response->redirect('/auth');
    }

    public function loginAction(){
        
        $loginForm = new LoginForm();
        if($this->security->checkToken()){
            if($loginForm->isValid($this->request->getPost())){
                
                // $user = AuthModel::Login($this , $this->request->getPost('email'), $this->request->getPost('password') );
                $user = $this->loginService->execute(
                    $this->request->getPost('email'), 
                    $this->request->getPost('password'),
                    $this
                );
                
                if($user){
                    return $this->response->redirect('/');
                }else{
                    // it should go to current view ??
                    $this->view->regForm = new RegisterForm();
                    $this->view->loginForm = $loginForm;

                    // return $this->response->redirect('/auth');
                }
            }else{
                $this->view->regForm = new RegisterForm();
                $this->view->loginForm = $loginForm;

                // foreach ($loginForm->getMessages() as $message) {
                //     $this->flashSession->error($message);
                // }

                // $this->flashSession->error("halllo");
                // $this->flashSession->setSessionMessages($loginForm->getMessages());

                return $this->response->redirect('/auth');
            }
        }else{
            return NotFoundService::NotFound404();
        }
    
    }

    public function signupAction(){

        $regForm = new RegisterForm();
       
        if($regForm->isValid($this->request->getPost())){
            if ($this->security->checkToken()) {

                try{
                    $this->registerService->execute(
                        $this->request->getPost('nickname'),
                        $this->request->getPost('email'),
                        $this->request->getPost('password'),
                        $this->security
                    );
                }catch (\RegisterFailedException $e){
                    return $this->response->redirect('/auth');
                }
                
                return $this->response->redirect('/auth');
            }else{   
                return NotFoundService::NotFound404();
            }
        }else{
            // show error
            $this->view->regForm = $regForm;
            $this->view->loginForm = new LoginForm();
        }
            
    }
    
}

