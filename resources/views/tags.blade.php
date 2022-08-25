@include('includes.navbar')
<div class="container tagsPage">
        <div class="row">
            <div class="col-md-12 mb-4">

                <h4 class="display-4">{{ $tag->name }} </h4>


            </div>
         
            </form>
            <!-- @foreach($posts as $post)

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a class="profilePost" href="{{url('post/'.$post->id )}}">link</a>
                </div>
            @endforeach -->
            @foreach($posts as $post)
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
                </div>
 

 
 
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
 
                             {{$post['user']['name']}}
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
        </div>
    </div>