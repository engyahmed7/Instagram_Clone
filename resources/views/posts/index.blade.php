@extends('layouts.app2')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    background:#eee;
}
.posts-content{
    margin-top:20px;
}
.ui-w-40 {
    width: 40px !important;
    height: auto;
}
.default-style .ui-bordered {
    border: 1px solid rgba(24,28,33,0.06);
}
.ui-bg-cover {
    background-color: transparent;
    background-position: center center;
    background-size: cover;
}
.ui-rect {
    padding-top: 50% !important;
}
.ui-rect, .ui-rect-30, .ui-rect-60, .ui-rect-67, .ui-rect-75 {
    position: relative !important;
    display: block !important;
    padding-top: 100% !important;
    width: 100% !important;
}
.d-flex, .d-inline-flex, .media, .media>:not(.media-body), .jumbotron, .card {
    -ms-flex-negative: 1;
    flex-shrink: 1;
}
.bg-dark {
    background-color: rgba(24,28,33,0.9) !important;
}
.card-footer, .card hr {
    border-color: rgba(24,28,33,0.06);
}
.ui-rect-content {
    position: absolute !important;
    top: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    left: 0 !important;
}
.default-style .ui-bordered {
    border: 1px solid rgba(24,28,33,0.06);
}
    </style>
</head>
<body>
@if(auth()->user()->follows->count() == 0 && auth()->user()->posts()->count() == 0)
<div class="alert alert-danger">
  <strong>You don't have any post</strong>
</div>
@elseif(auth()->user()->follows->count() == 0 && auth()->user()->posts()->count() > 0)
@foreach(auth()->user()->posts as $post)
<div class="container posts-content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
              <div class="card-body">
                <div class="media mb-3">
                <img class="d-block ui-w-40 rounded-circle"  src="{{Storage::disk('public')->url('/images//'.$post['user']['profile']['image'])}}"  class="img-thumbnail" width="100" height="100">
                  <div class="media-body ml-3">
                  {{$post['user']['name']}}

                  </div>
                  <form action="{{ url('save-post') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="userID" value="{{ auth()->user()->id }}">
                <input type="hidden" name="postID" value="{{ $post->id }}">

                <button class="postLike" type="submit"><i
                        class="far fa-bookmark"></i></button>
            </form>
                </div>

                <p>
                <span class="text-muted">
                                    @php
                                        $cap =$post['caption'];
                                        foreach($tags as $tag){
                                        preg_match_all('/#(\w+)/', $cap, $matches);
                                        $ncap = str_replace($tag->name,"<a href='/tags/$tag->id '>$tag->name</a>",$cap);
                                        $cap = $ncap;
                                        }
                                        echo"$cap";
                                    @endphp


                                </span>
                </p>


                <a  href="{{ route('posts.show',$post['id']) }}" >  <img  src="{{Storage::disk('public')->url('/images//'.$post->images[0]->url)}}" alt="{{$post->caption}}" width="100%" height="100%"></a>
            <br>



              </div>
              <div class="card-body">

                @php
                $like_count = 0;
                $dislike_count = 0;
                $like_status = "btn-secondary";
                $dislike_status = "btn-secondary";
                @endphp
               @foreach($post['likes'] as $like)
               @if($like['like'] == 1)
               @php
                $like_count++;
                @endphp
                @endif
                @if($like['like'] == 0)
                @php
                  $dislike_count++;
                @endphp
                  @endif
                @php

                if($like['user_id'] == Auth::user()->id)
                {
                  if($like['like'] == 1)
                  {
                    $like_status = "btn-success";
                  }
                  else
                  {
                    $dislike_status = "btn-danger";
                  }
                }
                @endphp

               @endforeach
               <hr>
               <button  type="button" data-postid ="{{$post['id']}}_l" class="btn {{$like_status}} like" data-like="{{$like_status}}" >Like <i class="fa-solid fa-heart"></i><b><span class="like_count">{{$like_count}}</span></b></button>
               <button type="button"  data-postid ="{{$post['id']}}_d" class="btn {{$dislike_status}} dislike" data-like="{{$dislike_status}}">Dislike <i class="fa-solid fa-heart-crack"></i><b><span class="dislike_count">{{$dislike_count}}</span><b></button>


            </div>
            <form method="POST" action="{{url('save-comment/'.$post['id'])}}">
                @csrf
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                    </div>
                        <div class="form-group">
                        <input type="text" class="form-control" name="username"
                        value="{{auth()->user()->name}}" hidden>
                        <div class="form-group">
                        <input type="text" class="form-control" name="user_id"
                        value="{{auth()->user()->id}}" hidden>
                        </div>


                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Add Comment</button>
                </div>
            </form>
            <div class="card my-4">
                <h5 class="card-header">Comments : <span >{{count($post['comments'])}}</span></h5>
                <div class="card-body">
                     @if($post['comments'])

                     @foreach($post['comments']->take(3) as $comment)
                     <figure>
                         <blockquote class="blockquote">

                            <img class="d-block ui-w-40 rounded-circle"  src="{{Storage::disk('public')->url('/images//'.$post['user']['profile']['image'])}}"  class="img-thumbnail" width="100" height="100">

                             {{$comment['username']}}
                         </blockquote>
                         <figcaption class="blockquote-footer">

                             <h3>{{$comment['comment']}}</h3>
                             <p> Time : {{$comment['created_at']}}</p>
                         </figcaption>
                       </figure>

                     @endforeach
                     @if($post['comments']->count() > 3)

                     <a href="{{ route('posts.show',$post['id']) }}"> See More Comments</a>
                      @endif
                     @endif
                     <br>



            </div>
        </div>

            </div>
        </div>
    </div>
