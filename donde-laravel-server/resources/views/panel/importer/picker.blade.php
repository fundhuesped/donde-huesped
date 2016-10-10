@extends('layouts.panel-master')
{!!Html::style('styles/import.min.css')!!}
{!!Html::style('bower_components/materialize/bin/materialize.css')!!}
{!!Html::script('bower_components/materialize/bin/materialize.js')!!}


@section('content')
            <div class="row">
                <div class="col s12 centrada">
                    <h5 class="titulo">
                        Seleccione archivo a importar (.csv)
                    </h5>
                </div>      
            </div>      

            {!!Form::open(['url'=>'panel/importer/preview', 'method'=>'POST','files'=>true])!!}
                <div class="container centrada">
                    <div class="row">    
                        <div class="col s12 centrada">
                            {!!Form::file('file')!!}
                        </div>
                    </div>
                    <div class="col s12 centrada">  
                        <div class="col s7 offset-s2">
                            {!!Form::submit('Siguiente',['class'=>'btn','id'=>'submit'])!!}
                        </div>`
                    </div>
                </div>

            {!!Form::close()!!}

@endsection


@section('js')

  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/city-list/controller.js')!!}

@stop
