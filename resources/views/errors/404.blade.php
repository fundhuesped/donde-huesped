@extends('layouts.clear')
@section('meta')
<title>Donde </title>
<meta name="description" content="Donde">
@stop

@section('content')
<div >
  <div class="home no-page valign-demo valign-wrapper">
      <div class="row valign full-width">
        <div class="col s12">
        {!!Html::image("images/, "Logo")!!}
        <h1> Oops... no encontramos lo que buscas. </h1>
      </div>
      <div class="col s4">
        </p>
      </div>
        <div class="col s4">
          <a  href="/" class="waves-effect waves-light btn btn-large full">
                        <i class="mdi-action-home left"></i></a>
        </div>
        <div class="col s4">
        </p>
      </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
 
@stop


@section('js')

@stop
