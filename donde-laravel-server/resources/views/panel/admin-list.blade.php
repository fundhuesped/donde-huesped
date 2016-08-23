@extends('layouts.panel-master')

@section('content')
  <div class="home panel" ng-controller="adminListController">
    <div class="row">
    <div class="col s12 m3">
      <p></p>
    </div>
    <div class="col s12 m6 ">
      <a target="_self" class="waves-effect waves-light btn btn-large full"
      ng-href="../auth/register">
      <i class="left mdi-content-add-box"></i>
       Agregar  Adminstrador</a>
    </div>
  </div>
  <div class="section navigate row">
    <h3 ng-cloak ng-show="loadingPrev"> Cargando administradores de plataforma ...</h3>
  </div>
  <div class="section copy row">
    <div class="col s12 m12 ">
      <h3 ng-cloak ng-hide="loadingPrev"> Existen [[admins.length]] administradores activos </h3>
      <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPrev">
                <th data-field="nombre">Nombre</th>
                <th data-field="nombre_localidad">E-mail</th>
            </tr>
          </thead>
          <tbody>
              <tr ng-cloak ng-hide="loadingPrev" ng-repeat="admin in admins">
                  <td>[[admin.name]]</td>
                  <td>[[admin.email]]</td>
              </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
@stop

@section('js')

 {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
  

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/admin-list/controller.js')!!}

@stop
