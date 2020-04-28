<?php

namespace Raledge\Modules\Auth\Repository;

interface ISocialRepository{
    public function follow($user_id , $followed_user_id);
}

?>