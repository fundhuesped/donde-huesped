<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Ultra' rel='stylesheet' type='text/css'>

<head>
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1">  
      @yield('meta')

    
    <link rel="stylesheet" href="bower_components/materialize/bin/materialize.css">
    <link rel="stylesheet" href="bower_components/wow.js/css/libs/animate.css"/>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/main.min.css">
    <!-- Icons -->
  <link rel='shortcut icon' href='https://www.huesped.org.ar/testimonios/assets/img/favicon.png'>
    
    
</head>
<body>

        
  <main>
    
  @yield('content')
  </main>
  	
  
  <script src="https://maps.google.com/maps/api/js"></script>
  {!!Html::script('bower_components/jquery/dist/jquery.js')!!}
  {!!Html::script('bower_components/underscore/underscore-min.js')!!}
  {!!Html::script('bower_components/materialize/bin/materialize.js')!!}
  {!!Html::script('bower_components/moment/min/moment-with-locales.min.js')!!}
  {!!Html::script('bower_components/angular/angular.min.js')!!}
  {!!Html::script('bower_components/angular-materialize/src/angular-materialize.js')!!}
  {!!Html::script('bower_components/angular-route/angular-route.min.js')!!}
  {!!Html::script('bower_components/angular-sanitize/angular-sanitize.min.js')!!}
  {!!Html::script('bower_components/angular-cookies/angular-cookies.min.js')!!}
  {!!Html::script('bower_components/wow.js/dist/wow.min.js')!!}

  @yield('js')
  @include('analytics')

</body>
</html>
