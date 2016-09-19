<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href='https://fonts.googleapis.com/css?family=Ultra' rel='stylesheet' type='text/css'> -->
    
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> -->
    {!!Html::style('bower_components/materialize/bin/materialize.css')!!}
    {!!Html::style('bower_components/wow.js/css/libs/animate.css')!!}

    {!!Html::style('styles/import.min.css')!!}
    <!-- Icons -->
  <link rel='shortcut icon' href='https://www.huesped.org.ar/testimonios/assets/img/favicon.png'>
    
    
</head>
<!-- <body ng-app="dondev2App"> -->
<body>
  <main>
    <nav>
    <div class="nav-wrapper">
      
      <ul class="right hide-on-med-and-down">
           <li><a  href=" {{ URL::to('/panel') }}"><i class="mdi-action-home"></i></a></li>
           <li><a href=" {{ URL::to('/panel/city-list') }}"><i class="mdi-maps-place left"></i></a></li>
           <li><a href=" {{ URL::to('/panel/admin-list') }}"><i class="mdi-action-accessibility"></i></a></li>

          
      </ul>
     
     
    </div>
  </nav>


   <div class="row">
      <div class="container">
        @yield('content')
        <div class="row">
            <div class="col s12">
                <h5 class="titulo">
                    Seleccione archivo a importar (.csv)
                </h5>
            </div>      
        </div>      

            {!!Form::open(['url'=>'panel/importer/preview', 'method'=>'POST','files'=>true])!!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col s12">
                            {!!Form::label('file','FILE:')!!}
                        </div>
                    </div>
                        
                    <div class="row">    
                        <div class="col s12">
                            {!!Form::file('file')!!}
                        </div>
                    </div>
                    <div class="row">  
                        <div class="col s12">
                            {!!Form::submit('Siguiente',['class'=>'btn'])!!}
                        </div>
                    </div>
                </div>
            {!!Form::close()!!}


        </div>
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
  <!-- @include('analytics') -->

</body>
</html>
