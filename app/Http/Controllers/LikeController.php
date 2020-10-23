<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function like(LikeRequest $request)
    {
        $user = auth('api')->user();
        $user->likedPosts()->attach($request->tweet_id);
        return response()->json(['data' => [],'errors' =>[]],200);
    }

    public function unLick(LikeRequest $request)
    {
        $user = auth('api')->user();
        DB::table('likes')->where('user_id' , $user->id)
        ->where('tweet_id' , $request->tweet_id)
        ->update([
            'deleted_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
            ]);
        return response()->json(['data' => [],'errors' =>[]],200);
    }

    public function likes(LikeRequest $request)
    {
        $tweet = Tweet::find($request->tweet_id);
        $likes = $tweet->likes()->get();
        return response()->json(['data' => $likes,'errors' =>[]],200);
    }

}
