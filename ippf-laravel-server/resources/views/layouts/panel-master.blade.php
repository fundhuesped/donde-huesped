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

      <ul class="right hide-on-med-and-down">
           <li><a  href=" {{ URL::to('/panel') }}"><i class="mdi-action-home"></i></a></li>
           <li><a href=" {{ URL::to('/panel/importer') }}"><i class="mdi-communication-import-export"></i></a>  </li>
           <li><a href=" {{ URL::to('/panel/city-list') }}"><i class="mdi-maps-place left"></i></a></li>
           <li><a href=" {{ URL::to('/panel/admin-list') }}"><i class="mdi-action-accessibility"></i></a></li>
      </ul>

    </div>
  </nav>


   <div class="row">
      <div class="container">
        @yield('content')
      </div>
    </div>
  </main>

  {{-- <script src="https://maps.google.com/maps/api/js"></script> --}}
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
  {!!Html::script('scripts/translations/es.js')!!}
  {!!Html::script('scripts/translations/br.js')!!}
  {!!Html::script('scripts/translations/en.js')!!}

  @yield('js')
  @include('analytics')

</body>
{!!Html::script('scripts/home/services/copy.js')!!}
</html>
