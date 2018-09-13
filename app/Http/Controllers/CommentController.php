<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with($this->childBilder(Comment::max('level')))
            ->whereNull('parent_id')
            ->get();
        return response($comments->toArray(), 200);
    }

    public function childBilder($count){
        $child = '';
        for($i = 0; $i <= $count; $i++){
            if($i == $count){
                $child.= 'child';
            } else {
                $child.= 'child.';
            }
        }
        return $child;
    }

    public function show($id = null)
    {
        $comment = Comment::with($this->childBilder(Comment::max('level')))
            ->find($id);
        return $comment
            ? response($comment->toArray(), 200)
            : response('not find', 200);
    }

    public function store(CommentRequest $request)
    {
        $comment = new Comment();
        $comment->fill($request->all());
        $comment->save();

        return $comment ?: response($comment->toArray(), 200);

    }

    public function update($id = null, CommentRequest $request)
    {
        $comment = Comment::find($id);
        $comment->fill($request->all());
        if(!$request->parent_id){
            $comment->parent_id = null;
        }
        $comment->save();
        return $comment ?: response($comment->toArray(), 200);
    }

    public function delete($id)
    {
        $comment = Comment::with($this->childBilder(Comment::max('level')))->find($id);
        $comment->delete();

        return response('done', 200);

    }

}
