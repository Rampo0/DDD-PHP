<?php

namespace Raledge\Modules\Question\Models;
use Phalcon\Mvc\Model;

class Replies extends Model{
    public $id;
    public $reply_message;
    public $question_id;
}

?>