@extends('layouts.app2')
@section('content')

    <div class="row">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="col-lg-12 margin-tb">


        </div>
    </div>

    <div class="row" style="display: flex;
    align-items: center;
    justify-content: center;">

        <div class="col-xs-12 col-sm-12 col-md-12"  style="width: 50%; ">
            <div class="form-group">
                @foreach ($posts->images as $image)
                User Name :  {{$posts['user']['name']}}
                <img class="card-img-top" src="{{Storage::disk('public')->url('/images//'.$image->url)}}" alt="Card image cap">
                &nbsp;
                @endforeach

            </div>
            <div class="card-body">

               @php
               $like_count = 0;
               $dislike_count = 0;
               $like_status = "btn-secondary";
               $dislike_status = "btn-secondary";
               @endphp
              @foreach($posts['likes'] as $like)
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
              <button  type="button" data-postid ="{{$posts['id']}}_l" class="btn {{$like_status}} like" data-like="{{$like_status}}" >Like <i class="fa-solid fa-heart"></i><b><span class="like_count">{{$like_count}}</span></b></button>
              <button type="button"  data-postid ="{{$posts['id']}}_d" class="btn {{$dislike_status}} dislike" data-like="{{$dislike_status}}">Dislike <i class="fa-solid fa-heart-crack"></i><b><span class="dislike_count">{{$dislike_count}}</span><b></button>


           </div>



        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <p> Caption:</p>   {{ $posts['caption'] }}

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <br>

        </div>
        <br>
        <form method="POST" action="{{url('save-comment/'.$posts['id'])}}">
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
                <button type="submit" class="btn btn-primary">Add Comment</button>
            </div>
        </form>
        <div class="card my-4"   >
           <h5 class="card-header">Comments : <span >{{count($posts['comments'])}}</span></h5>
           <div class="card-body">
                @if($posts['comments'])
                @foreach($posts['comments'] as $comment)
                <figure>
                    <blockquote class="blockquote">
                        <div class="circle" >
                            <img class="d-block ui-w-40 rounded-circle" src="{{Storage::disk('public')->url('/images//'.auth()->user()->profile->image)}}" alt="{{$posts['title']}}" class="img-thumbnail" width="50" height="50">
                            </div>
                            {{$comment['username']}}
                    </blockquote>
                    <figcaption>


                      <p> Comment:</p> <h3>{{$comment['comment']}}</h3>
                      <p> Time : {{$comment['created_at']}}</p>

                        <hr>
                    </figcaption>
                  </figure>

                @endforeach

                @endif

            </div>
        </div>



        </div>


    </div>
@endsection
