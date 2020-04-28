<?php

namespace Raledge\Modules\Question\InMemory;

use Raledge\Modules\Question\Repository\IRepliesRepository;
use Raledge\Modules\Question\Models\Replies;

class RepliesRepository implements IRepliesRepository {
    
    public function Create($reply_message, $question_id){
        $reply = new Replies();
        $reply->reply_message = $reply_message;
        $reply->question_id = $question_id;
        $reply->save();
    }

}


?>