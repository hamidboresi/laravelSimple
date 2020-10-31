<?php

namespace App\Http\Controllers;

use App\Events\TweetCreated;
use App\Events\TweetDeleted;
use App\Http\Requests\CreateTweetRequest;
use App\Http\Requests\DeleteTweetRequest;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function submit(CreateTweetRequest $request)
    {
        $user = auth('api')->user();
        $user->tweets()->create($request->all());
        event(new TweetCreated($user));
        return response()->json(['data' => [],'errors' =>[]],200);
    }

    public function list(Request $request)
    {
        $user = auth('api')->user();
        $tweets = $user->tweets()->get();
        return response()->json(['data' => $tweets,'errors' =>[]],200);
    }

    public function specific(Request $request,$tweet_id)
    {
        $tweet = Tweet::with('comments')->findOrFail($tweet_id);
        return response()->json(['data' => $tweet,'errors' =>[]],200);
    }

    public function delete(DeleteTweetRequest $request,$id)
    {
        Tweet::find($id)->delete();
        event(new TweetDeleted());
        return response()->json(['data' => [],'errors' =>[]],200);
    }
}
