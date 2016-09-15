@extends('layouts.clear')

@section('content')
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Seleccione archivo .csv</div>
                <div>
                {!!Form::open(['route'=>'importador.store', 'method'=>'POST','files'=>true])!!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col s12">
                                {!!Form::label('File','FILE:')!!}
                            </div>
                            <div class="col s12">
                                {!!Form::file('file')!!}
                            </div>
                        </div>
                        <div class="col s2">
                            {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}
                        </div>
                    </div>
                {!!Form::close()!!}
                </div>
                
            </div>
        </div>
    </div>
</div>

    <!-- <div>
        {!!Form::open(['url'=>'/api/geocode', 'method'=>'POST'])!!}
            <div class="panel-body">
                <div class="form-group">
                    {!!Form::label('File','FILE:')!!}
                    {!!Form::text('address')!!}
                </div>
            {!!Form::submit('Importar',['class'=>'btn btn-primary'])!!}
            </div>
        {!!Form::close()!!}
        </div>
 -->

<!-- <div class="home" ng-controller="formController">
  <div class="section search search-form row">
      <h1>IMPORTADOR</h1>
        <p>Seleccione Opcion a realizar.</p>
        <form class="col s12 m6">
        {!!Form::open(['url'=>'/api/geocode', 'method'=>'POST'])!!}    
            <div class="row">
                <div class="input-field col s12">
                    <label for="nombre">Nombre del Establecimiento</label>
                </div>
            </div>
        
        </form>

 -->



                
@endsection
