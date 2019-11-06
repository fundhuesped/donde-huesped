<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>donde.huesped.org.ar | Fundación Huésped</title>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Ultra' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    {!!Html::style('bower_components/materialize/bin/materialize.css')!!}
    {!!Html::style('bower_components/wow.js/css/libs/animate.css')!!}
    {!!Html::style('styles/main.min.css')!!}
</head>
<body ng-app="dondev2App">
  <main>
    <nav>
      <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down">
         <li class="tooltipped" 
          data-position="bottom" data-tooltip="Panel"><a  href=" {{ URL::to('/panel') }}" value="Actualizar" onclick="location.reload()"><i class="mdi-action-home"></i></a></li>
         <li class="tooltipped" 
          data-position="bottom" data-tooltip="Importador"><a href=" {{ URL::to('/panel/importer') }}"><i class="mdi-communication-import-export"></i></a>  </li>
         <li class="tooltipped" 
          data-position="bottom" data-tooltip="Localidades y Provincias"><a href=" {{ URL::to('/panel/city-list') }}"><i class="mdi-maps-place left"></i></a></li>
         <li class="tooltipped" 
          data-position="bottom" data-tooltip="Usuarios"><a href=" {{ URL::to('/panel/admin-list') }}"><i class="mdi-action-accessibility"></i></a></li>
          <li class="tooltipped" 
          data-position="bottom" data-tooltip="Cerrar Sesión"><a href=" {{ URL::to('admin/logout') }}"><i class="mdi-content-backspace"></i></a></li>
          
      </ul>
      </div>
    </nav>
    <div class="row">
      <div class=" home new-home">
        @yield('content')
      </div>
    </div>
  </main>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyBoXKGMHwhiMfdCqGsa6BPBuX43L-2Fwqs"></script>
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
  {!!Html::script('bower_components/angular-translate/angular-translate.js')!!}
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
  {!!Html::script('scripts/translations/es.js')!!}
  {!!Html::script('scripts/translations/br.js')!!}
  {!!Html::script('scripts/translations/en.js')!!}
  {!!Html::script('scripts/panel/app.js')!!}
  <script>
  $(document).ready(function() {
     $('select').material_select();
   });
  </script>

  @yield('js')
  @include('analytics')

</body>

</html>
