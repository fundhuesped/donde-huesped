@extends('layouts.panel-master')

@section('content')

<br>

<div class="home">
	<!-- <div class="section search search-form row"> -->
	<div class="container">
		<h4>Seleccione Opción: </h4>
	</div>
</div>

<div class="container ">
	<div class="section search search-form row">

	<div class="row col s12 center">
		<a href="{{ url('panel/importador/importar') }}" class="waves-effect waves-light btn-large red">Importar</a>
	</div>
	
	<br>
	<br>
<br>

	<div class="row col s12 center">
		<a href="{{ url('panel/importador/exportar') }}" class="waves-effect waves-light btn-large red">Exportar</a>
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
