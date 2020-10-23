<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
       'user_id',
       'text'
    ];

    public function user()
    {
        return $this->beLongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class,'likes','tweet_id','user_id')
        ->whereNull('likes.deleted_at');
    }
}
