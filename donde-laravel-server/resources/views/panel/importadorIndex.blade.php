@extends('layouts.panel-master')

@section('content')


{!!Form::open(['url'=>'/api/geocode', 'method'=>'POST'])!!}
    <div class="panel-body">
        <div class="form-group">
            {!!Form::label('File','FILE:')!!}
            {!!Form::text('address')!!}
        </div>
    <div  layout="row" layout-align="center center">


    	{!!Form::submit('Geocode',['class'=>'btn btn-primary'])!!}
    </div>

    </div>
{!!Form::close()!!}
</div>
<!-- 
<div class="home">
	<div class="section search search-form row">
	<h1>IMPORTADOR</h1>
	<p>Seleccione Opcion a realizar.</p>


	{!!Form::open(['url'=>'/api/geocode', 'method'=>'POST'])!!}    
	    <div class="row">
	        <div class="input-field col s12">
	            <label for="nombre">Nombre del Establecimiento</label>
	        </div>
	    </div>
	{!!Form::close()!!}
</div>
</div> -->
<br>

<div class="home">
	<!-- <div class="section search search-form row"> -->
	<div class="container">
		<p>Seleccione Opción.</p>
	</div>
</div>

<div class="container ">
	<div class="section search search-form row">

	<div class="row col s12 center">
		<a class="waves-effect waves-light btn-large red">Importar</a>
	</div>
	
	<br>
	<br>
<br>

	<div class="row col s12 center">
		<a class="waves-effect waves-light btn-large red">Exportar</a>
	</div>
	
</div>
</div>
<br>

                



                
@endsection


@section('js')

  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/city-list/controller.js')!!}

@stop
