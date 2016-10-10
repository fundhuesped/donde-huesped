@extends('layouts.panel-master')
{!!Html::style('styles/import.min.css')!!}
{!!Html::style('bower_components/materialize/bin/materialize.css')!!}
{!!Html::script('bower_components/materialize/bin/materialize.js')!!}


@section('content')
<br>


<div class="row">
            <div class="col s12">
                <h5 class="titulo">
                    Seleccione archivo a importar (.csv)
                </h5>
            </div>      
        </div>      

            {!!Form::open(['url'=>'panel/importer/preview', 'method'=>'POST','files'=>true])!!}
                <div class="container centrada">
                    <div class="row centrada">    
                        <div class="col s12">
                            {!!Form::file('file')!!}
                        </div>
                    </div>
                    <div class="row centrada">  
                        <div class="col s12">
                            {!!Form::submit('Siguiente',['class'=>'btn','id'=>'submit'])!!}
                        </div>
                    </div>
                </div>

            {!!Form::close()!!}
            {{-- <button id="jona">adsad</button> --}}


@endsection


@section('js')
{{-- <script>
$(function () {
    
    $("#jona").click(function(){
    if ($('input[type=file]')[0].files[0])
            var msg =  $('input[type=file]')[0].files[0].name; 
    else 
            var msg =  'nulo';

        alert(msg);
    });

});
</script>
 --}}
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/city-list/controller.js')!!}

@stop
