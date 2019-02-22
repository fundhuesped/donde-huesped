@section('meta')
    <title>Fundación Huésped | donde.huesped.org.ar</title>
    <meta name="description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos.">
    <meta name="author" content="DONDE">
    <link rel="canonical" href="https://donde.huesped.org.ar"/>
    <meta property='og:locale' content='es_LA'/>
    <meta property='og:title' content='Fundación Huésped | donde.huesped.org.ar'/>
    <meta property="og:description" content="Conoce dónde hacerte la prueba de VIH y buscar condones gratis. También encuentra los vacunatorios y centros de infectología más cercanos." />
    <meta property='og:url' content='https://donde.huesped.org.ar'/>
    <meta property='og:site_name' content='DONDE'/>
    <meta property='og:type' content='website'/>
    <meta property='og:image' content='https://donde.huesped.org.ar/img/icon/apple-touch-icon-152x152.png'/>
    <meta property='fb:app_id' content='459717130793708' />
    <meta name="twitter:card" content="summary">
    <meta name='twitter:title' content='Fundación Huésped | donde.huesped.org.ar'/>
    <meta name="twitter:description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos." />
    <meta name='twitter:url' content='https://donde.huesped.org.ar'/>
    <meta name='twitter:image' content='https://donde.huesped.org.ar/img/icon/apple-touch-icon-152x152.png'/>
    <meta name='twitter:site' content='@fundhuesped' />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
@stop
@extends('layouts.panel-master')

@section('content')
  <div class="home" ng-controller="usersController">
  <div class="section navigate row">
    <div class="col s12 m3">
      <p> </p>
    </div>
    <div class="col s12 m6">
      <form method="POST" action="register">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <h3> Completá todos los datos para agregar usuaries de panel <strong>#DÓNDE</strong></h3>
         <hr/>
          <div> 
              <h4 class="left"><strong>Nombre</strong></h4>
              <input type="text" name="name" value="{{ old('name') }}" ng-model="newUser.name" required>
              @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
          </div>

          <div>
                      <h4 class="left"><strong>Mail</strong> </h4> @if ($errors->has('email'))
                               <h4 class="left">  <span class="badge red">
                                        <small><strong>{{ $errors->first('email') }}</strong></small>
                                    </span>
                                @endif </h4>
              <input type="email" name="email" value="{{ old('email') }}" ng-model="newUser.email" required>
              
          </div>
          <div>
            <h4 class="left"><strong>Rol</strong> </h4>
            <select name="roll" id="roll" class="rollSelect" ng-model="newUser.roll" material-select watch>
              <option value="administrador" required ng-selected="[[newUser.roll]]">Administrador</option>
              <option value="supervisor" ng-selected="[[newUser.roll]]">Supervisor</option>
            </select>
            <label>Roll</label>
          <div>

          <div> 
              <h4 class="left"><strong>Contraseña</strong><small> (6 caracteres mínimo)</small></h4>
             @if ($errors->has('password'))
                                  <h4 class="left"> <span class="badge red ">
                                        <small><strong>{{ $errors->first('password') }}</strong></small>
                                    </span>
                                @endif </h4> 
              <input type="password" name="password" id="password" ng-model="newUser.password" required>

          </div>

          <div>
             <h4 class="left"> <strong>Confirmá tu Contraseña</strong></h4>
              <input type="password" name="password_confirmation" ng-model="newUser.password_confirmation" required>
          </div>

          <div>
            <div class="row">
              <div class="valign-demo  valign-wrapper">
                <div class="valign full-width actions">
                  <button class="waves-effect waves-light btn btn-large full"
                  type="submit"><i class="mdi-action-done-all left"></i>
                  Agregar</button>
                </div>
              </div>
            </div>
          </div>
</div>
      </form>
  </div>

</div>



@stop


@section('js')

 {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/users/controller.js')!!}

@stop
