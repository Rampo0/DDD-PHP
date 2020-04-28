<?php

namespace Raledge\Modules\Question\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class QuestionForm extends Form
{
    public function initialize(){
        $this->setEntity($this);
        
        $question = new Text('question');
        $question->setAttribute('placeholder','Start your question with What, How, Why, etc.');
        $question->addValidator(new PresenceOf(array(
            'message' => 'Question is required'
        )));

        $posted_by_id = new Hidden('posted_by_id');
        $posted_by_id->addValidator(new PresenceOf(array(
            'message' => 'posted_by_id is required'
        )));

        $this->add($question);
        $this->add($posted_by_id);
        
    }
}

?>