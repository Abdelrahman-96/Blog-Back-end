<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateComment;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CreateComment $request) {
        $request->merge([
            'user_id' => user()->id
        ]);
        Comment::create($request->all());
        return message(true, [],'Comment created successfully');
    }

    public function update(Request $request, $id) {
        if(!$id){
            return message(false, [],'This comment not found');
        }
        $comment = Comment::find($id);
        if(user()->id != $comment->blog->user_id){
            return message(false, [],'You cant take this action');
        }
        if(!$comment){
            return message(false, [],'This comment not found');
        }

        Comment::where('id', $id)->Update($request->all());
        return message(true, [],'Comment updated successfully');
    }

    public function delete($id) {
        if(!$id){
            return message(false, [],'This comment not found');
        }
        $comment = Comment::find($id);
        if(user()->id != $comment->blog->user_id){
            return message(false, [],'You cant take this action');
        }
        if(!$comment){
            return message(false, [],'This comment not found');
        }
        Comment::where('id', $id)->delete();
        return message(true, [],'Comment deleted successfully');
    }
}
