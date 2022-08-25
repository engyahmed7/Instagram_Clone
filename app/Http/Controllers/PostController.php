<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use App\Models\Post;
use App\Models\Comment;

use App\Models\Profile;
use App\Models\save;
use App\Models\Like;
use App\Models\User;
use App\Models\Image;
use App\Models\Saved_post;
use App\Models\savedimage;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::all();
        $posts = Post::paginate(8);
        $image = Image::all();
        $posts = Post::all();
        $tags = Tag::all();


        return view('posts.index')->with(['posts' => $posts])->with('profiles', $profile)->with('images', $image)->with(['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = $request->all();
        $post = new Post;

        $post->caption = $request->caption;
        $str = $request->input('caption');

        $post->user_id = Auth::user()->id;
        $post->save();

        foreach ($request->file('images') as $imagefile) {
            $image = new Image;

            $path = $imagefile->store('public/images');
            $image->url = basename($path);
            $image->post_id = $post->id;
            $image->save();
        }

        ;
        preg_match_all('/#(\w+)/', $str, $matches);

        foreach ($matches[0] as $hashtag_name) {
            $tag = Tag::where('name', '=', $hashtag_name)->first();
            if ($tag === null) {

                $tag = new Tag;
                $tag->name = $hashtag_name;
                $tag->save();
         }
         $inserttag=$tag->id;
         $post->tag_id= $inserttag;
         $post->save();


        }


        return redirect('posts')->with('success', 'post has been added');


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->with(['posts' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit')->with(['posts'=> $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, $id)
    {
    // bas
    //     $post = Post::find($id);
    //     $input = $request->all();
    //     $post->update($input);

     $input =  $request->all();
                $post = Post::find($id);
                $post->caption = $request->caption;
                $post->user_id = Auth::user()->id;

                foreach ($request->file('images') as $imagefile) {
                    $image = new Image;
                $path = $imagefile->store('public/images');
                $image->url = basename($path);
                $image->post_id = $post->id;
                $image->save();
                }
                $post->update($input);

       return redirect('posts') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('posts')->with('flash_message', 'Post deleted!');
    }
    // search with username or name

    public function search()
    {
        $search = request('search');
        $users = User::where('username', 'like', '%' . $search . '%')->orWhere('name', 'like', "%{$search}%")->get();
        $posts = Post::whereHas('user', function ($query) use ($users) {
            $query->whereIn('id', $users->pluck('id'));
        })->get();
        return view('posts.search')->with(['posts' => $posts]);
    }


   public function showsaved(){
    $saved = Saved_post::where('user_id',Auth::id())->get();
       return view('posts.showsaved')->with(['saved'=>$saved]);
   }

    public function like(Request $request)
    {
        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $change_like = 0;
        $like = DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->first();
        if (!$like) {
            $new_like = new Like;
            $new_like->post_id = $post_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 1;
            $new_like->save();
            $is_like = 1;
        }
        elseif ($like->like == 1) {
            DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->delete();
            $is_like = 0;
        }
        elseif ($like->like == 0) {
            DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->update(['like' => 1]);
            $is_like = 1;
            $change_like = 1;
        }
        $response = array(
            'is_like' => $is_like,
            'change_like' => $change_like,

        );


        return response()->json($response, 200);
    }








    public function dislike(Request $request)
    {
        $like_s = $request->like_s;
        $post_id = $request->post_id;

        $change_dislike = 0;
        $dislike = DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->first();
        if (!$dislike) {
            $new_like = new Like();
            $new_like->post_id = $post_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 0;
            $new_like->save();
            $is_dislike = 1;
        }
        elseif ($dislike->like == 0) {
            DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->delete();
            $is_dislike = 0;
        }
        elseif ($dislike->like == 1) {
            DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->update(['like' => 0]);
            $is_dislike = 1;
            $change_dislike = 1;
        }
        $response = array(
            'is_dislike' => $is_dislike,
            'change_dislike' => $change_dislike,

        );




        return response()->json($response, 200);



    }

    public function saveComment(Request $request, $id)
    {
        $request->validate([

            'comment' => 'required'

        ]);

        $data = new Comment;
        $data->user_id = $request->user_id;
        $data->username = $request->username;
        $data->post_id = $id;
        $data->comment = $request->comment;
        $data->save();

        return redirect()->back()->with('success', 'Comment added successfully');

    }





}
