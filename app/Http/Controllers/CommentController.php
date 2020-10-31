<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Listeners\IncreaseTweetComments;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function submit(CreateCommentRequest $request,$tweet_id)
    {
        $user = auth('api')->user();
        $user->comments()->create(['tweet_id' => $tweet_id,'text' => $request->text]);
        event(new IncreaseTweetComments($tweet_id));
        return response()->json(['data' => [],'errors' =>[]],200);
    }
}
