<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory, SoftDeletes;

    protected  $fillable = [
        'title',
        'content',
        'user_id',
        'post_id',
    ];

    public function user()
    {
       return  $this->belongsTo(User::class);
    }

    public function post()
    {
       return  $this->belongsTo(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

