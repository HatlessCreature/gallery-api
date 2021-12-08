<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Gallery;

class CommentController extends Controller
{
    public function store(Gallery $gallery, CreateCommentRequest $request){
        $data = $request->validated();

        $comment = new Comment;
        $comment->content = $data['content'];
        $comment->user()->associate(Auth::user());
        $comment->gallery()->associate($gallery);
        $comment->save();

        return response()->json($comment, 201);
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return response()->noContent();
    }
}
