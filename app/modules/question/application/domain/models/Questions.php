<?php

namespace Raledge\Modules\Question\Models;
use Phalcon\Mvc\Model;

class Questions extends Model{
    public $id;
    public $question;
    public $posted_by_id;
    public $created_at;
    public $updated_at;
}

?>