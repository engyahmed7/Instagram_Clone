<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $tag = Tag::find($id);
        $posts= $tag->posts;
  

        return view('tags', compact('posts','tag'));
       
    }
}
