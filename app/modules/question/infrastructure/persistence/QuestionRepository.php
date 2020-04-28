<?php

namespace Raledge\Modules\Question\InMemory;

use Raledge\Modules\Question\Repository\IQuestionRepository;
use Raledge\Modules\Question\Models\Questions;

class QuestionRepository implements IQuestionRepository {
    
    public function Create($question, $posted_by_id){
        $new_question = new Questions();
        $new_question->question = $question;
        $new_question->posted_by_id = $posted_by_id;
        $new_question->save();
    }

    public function Update($question_id , $new_question){
        $update_question = Questions::findFirst($question_id);
        $update_question->question = $new_question;
        $update_question->save();
    }

    public function Delete($question_id){
        $question = Questions::findFirst($question_id);

        if ($question !== false) {
            if ($question->delete() === false) {
                echo "Sorry, we can't delete the robot right now: \n";

                $messages = $question->getMessages();

                foreach ($messages as $message) {
                    echo $message, "\n";
                }
            } else {
                echo 'The robot was deleted successfully!';
            }
        }
    }

}


?>