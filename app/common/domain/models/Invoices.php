<?php

namespace Raledge\Domain\Models;

use Phalcon\Mvc\Model;
use Raledge\Modules\Timeline\Models\Tes;

class Invoices extends Model{
    public $id;
    public $name;
    public function tes(){
        $lol = new Tes();
        echo "Hallo";
    }
}

?>