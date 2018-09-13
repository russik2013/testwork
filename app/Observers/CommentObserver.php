<?php

namespace App\Observers;

use App\Comment;

class CommentObserver
{
    /**
     * @param Comment $comment
     */
    public function saving(Comment $comment)
    {
        $comment->level = $this->getLevel($comment);
    }

    public function getLevel($comment)
    {
        if($comment->parent_id){
           return Comment::find($comment->parent_id)->level + 1;
        } else {
           return 0;
        }
    }

}
