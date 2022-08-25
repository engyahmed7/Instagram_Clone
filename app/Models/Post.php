<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Spatie\Tags\HasTags;
class Post extends Model

{

    protected $guarded = [];
    protected $fillable = [
        'caption',
        'user_id',
        'image'
    ];
    use HasFactory;
    use HasTags;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
     return $this->hasMany('App\Models\Image', 'post_id');
    }
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }
    public function tags()
    {
        return $this->belongsTo(Tag::class,'tag_id');
    }
   
}
