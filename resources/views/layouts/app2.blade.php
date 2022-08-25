<html>
 <head>
 <title>App Name - @yield('title')</title>
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
 </head>
 <body>
 @section('navbar')
 @include('includes.navbar')
 @show
 <div class="container">
 @yield('content')
 </div>
 </body>
</html>
