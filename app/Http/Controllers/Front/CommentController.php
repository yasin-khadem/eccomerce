<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequst;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequst $request){
        Comment::create([
            'product_id'=>$request->product_id,
            'user_id'=>$request->user()->id,
            'body'=>$request->body,
            'comment_id'=>$request->comment_id,
        ]);
        return response(['ok'],200);
    }
    public function destroy(Comment $comment){
        $comment->delete();
        return response(['ok'], 200);
    }
}
