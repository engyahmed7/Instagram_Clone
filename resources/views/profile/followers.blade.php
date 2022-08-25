@extends('layouts.app2')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" ></script>
</head>
<body>
    <h2>Followers List</h2>
    <hr>
<table class="table">
   
    <tbody>
        @foreach($profile['user']->followersList() as $followers )
        
      <tr>
      
        <td>
        
        
                     
                         @if(auth()->user()->isFollowing($followers))
                            <form action="{{route('follow',$followers->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger float-end">Unfollow</button>
                        
                          @else
                            <form action="{{route('follow',$followers->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary float-end">Follow</button>
                          @endif
                       
                          <h4>{{$followers->name}}</h4>   
                          
     @endforeach      

     
                      
          </td>
          
      
    
    
      </tr>
    </tbody>
  </table>
    
</body>
</html>



@endsection