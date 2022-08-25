<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'post_id',
    ];
    public function posts()
    {
        return $this->belongsTo('App\Models\Post');
    }
    public function saves()
    {
        return $this->belongsTo(save::class);
    }
}
