<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oetipoe!</title>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/allscripts.js"></script>
    @yield('heading')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="padding: 70px" data-spy="scroll" data-target="#mymenu" data-offset="60" class="scrollspy-example">
  <!-- Make room for the main bar! -->
    <header>
    @section('mainbar')
      @lang('template.loginfirst')<br>
    @show
    </header>
    <!-- Please feed me content... -->
    <div class='container-fluid'>
      <!-- Are there any messages? -->
      @include('flash::message')
      @yield('content')
    </div>
    <!-- Finally, we're getting to an end! -->
    <footer>
    </footer>
    @section('javascript')
    @show
  </body>
</html>