@extends('layouts.panel-master')
{!!Html::style('styles/import.min.css')!!}

@section('content')


RESULTS
             
                
@endsection


@section('js')

  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/city-list/controller.js')!!}

@stop
