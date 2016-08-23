<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Ultra' rel='stylesheet' type='text/css'>
    
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    {!!Html::style('bower_components/materialize/bin/materialize.css')!!}
    {!!Html::style('bower_components/wow.js/css/libs/animate.css')!!}
    {!!Html::style('styles/main.min.css')!!}
    <!-- Icons -->
  <link rel='shortcut icon' href='https://www.huesped.org.ar/testimonios/assets/img/favicon.png'>
    
    
</head>
<body ng-app="dondev2App">
  <main>
    <nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo"></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse">
        <i class="mdi-navigation-menu"></i></a>
      <ul class="right hide-on-med-and-down">
           <li><a class="modal-trigger" href="#modal1"><i class="mdi-action-info"></i></a></li>
           <li><a class="modal-trigger" href="#/localizar/test/listado"><i class="mdi-maps-place left"></i></a></li>
           <li><a class="" href="/#/"><i class="mdi-action-search"></i></a></li>
          
      </ul>
      <ul ng-cloak ng-show="navigating"  class="left wow fadeIn">
           <li><a href="" onclick="window.history.back();"><i class="mdi-navigation-chevron-left right"></i></a></li>
      </ul>
      
      <ul class="side-nav" id="mobile-demo">
           <li><a href="/#/acerca">
            <i class="mdi-action-info left"></i>Información</a></li>
          <li><a href="#/localizar/test/listado">
            <i class="mdi-maps-place left"></i>¿Que hay cerca?</a></li>
          <li><a href="/#/agregar">
            <i class="mdi-action-add left"></i>Agregar un centro</a></li>
            
      </ul>
    </div>
  </nav>


   <div class="row">
      <div class="container">
        @yield('content')
      </div>
    </div>
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
