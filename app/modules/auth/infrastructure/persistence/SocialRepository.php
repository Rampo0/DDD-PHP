<?php

namespace Raledge\Modules\Auth\InMemory;

use Raledge\Modules\Auth\Repository\ISocialRepository;
use Raledge\Modules\Auth\Models\Followers;
use Raledge\Modules\Auth\Models\Users;
use Raledge\Modules\Auth\Models\Invoices;

class SocialRepository implements ISocialRepository {
    
    public function follow($user_id , $followed_user_id){
        $follower = new Followers();
        $follower->user_id = $user_id;
        $follower->followed_id = $followed_user_id;
        $follower->save();
    }

}


?>