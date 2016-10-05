<?php
session()->forget('datosNuevos');
session()->forget('datosRepetidos');
session()->forget('datosIncompletos');
session()->forget('datosUnificar');
session()->forget('datosDescartados');
?>
@extends('layouts.panel-master')

@section('content')
{{-- {!!Html::style('styles/import.min.css')!!} --}}
<br>
<br>
	<div class="container">
		<h4>Seleccione Opción </h4>
	</div>
<br>

<div class="container ">
	<div class="section search search-form row">

	<div class="row col s6 offset-s3">
		<a href="{{ url('panel/importer/export') }}" class="waves-effect waves-light btn">DESCARGAR DATASET</a>
	</div>
	
	<br>
	<br>
	<br>
	
	<div class="row col s6  offset-s3">
		<a href="{{ url('panel/importer/picker') }}" class="waves-effect waves-light btn">IMPORTAR DATASET</a>
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
