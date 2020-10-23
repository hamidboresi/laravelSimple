<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTweetRequest;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function submit(CreateTweetRequest $request)
    {
        $user = User::where('api_token',$request->bearerToken())->first();
        $user->tweets()->create($request->all());
        return response()->json(['data' => [],'errors' =>[]],200);
    }

    public function list(Request $request)
    {
        $user = User::where('api_token',$request->api_token)->first();
        $tweets = $user->tweets()->get();
        return response()->json(['data' => $tweets,'errors' =>[]],200);
    }

    public function delete(Request $request,$id)
    {
        $user = User::where('api_token',$request->bearerToken())->first();
        $user->tweets()->where('id',$id)->delete();
        return response()->json(['data' => [],'errors' =>[]],200);
    }
}
