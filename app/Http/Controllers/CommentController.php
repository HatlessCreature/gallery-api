<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Gallery;

class CommentController extends Controller
{
    public function store($id, CreateCommentRequest $request){
        $data = $request->validated();

        $gallery = Gallery::with(['images', 'user', 'comments', 'comments.user'])->find($id);
        $comment = new Comment;
        $comment->content = $data['content'];
        $comment->user()->associate(Auth::user());
        $comment->gallery()->associate($gallery);
        $comment->save();

        return response()->json($comment, 201);
    }

    public function destroy($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json($id, 200);
    }
}
