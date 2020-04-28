<?php

namespace Raledge\Modules\Timeline\Repository;

interface IExploreRepository{  
    public function discoverUsers();
    public function getRepliesQuestion($question_id);
    public function getRelateQuestionFromUserId($user_id);
}

?>