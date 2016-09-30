<?php
session()->forget('datosNuevos');
session()->forget('datosRepetidos');
session()->forget('datosIncompletos');
session()->forget('datosUnificar');
session()->forget('datosDescartados');

?>
@extends('layouts.panel-master')
{!!Html::style('styles/import.min.css')!!}
{!!Html::style('bower_components/materialize/bin/materialize.css')!!}
{!!Html::script('bower_components/materialize/bin/materialize.js')!!}

@section('content')
{{-- @foreach(Session::get('PreNuevos') as $array)
	@foreach ($array as $p  => $value)
		{{$p}} - {{$value}}
		<br>
	@endforeach
@endforeach    
 --}}
<a>RESULTS</a>

<div class="container">

	<h2>
		Resultados de la importación
	</h2>


		<div class="row">
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Nuevos ({{$cantidadNuevos}}) </th>
			</thead>
			@if (count($datosNuevos) > 0 )
			@foreach ($datosNuevos as $p)
			<tbody>
				<td class="text-center"> {{$p['establecimiento']}} </td>
				<td class="text-center"> {{$p['calle']}} </td>
				<td class="text-center"> {{$p['altura']}} </td>
				<td class="text-center"> {{$p['pais']}} </td>
				<td class="text-center"> {{$p['provincia_region']}} </td>
				<td class="text-center"> {{$p['partido_comuna']}} </td>
				<td class="text-center"> {{$p['tipo']}} </td>
			</tbody>
			@endforeach
			@else
			<tbody>
				<td class="text-center"> <em>No se encontraron datos nuevos en su dataset.</em> </td>
			</tbody>
			@endif
		</table>
	</div>
	 {{-- ========================================================================= --}}
    <br>
    @if (count($datosNuevos) > 0 )
    <div class="row">
      <div class="col s3 offset-s10"><a href="{{ url('panel/importer/nuevo') }}"  class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a></div>
    </div>
    @endif
             {{-- ========================================================================= --}}
	<br><br>

	<div class="row">
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Repetidos ({{$cantidadRepetidos}}) </th>
			</thead>
			@if (count($datosRepetidos) > 0 )
			@foreach ($datosRepetidos as $p)
			<tbody>
				<td class="text-center"> {{$p['establecimiento']}} </td>
				<td class="text-center"> {{$p['calle']}} </td>
				<td class="text-center"> {{$p['altura']}} </td>
				<td class="text-center"> {{$p['pais']}} </td>
				<td class="text-center"> {{$p['provincia_region']}} </td>
				<td class="text-center"> {{$p['partido_comuna']}} </td>
				<td class="text-center"> {{$p['tipo']}} </td>
			</tbody>
			@endforeach
			@else
			<tbody>
				<td class="text-center"> <em>No se encontraron datos repetidos en su dataset.</em> </td>
			</tbody>
			@endif
		</table>
	</div>
	        {{-- ========================================================================= --}}
    <br>
    @if (count($datosRepetidos) > 0 )
	    <div class="row">
	      <div class="col s3 offset-s10"><a href="{{ url('panel/importer/repetido') }}"  class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a></div>
	    </div>
	@endif
             {{-- ========================================================================= --}}
	<br><br>


	<div class="row">
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Incompletos ({{$cantidadIncompletos}}) </th>
			</thead>
			@if (count($datosIncompletos) > 0 )
			@foreach ($datosIncompletos as $p)
			<tbody>
				<td class="text-center"> {{$p['establecimiento']}} </td>
				<td class="text-center"> {{$p['calle']}} </td>
				<td class="text-center"> {{$p['altura']}} </td>
				<td class="text-center"> {{$p['pais']}} </td>
				<td class="text-center"> {{$p['provincia_region']}} </td>
				<td class="text-center"> {{$p['partido_comuna']}} </td>
				<td class="text-center"> {{$p['tipo']}} </td>
			</tbody>
			@endforeach
			@else
			<tbody>
				<td class="text-center"> <em>No se encontraron datos incompletos en su dataset.</em> </td>
			</tbody>
			@endif
		</table>
	</div>
	{{-- ========================================================================= --}}
    <br>
    @if (count($datosIncompletos) > 0 )
    <div class="row">
    	<div class="col s3 offset-s10"><a href="{{ url('panel/importer/incompleto') }}"  class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a></div>
    </div>
    @endif
             {{-- ========================================================================= --}}
<br><br>

	<div class="row">
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Unificar ({{$cantidadUnificar}}) </th>
			</thead>
			@if (count($datosUnificar) > 0 )
			@foreach ($datosUnificar as $p)
			<tbody>
				<td class="text-center"> {{$p['establecimiento']}} </td>
				<td class="text-center"> {{$p['calle']}} </td>
				<td class="text-center"> {{$p['altura']}} </td>
				<td class="text-center"> {{$p['pais']}} </td>
				<td class="text-center"> {{$p['provincia_region']}} </td>
				<td class="text-center"> {{$p['partido_comuna']}} </td>
				<td class="text-center"> {{$p['tipo']}} </td>
			</tbody>
			@endforeach
			@else
			<tbody>
				<td class="text-center"> <em>No se encontraron datos a unificar en su dataset.</em> </td>
			</tbody>
			@endif
		</table>
	</div>
	 {{-- ========================================================================= --}}
    <br>
    @if (count($datosRepetidos) > 0 )
    <div class="row">
    	<div class="col s3 offset-s10"><a href="{{ url('panel/importer/unificar') }}"  class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a></div>
    </div>
    @endif
    {{-- ========================================================================= --}}
<br><br>

	<div class="row">
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Baja Confianza ({{$cantidadDescartados}}) </th>
			</thead>
			@if (count($datosDescartados) > 0 )
			@foreach ($datosDescartados as $p)
			<tbody>
				<td class="text-center"> {{$p['establecimiento']}} </td>
				<td class="text-center"> {{$p['calle']}} </td>
				<td class="text-center"> {{$p['altura']}} </td>
				<td class="text-center"> {{$p['pais']}} </td>
				<td class="text-center"> {{$p['provincia_region']}} </td>
				<td class="text-center"> {{$p['partido_comuna']}} </td>
				<td class="text-center"> {{$p['tipo']}} </td>
			</tbody>
			@endforeach
			@else
			<tbody>
				<td class="text-center"> <em>No se encontraron datos de baja confianza en su dataset.</em> </td>
				<td class="text-center"> </td>
			</tbody>
			@endif
		</table>
	</div>
	 {{-- ========================================================================= --}}
    <br>
 @if (count($datosDescartados) > 0 )
    <div class="row">
      <div class="col s3 offset-s10"><a href="{{ url('panel/importer/bc')}}" class="waves-effect waves-light btn-floating"><i class="mdi-action-get-app"></i></a>
      </div>
    </div>
@endif
             {{-- ========================================================================= --}}


	<br>
	<br>
	<br>

</div>
<div class="container ">
	<div class="col s12">

		<div class="row col s12 center">
			<a href="{{ url('panel/importer') }}" class="waves-effect waves-light btn">Volver al importador</a>
		</div>

		<br>
		<br>
		<br>

		<div class="row col s12 center">
		<a href="{{ url('panel') }}" class="waves-effect waves-light btn" style="margin-bottom: 5%;">Volver al panel </a>
		</div>

	</div>
</div>	



		<br>
		<br>
		<br>

@endsection


@section('js')

{!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
{!!Html::script('scripts/panel/app.js')!!}
{!!Html::script('scripts/panel/controllers/city-list/controller.js')!!}

@stop