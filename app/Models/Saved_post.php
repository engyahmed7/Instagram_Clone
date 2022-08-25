<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saved_post extends Model
{
    use HasFactory;
    protected $table ='saved_posts';
    protected $fillable=[
        'user_id',
        'post_id',
        'created_at',
        'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posts()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
