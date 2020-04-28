<?php

namespace Raledge\Modules\Auth\Models;
use Phalcon\Mvc\Model;

class Followers extends Model{
    public $id;
    public $user_id;
    public $followed_id;
}

?>