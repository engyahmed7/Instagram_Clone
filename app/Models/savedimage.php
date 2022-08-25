<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class savedimage extends Model
{
    use HasFactory;
    protected $fillable = [

        'id',

        'url',

        'save_id',

    ];

    public function saves()

    {

        return $this->belongsTo('App\Models\save');

    }
  

   
}
