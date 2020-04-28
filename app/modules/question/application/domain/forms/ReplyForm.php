<?php

namespace Raledge\Modules\Question\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class ReplyForm extends Form
{
    public function initialize(){
        $this->setEntity($this);
        
        $reply = new Text('reply');
        $reply->setAttribute('placeholder','Reply message.');
        $reply->addValidator(new PresenceOf(array(
            'message' => 'Reply is required'
        )));

        $question_id = new Hidden('question_id');
        $question_id->addValidator(new PresenceOf(array(
            'message' => 'posted_question_id is required'
        )));

        $this->add($reply);
        $this->add($question_id);
        
    }
}

?>