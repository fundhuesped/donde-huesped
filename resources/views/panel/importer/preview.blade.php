@extends('layouts.panel-import-master')

{!!Html::style('styles/import.min.css')!!}

<style type="text/css">
	.new-location{
		font-weight: bold;
	}
</style>

@section('content')

<h4>Previsualización</h4>

<div class="home full">
	<div class="container centrada">
		<p align="left"> <em>Datos nuevos referidos a localidades dentro del archivo a importar</em> </p>
	</div>
</div>

@if (count($nuevosPaises) == 0 )
	<p class="centrada">No se registran nuevos paises.</p>
@elseif ( (count($nuevosPaises) > 0 ) && (count($nuevosPaises) < 2 ) )
	Usted está a punto de crear el siguiente País
@else
	Usted está a punto de crear los siguientes Países
@endif
<div class="container">	
	<div >
		<table class="striped">
			<thead>
				<th class="text-center"><i class="mdi-navigation-arrow-drop-down"></i> Paises ({{count($nuevosPaises)}})</th>
			</thead>
			<tbody>
			@if (count($nuevosPaises) > 0 )
			@foreach ($nuevosPaises as $pais)
			<tr>
				<td class="text-center new-location"> {{$pais['Pais']}} </td>
			</tr>
			@endforeach
			@else
				<td class="text-center"> <em>No se encontraron nuevos paises en su dataset.</em> </td>
			@endif
			</tbody>
		</table>
	</div>
</div>
<br>

@if (count($nuevosProvincias) == 0 )
	<p class="centrada">No se registran nuevas provincias.</p>
@elseif ( (count($nuevosProvincias) > 0 ) && (count($nuevosProvincias) < 2 ) )
	<p class="centrada">Usted está a punto de crear la siguiente provincia</p>
@else
	<p class="centrada">Usted está a punto de crear las siguientes provincia</p>
@endif

<div class="container">	
	<div>
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Provincias ({{count($nuevosProvincias)}})</th>
				<th class="text-center"><i class="mdi-navigation-arrow-drop-down"></i> Pais </th>
			</thead>
			<tbody>
			@if (count($nuevosProvincias) > 0 )
			@foreach ($nuevosProvincias as $provincia)
			<tr>
				<td class="text-center new-location"> {{$provincia['Provincia']}} </td>
				<td class="text-center"> {{$provincia['Pais']}} </td>
			</tr>
			@endforeach
			@else
				<td class="text-center"> <em>No se encontraron nuevas provincias en su dataset.</em> </td>
				<td class="text-center">  </td>
			@endif
			</tbody>			
		</table>
	</div>
</div>		
<br>

@if (count($nuevosPartidos) == 0 )
	<p class="centrada">No se registran nuevos partidos.</p>
@elseif ( (count($nuevosPartidos) > 0 ) && (count($nuevosPartidos) < 2 ) )
	<p class="centrada">Usted está a punto de crear el siguiente partido.</p>
@else
	<p class="centrada">Usted está a punto de crear los siguientes partidos.</p>
@endif

<div class="container">	
	<div>
		<table class="striped">
			<thead>
				<th class="text-center"><i class="mdi-navigation-arrow-drop-down"></i> Partido ({{count($nuevosPartidos)}}) </th>
				<th class="text-center"><i class="mdi-navigation-arrow-drop-down"></i> Provincia </th>
				<th class="text-center"><i class="mdi-navigation-arrow-drop-down"></i> Pais </th>
			</thead>
			<tbody>
			@if (count($nuevosPartidos) > 0 )
			@foreach ($nuevosPartidos as $partido)
			<tr>
				<td class="text-center new-location">{{$partido['Partido']}} </td>
				<td class="text-center">{{$partido['Provincia']}} </td> 
				<td class="text-center">{{$partido['Pais']}} </td>
			</tr>
			@endforeach
			@else
				<td class="text-center"> <em>No se encontraron nuevos partidos en su dataset.</em> </td>
				<td class="text-center">  </td>
				<td class="text-center">  </td>
			@endif
			</tbody>
		</table>
	</div>
</div>
<br>

@if (count($nuevosCiudades) == 0 )
	<p class="centrada">No se registran nuevas ciudades.</p>
@elseif ( (count($nuevosCiudades) > 0 ) && (count($nuevosCiudades) < 2 ) )
	<p class="centrada">Usted está a punto de crear la siguiente ciudad.</p>
@else
	<p class="centrada">Usted está a punto de crear las siguientes ciudades.</p>
@endif

<div class="container">	
	<div>
		<table class="striped">
			<thead>
				<th class="text-center"><i class="mdi-navigation-arrow-drop-down"></i> Ciudad ({{count($nuevosCiudades)}}) </th>
				<th class="text-center"><i class="mdi-navigation-arrow-drop-down"></i> Partido </th>
				<th class="text-center"><i class="mdi-navigation-arrow-drop-down"></i> Provincia </th>
				<th class="text-center"><i class="mdi-navigation-arrow-drop-down"></i> Pais </th>
			</thead>
			<tbody>
			@if (count($nuevosCiudades) > 0 )
			@foreach ($nuevosCiudades as $ciudad)
			<tr>
				<td class="text-center new-location">{{$ciudad['Ciudad']}} </td>
				<td class="text-center">{{$ciudad['Partido']}} </td>
				<td class="text-center">{{$ciudad['Provincia']}} </td> 
				<td class="text-center">{{$ciudad['Pais']}} </td>
			</tr>
			@endforeach
			@else
				<td class="text-center"> <em>No se encontraron nuevas ciudades en su dataset.</em> </td>
				<td class="text-center">  </td>
				<td class="text-center">  </td>
				<td class="text-center">  </td>
			@endif
			</tbody>
		</table>
	</div>
</div>

<div class="container ">
	<div class="section search search-form row">
		<div class="row col s12 center">
			{!!Form::open(['url'=>['panel/importer/confirm'],'method'=>'POST'] )!!}
			<div class="col-md-4">
				{!!Form::hidden('fileName', $nombreFile)!!}

				{!!Form::button('ACEPTAR',
				array('type' => 'submit', 'class' => 'waves-effect waves-light btn green')) !!}

				<a href="{{ url('panel/importer') }}" class="waves-effect waves-light btn">Volver al importador</a>
			</div>
			{!! Form::close()!!}

		</div>

		<br>
		<br>
		<br>

	</div>
</div>

@endsection

@section('js')

@stop
