@section('title', "Search Result")
@include('layouts.app2')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Search Result</h1>
                </div>
                @if(count($posts) == 0)
                    <h3 style="text-align:center;">No results found</h3>
                @endif
                <div class="card-body">
                    <div class="row">
                        @foreach ($posts as $post)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                            <a  href="{{ route('posts.show',$post['id']) }}" >  <img  src="{{Storage::disk('public')->url('/images//'.$post->images[0]->url)}}" alt="{{$post->caption}}" width="100%" height="100%"></a>
                                <div class="card-body">
                                    <p class="card-text">{{ $post->caption }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