</div>
@endforeach
@else
@foreach(auth()->user()->follows as $follow)
@foreach($follow->posts as $post)
<div class="container posts-content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
              <div class="card-body">
                <div class="media mb-3">
                <img class="d-block ui-w-40 rounded-circle"  src="{{Storage::disk('public')->url('/images//'.$post['user']['profile']['image'])}}"  class="img-thumbnail" width="100" height="100">
                  <div class="media-body ml-3">
                  {{$post['user']['name']}}
                  </div>
                  <form action="{{ url('save-post') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="userID" value="{{ auth()->user()->id }}">
                <input type="hidden" name="postID" value="{{ $post->id }}">

                <button class="postLike" type="submit"><i
                        class="far fa-bookmark"></i></button>
            </form>
                </div>

                <p>
                <span class="text-muted">
                                    @php
                                        $cap =$post['caption'];
                                        foreach($tags as $tag){
                                        preg_match_all('/#(\w+)/', $cap, $matches);
                                        $ncap = str_replace($tag->name,"<a href='/tags/$tag->id '>$tag->name</a>",$cap);
                                        $cap = $ncap;
                                        }
                                        echo"$cap";
                                    @endphp


                                </span>
                </p>

                <a  href="{{ route('posts.show',$post['id']) }}" >  <img  src="{{Storage::disk('public')->url('/images//'.$post->images[0]->url)}}" alt="{{$post->caption}}" width="100%" height="100%"></a>
            <br>


              </div>
              <div class="card-body">

                @php
                $like_count = 0;
                $dislike_count = 0;
                $like_status = "btn-secondary";
                $dislike_status = "btn-secondary";
                @endphp
               @foreach($post['likes'] as $like)
               @if($like['like'] == 1)
               @php
                $like_count++;
                @endphp
                @endif
                @if($like['like'] == 0)
                @php
                  $dislike_count++;
                @endphp
                  @endif
                @php

                if($like['user_id'] == Auth::user()->id)
                {
                  if($like['like'] == 1)
                  {
                    $like_status = "btn-success";
                  }
                  else
                  {
                    $dislike_status = "btn-danger";
                  }
                }
                @endphp

               @endforeach
               <hr>
               <button  type="button" data-postid ="{{$post['id']}}_l" class="btn {{$like_status}} like" data-like="{{$like_status}}" >Like <i class="fa-solid fa-heart"></i><b><span class="like_count">{{$like_count}}</span></b></button>
               <button type="button"  data-postid ="{{$post['id']}}_d" class="btn {{$dislike_status}} dislike" data-like="{{$dislike_status}}">Dislike <i class="fa-solid fa-heart-crack"></i><b><span class="dislike_count">{{$dislike_count}}</span><b></button>


            </div>
            <form method="POST" action="{{url('save-comment/'.$post['id'])}}">
                @csrf
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                        <div class="form-group">

                        <input type="text" class="form-control" name="user_id"

                        value="{{auth()->user()->id}}" hidden>
                        <div class="form-group">

                        <input type="text" class="form-control" name="username"

                        value="{{auth()->user()->name}}" hidden>

                    </div>






                    </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Add Comment</button>
                </div>
            </form>

            <div class="card my-4">
                <h5 class="card-header">Comments : <span >{{count($post['comments'])}}</span></h5>
                <div class="card-body">
                     @if($post['comments'])

                     @foreach($post['comments']->take(3) as $comment)
                     <figure>
                         <blockquote class="blockquote">

                    <img class="d-block ui-w-40 rounded-circle"  src="{{Storage::disk('public')->url('/images//'.auth()->user()->profile->image)}}"  class="img-thumbnail" width="100" height="100">
                    {{$comment['username']}}

                        </blockquote>
                         <figcaption class="blockquote-footer">

                             <h3>{{$comment['comment']}}</h3>
                             <p> Time : {{$comment['created_at']}}</p>
                         </figcaption>
                       </figure>

                     @endforeach
                     @if($post['comments']->count() > 3)

                     <a href="{{ route('posts.show',$post['id']) }}"> See More Comments</a>
                      @endif
                     @endif
                     <br>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>

