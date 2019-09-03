<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>donde.huesped.org.ar | Fundación Huésped</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">

  @yield('meta')

  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <link href='https://fonts.googleapis.com/css?family=Ultra' rel='stylesheet' type='text/css'>

  {!!Html::style('bower_components/materialize/bin/materialize.css')!!}
  {!!Html::style('bower_components/wow.js/css/libs/animate.css')!!}
  {!!Html::style('styles/main.min.css')!!}
  
</head>
<body>
  <main>
  	@yield('content')
  </main>
    @include('analytics')
 </body>
  {!!Html::script('bower_components/jquery/dist/jquery.js')!!}
  {!!Html::script('bower_components/materialize/bin/materialize.js')!!}
  {!!Html::script('bower_components/angular/angular.min.js')!!}
  {!!Html::script('bower_components/angular-materialize/src/angular-materialize.js')!!}
  {!!Html::script('bower_components/angular-route/angular-route.min.js')!!}
  {!!Html::script('bower_components/angular-sanitize/angular-sanitize.min.js')!!}
  {!!Html::script('bower_components/angular-cookies/angular-cookies.min.js')!!}
  {!!Html::script('bower_components/wow.js/dist/wow.min.js')!!}
   @yield('js')
</html>
