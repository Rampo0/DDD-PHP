<?php

namespace Raledge\Modules\Timeline\InMemory;

use Raledge\Modules\Timeline\Repository\IExploreRepository;
use Raledge\Modules\Auth\Models\Users;
use Raledge\Modules\Auth\Models\Followers;
use Raledge\Modules\Question\Models\Questions;
use Raledge\Modules\Question\Models\Replies;

class ExploreRepository implements IExploreRepository {

    public function discoverUsers(){

        $users = Users::find();
        return $users;
        
    }

    public function getRepliesQuestion($question_id){
        
        $replies = Replies::find([
            'conditions' => 'question_id = :question_id:',
            'bind'       => [
                'question_id' => $question_id,
            ],
            'order'      => 'id desc',
        ]);
        
        return $replies;
    }

    public function getRelateQuestionFromUserId($user_id){
        
        $get_followers = Followers::find([
            'conditions' => 'user_id = :user_id:',
            'bind'       => [
                'user_id' => $user_id,
            ],
            'order'      => 'id asc',
        ]);

        $output = array();

        foreach ($get_followers as $follower) {
            $get_questions = Questions::find([
                'conditions' => 'posted_by_id = :user_id:',
                'bind'       => [
                    'user_id' => $follower->followed_id,
                ],
                'order'      => 'id desc',
            ])->toArray();

            foreach ($get_questions as $question) {
                array_push($output , $question);
            }
        }

        return $output;

    }

}


?>