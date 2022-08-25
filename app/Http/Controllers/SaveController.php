<?php

namespace App\Http\Controllers;

use App\Models\Saved_post;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function create()
    {
        return view('posts.index');
    }


    public function store(Request $request)
    {
        $saved = new Saved_post;
        $saveflag = (Saved_post::where('post_id', '=', $request->input('postID'))->exists()) && (Saved_post::where('user_id', '=', $request->input('userID'))->exists());
        if (!($saveflag)) {
            $saved->user_id = $request->input('userID');
            $saved->post_id = $request->input('postID');
            $saved->save();
            return redirect()->route('posts.index')->with('success', 'Post saved successfully');
        }
        else {
            $deletedPost = Saved_post::where('post_id', $request->input('postID'))->where('user_id', $request->input('userID'))->delete();
            return redirect()->route('posts.index')->with('error', 'Post unsaved successfully');
        }


    }


    public function create2()
    {
        return view('posts.index');
    }

    public function store2(Request $request)
    {
        $saved = new Saved_post;
        $saveflag = (Saved_post::where('post_id', '=', $request->input('postID'))->exists()) && (Saved_post::where('user_id', '=', $request->input('userID'))->exists());
        if (!($saveflag)) {
            $saved->user_id = $request->input('userID');
            $saved->post_id = $request->input('postID');
            $saved->save();
            return redirect()->route('post', [$saved->post_id]);
        }
        else {
            $deletedPost = Saved_post::where('post_id', $request->input('postID'))->where('user_id', $request->input('userID'))->delete();
            $saved->post_id = $request->input('postID');
            return redirect()->route('post', [$saved->post_id]);
        }


    }
}
