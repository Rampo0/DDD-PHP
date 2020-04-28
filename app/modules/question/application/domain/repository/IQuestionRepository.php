<?php

namespace Raledge\Modules\Question\Repository;

interface IQuestionRepository{
    public function Create($question , $posted_by_id);
    public function Update($question_id ,$new_question);
    public function Delete($question_id);
}

?>