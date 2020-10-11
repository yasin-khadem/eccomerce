<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentCollection;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CommentCollection(
            Comment::with('user','product')->whereIsConfirmed(false)->orderBy('id','desc')->paginate(10)
        );
    }

   
    public function update(Request $request, Comment $comment)
    {
        $comment->update(['is_confirmed'=>$request->is_confirmed]);

        return response(['ok'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response(['ok'], 200);
    }
}
