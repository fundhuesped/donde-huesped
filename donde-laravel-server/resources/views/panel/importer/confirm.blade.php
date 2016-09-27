@extends('layouts.panel-master')
{!!Html::style('styles/import.min.css')!!}
{!!Html::style('bower_components/materialize/bin/materialize.css')!!}
{!!Html::script('bower_components/materialize/bin/materialize.js')!!}

@section('content')


<a>Confirmación</a>

<div class="container">

	<h2>
		Filtrado de búsqueda realizado
	</h2>

	<div class="row">
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Repetidos () </th>
			</thead>
			<tbody>
				<td class="text-center"> dato </td>
			</tbody>
			<tbody>
				<td class="text-center"> <em>No se encontraron datos repetidos en su dataset.</em> </td>
			</tbody>

		</table>
	</div>
	<br><br>


	<div class="row">
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Incompletos () </th>
			</thead>

			<tbody>
				<td class="text-center"> dato </td>
			</tbody>

			<tbody>
				<td class="text-center"> <em>No se encontraron datos incompletos en su dataset.</em> </td>
			</tbody>

		</table>
	</div>
<br><br>

	<div class="row">
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Unificar () </th>
			</thead>
			<tbody>
				<td class="text-center"> dato </td>
			</tbody>

			<tbody>
				<td class="text-center"> <em>No se encontraron datos a unificar en su dataset.</em> </td>
			</tbody>

		</table>
	</div>
<br><br>

	<div class="row">
		<table class="striped">
			<thead>
				<th class="text-center"> <i class="mdi-navigation-arrow-drop-down"></i> Baja Confianza () </th>
			</thead>
			<tbody>
				<td class="text-center"> dato </td>
			</tbody>
			<tbody>
				<td class="text-center"> <em>No se encontraron datos de baja confianza en su dataset.</em> </td>
			</tbody>

		</table>
	</div>
	<br>



<div class="row">
	<div class="col s6">
		<a href="{{ url('panel/importer') }}" class="waves-effect waves-light btn" style="margin-bottom: 5%;">Cancelar</a>
	</div>

	<div class="col s6">
		<a href="{{ url('panel/importer/') }}" class="waves-effect waves-light btn green">Confirmar</a>
	</div>
</div>

	<br>
	<br>

</div>


@endsection


@section('js')

{!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
{!!Html::script('scripts/panel/app.js')!!}
{!!Html::script('scripts/panel/controllers/city-list/controller.js')!!}

@stop