<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [

        'id',
        'post_id',
        'user_id',
        'comment',
        'username'

    ];

    public function posts()
    {

        return $this->belongsTo(Post::class);

    }

    public function users()
    {

        return $this->belongsTo(User::class);

    }
}
