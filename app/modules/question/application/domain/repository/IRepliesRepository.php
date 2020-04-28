<?php

namespace Raledge\Modules\Question\Repository;

interface IRepliesRepository{
    public function Create($reply_message , $question_id);
}

?>