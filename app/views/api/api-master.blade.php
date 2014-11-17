<!DOCTYPE html>
<html>
  <head>
    <title>Track your work</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    
    {{ HTML::style('assets/css/bootstrap.css') }}
    {{ HTML::style('assets/css/style.css') }}
    <!-- add by banyar : for responsive table -->
    {{ HTML::style('assets/css/no-more-tables.css') }}


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    {{ HTML::script('assets/js/bootstrap.js') }}
    {{ HTML::script('assets/js/ecsmusic.js') }}

 <!-- add by banyar : for sub-navigation page active -->
    
  </head>
  <body id="home">
  <div class="container" >
      
        @yield('content')
  </div>
    
   

  </body>
</html>