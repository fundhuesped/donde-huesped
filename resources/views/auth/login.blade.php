@extends('layouts.panel-master')

@section('content')

  <div class="home">
  <div class="section navigate">
      <div class="container">
        <div clas="row">
        <div class="col s12 l4">
        <form method="POST" action="login">
            {!! csrf_field() !!}

            <div>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                Password
                <input type="password" name="password" id="password">
            </div>

            <div>
              <div class="row">
                <div class="valign-demo  valign-wrapper">
                  <div class="valign full-width actions">
                    <button class="waves-effect waves-light btn btn-large full" 
                    type="submit"><i class="mdi-action-perm-identity left"></i>Ingresar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      </div>
  </div>
  
</div>
@stop


@section('js')
 {!!Html::script('bower_components/materialize/dist/js/materialize.min.js')!!}  
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}  
 
@stop


