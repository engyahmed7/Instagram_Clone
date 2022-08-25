<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table ='tags';
    protected $fillable=[
        'tag_id',
        'created_at',
        'updated_at'
       
    ];
    public function posts()
    {
        return $this->hasMany(Post::class,'tag_id');}
}
