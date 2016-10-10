<?php
session()->forget('datosNuevos');
session()->forget('datosRepetidos');
session()->forget('datosIncompletos');
session()->forget('datosUnificar');
session()->forget('datosDescartados');
?>
@extends('layouts.panel-master')

@section('content')
{!!Html::style('styles/import.min.css')!!}

<div class="col s12 centrada">
	<div class="container centrada">
		<h4>Seleccione Opción: </h4>
	</div>
</div>

<div class="container centrada">
	<div class="row centrada">
		<div class="row centrada">
			<a href="{{ url('panel/importer/export') }}" class="waves-effect waves-light btn">DESCARGAR DATASET</a>
		</div>

		<div class="row centrada">
			<a href="{{ url('panel/importer/picker') }}" class="waves-effect waves-light btn">IMPORTAR DATASET</a>
		</div>	
	</div>
</div>
                
@endsection


@section('js')

  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/city-list/controller.js')!!}

@stop
