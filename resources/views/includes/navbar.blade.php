<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@1&family=Lobster&display=swap" rel="stylesheet">

    <title>Document</title>
<style>
  @import url('//fonts.cdnfonts.com/css/billabong');

body {
  background: #fafafa;
}

/* start header */

.navigation {
  background-color: #ffffff;
  height: 80px;
  width: 100%;
  top: 0;
  left: 0;
  border-bottom: 1px solid rgba(0, 0, 0, 0.0975);
  display: flex;
  align-items: center;
  justify-content: space-around;
  padding: 0px 50px;
  box-sizing: border-box;
  z-index: 2;
}

.shrink {
  height: 50px;
}

.navigation .logo a {
  position: relative;
  color: #000000;
  font-size: 30px;
  text-decoration: none;
  font-family: 'Lobster', cursive;
}

.navigation-search-container {
  position: relative;
}

.navigation-search-container input {
  background-color: #fafafa;
  padding: 3px 20px;
  padding-left: 25px;
  height: 30px;
  box-sizing: border-box;
  border: 1px solid rgba(0, 0, 0, 0.0975);
  border-radius: 3px;
  font-size: 14px;
}

.navigation-search-container .fa-search {
  position: absolute;
  top: 10px;
  left: 10px;
  font-size: 11px;
  color: rgba(0, 0, 0, 0.5);
}

@media only screen and (min-width: 320px) and (max-width: 650px) {
  /* Navigation */
  .navigation {
    padding: 0 20px;
    margin-bottom: 100px;
    justify-content: space-between;
  }
  .navigation-search-container {
    display: none;
  }
  .navigation-icons {
    display: flex;
  }
}

.navigation-icons {
  display: flex;
}

.navigation-search-container input:focus {
  outline: none;
}

.navigation-search-container input::placeholder {
  text-align: center;
}


/* end header */

</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="navigation">
  <div class="logo">
    <a class="no-underline" href="{{route('posts.index')}}">
      Instagram
    </a>
  </div>
  <div class="navigation-search-container">
  <form action="{{route('search')}}" method="GET">
      <input type="text" name="search" placeholder="Search Here">
      <i class="fa fa-search"></i>
      <input type="submit" value="Search">
    </form>
  </div>
<div>
    <a href="{{route('posts.index')}}" class="btn btn-secondary" style="font-size:20px"  >
     Home
    </a>
    <a href="{{route('profile.show',Auth::user())}}" class="btn btn-secondary" style="font-size:20px"  >

     Profile

    </a>
    <a href="{{route('posts.showsaved')}}" class="btn btn-secondary" style="font-size:20px"  >

      Saved
 
     </a>
    </div>

</div>
<!-- scroll down test--->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/2b35ccce9d.js" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="{{url('/js/like.js')}}"></script>

<script>
  var url = "{{route('like')}}";
  var url_dis = "{{route('dislike')}}";
  var token = "{{Session::token()}}";
 

  </script>

</body>
</html>