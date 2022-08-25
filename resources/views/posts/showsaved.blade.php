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

@foreach ($saved as $item)
<div class="card w-50">
<br>
   @foreach ($item->posts->images as $image )
  <a href="{{route('posts.show',$item->posts->id)}}"><img class="d-block ui-w-20 "  src="{{Storage::disk('public')->url('/images//'.$image->url)}}"   width="400px" ></a>
@endforeach
<br>
<h3>Caption:   {{ $item->posts->caption}}</h3>
<br>
</div>
<br>
@endforeach
</body>
</html>
@endsection