@endforeach
@endforeach
<h3 style="font-family: 'Kanit', sans-serif;">Your posts</h3>
@foreach(auth()->user()->posts as $post)
<div class="container posts-content">

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
              <div class="card-body">
                <div class="media mb-3">
                <img class="d-block ui-w-40 rounded-circle"  src="{{Storage::disk('public')->url('/images//'.$post['user']['profile']['image'])}}"  class="img-thumbnail" width="100" height="100">
                  <div class="media-body ml-3">
                  {{$post['user']['name']}}
                  </div>
                  <form action="{{ url('save-post') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="userID" value="{{ auth()->user()->id }}">
                <input type="hidden" name="postID" value="{{ $post->id }}">

                <button class="postLike" type="submit"><i
                        class="far fa-bookmark"></i></button>
            </form>
                </div>

                <p>
                <span class="text-muted">
                                    @php
                                        $cap =$post['caption'];
                                        foreach($tags as $tag){
                                        preg_match_all('/#(\w+)/', $cap, $matches);
                                        $ncap = str_replace($tag->name,"<a href='/tags/$tag->id '>$tag->name</a>",$cap);
                                        $cap = $ncap;
                                        }
                                        echo"$cap";
                                    @endphp


                                </span>
                </p>

                <a  href="{{ route('posts.show',$post['id']) }}" >  <img  src="{{Storage::disk('public')->url('/images//'.$post->images[0]->url)}}" alt="{{$post->caption}}" width="100%" height="100%"></a>
            <br>



              </div>
              <div class="card-body">

                @php
                $like_count = 0;
                $dislike_count = 0;
                $like_status = "btn-secondary";
                $dislike_status = "btn-secondary";
                @endphp
               @foreach($post['likes'] as $like)
               @if($like['like'] == 1)
               @php
                $like_count++;
                @endphp
                @endif
                @if($like['like'] == 0)
                @php
                  $dislike_count++;
                @endphp
                  @endif
                @php

                if($like['user_id'] == Auth::user()->id)
                {
                  if($like['like'] == 1)
                  {
                    $like_status = "btn-success";
                  }
                  else
                  {
                    $dislike_status = "btn-danger";
                  }
                }
                @endphp

               @endforeach
               <hr>
               <button  type="button" data-postid ="{{$post['id']}}_l" class="btn {{$like_status}} like" data-like="{{$like_status}}" >Like <i class="fa-solid fa-heart"></i><b><span class="like_count">{{$like_count}}</span></b></button>
               <button type="button"  data-postid ="{{$post['id']}}_d" class="btn {{$dislike_status}} dislike" data-like="{{$dislike_status}}">Dislike <i class="fa-solid fa-heart-crack"></i><b><span class="dislike_count">{{$dislike_count}}</span><b></button>


            </div>
            <form method="POST" action="{{url('save-comment/'.$post['id'])}}">
                @csrf
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                        <div class="form-group">

                        <input type="text" class="form-control" name="user_id"

                        value="{{auth()->user()->id}}" hidden>
                        <div class="form-group">

                        <input type="text" class="form-control" name="username"

                        value="{{auth()->user()->name}}" hidden>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Add Comment</button>
                </div>
            </form>
            <div class="card my-4">
                <h5 class="card-header">Comments : <span >{{count($post['comments'])}}</span></h5>
                <div class="card-body">
                     @if($post['comments'])

                     @foreach($post['comments']->take(3) as $comment)
                     <figure>
                         <blockquote class="blockquote">

                    <img class="d-block ui-w-40 rounded-circle"  src="{{Storage::disk('public')->url('/images//'.$post['user']['profile']['image'])}}"  class="img-thumbnail" width="100" height="100">
                    {{$comment['username']}}

                        </blockquote>
                         <figcaption class="blockquote-footer">

                             <h3>{{$comment['comment']}}</h3>
                             <p> Time : {{$comment['created_at']}}</p>
                         </figcaption>
                       </figure>

                     @endforeach
                     @if($post['comments']->count() > 3)

                     <a href="{{ route('posts.show',$post['id']) }}"> See More Comments</a>
                      @endif
                     @endif
                     <br>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

</body>
</html>
@endsection
