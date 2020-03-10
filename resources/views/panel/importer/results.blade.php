@extends('layouts.panel-import-master')
{!!Html::style('styles/import.min.css')!!}
<style type="text/css">
	.text-center{
		text-align: center;
	}
</style>

@section('content')

<a>Resultados finales del proceso de importación</a>

<div class="container centrada">

	@if(count($datosNuevos) > 0 || count($datosUnificar) > 0 || count($datosActualizar) > 0)
	<h3 class="mt-3">Estos son los centros que fueron importados</h3>
	@endif

	@if(count($datosNuevos) > 0)
	<h4 class="left-align mt-3"><i class="mdi-navigation-arrow-drop-down"></i><b>Nuevos ({{count($datosNuevos)}})</b></h4>
	@include('panel.importer.places-table',['datos' => $datosNuevos])
	<div class="row">
		<div class="col s3 offset-s10">
			<a href="{{ url('panel/importer/nuevo') }}" class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a>
		</div>
	</div>
	@endif

	@if(count($datosUnificar) > 0)
	<h4 class="left-align mt-3"><i class="mdi-navigation-arrow-drop-down"></i><b>Unificados ({{count($datosUnificar)}})</b></h4>
	@include('panel.importer.places-table',['datos' => $datosUnificar])
	    <div class="row">
	      <div class="col s3 offset-s10">
	      	<a href="{{ url('panel/importer/unificar') }}"  class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a>
	      </div>
	    </div>
	@endif

	@if(count($datosActualizar) > 0)
	<h4 class="left-align mt-3"><i class="mdi-navigation-arrow-drop-down"></i><b>Actualizar ({{count($datosActualizar)}})</b></h4>
	@include('panel.importer.places-table',['datos' => $datosActualizar])
	    <div class="row">
	      <div class="col s3 offset-s10">
	      	<a href="{{ url('panel/importer/actualizar') }}"  class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a>
	      </div>
	    </div>
	@endif

	@if(count($datosRepetidos) > 0 || count($datosIncompletos) > 0 || count($datosDescartados) > 0)
	<h3 class="mt-3">Estos son los centros que NO fueron importados</h3>
	@endif

    @if(count($datosRepetidos) > 0)
	<h4 class="left-align mt-3"><i class="mdi-navigation-arrow-drop-down"></i><b>Repetidos ({{count($datosRepetidos)}})</b></h4>
	@include('panel.importer.places-table',['datos' => $datosRepetidos])
	    <div class="row">
	      <div class="col s3 offset-s10">
	      	<a href="{{ url('panel/importer/repetido') }}"  class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a>
	      </div>
	    </div>
	@endif

	@if(count($datosIncompletos) > 0)
	<h4 class="left-align mt-3"><i class="mdi-navigation-arrow-drop-down"></i><b>Incompletos ({{count($datosIncompletos)}})</b></h4>
	@include('panel.importer.places-table',['datos' => $datosIncompletos])
	    <div class="row">
	      <div class="col s3 offset-s10">
	      	<a href="{{ url('panel/importer/incompleto') }}"  class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a>
	      </div>
	    </div>
	@endif

	@if(count($datosDescartados) > 0)
	<h4 class="left-align mt-3"><i class="mdi-navigation-arrow-drop-down"></i><b>Baja Confianza ({{count($datosDescartados)}})</b></h4>
	@include('panel.importer.places-table',['datos' => $datosDescartados])
	    <div class="row">
	      <div class="col s3 offset-s10">
	      	<a href="{{ url('panel/importer/bc') }}"  class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a>
	      </div>
	    </div>
	@endif

</div>

<div class="row mt-3">
	<div class="col s6">
		<a href="{{ url('panel/importer') }}" class="waves-effect waves-light btn">Volver al importador</a>
	</div>

	<div class="col s6">
		<a href="{{ url('panel') }}" class="waves-effect waves-light btn" style="margin-bottom: 5%;">Volver al panel </a>
	</div>
</div>

@endsection

@section('js')

@stop
