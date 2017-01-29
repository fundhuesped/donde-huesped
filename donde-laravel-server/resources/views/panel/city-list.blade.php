@extends('layouts.panel-master')

@section('content')
  <div class="home panel" ng-controller="cityListController">
    <div class="row">
    <!-- <div class="col s12 m6 ">
      <a target="_self" class="waves-effect waves-light btn btn-large full"
      ng-href="auth/register">
      <i class="left mdi-content-add-box"></i>
       Agregar  Adminstrador</a>
    </div> -->
  </div>
  <div class="section navigate row">
    <h3 ng-cloak ng-show="loadingPrev"> Cargando ciudades de plataforma ...</h3>
  </div>
  <div class="section copy row">
    <div class="col s12 m12 ">[[cities]]
      <h3 ng-cloak ng-hide="loadingPrev"> Existen [[cities.length]] localidades activas </h3>
      <div ng-cloak ng-show="loadingPrev" class="progress">
                  <div class="indeterminate"></div>
         </div>
         <div ng-cloak ng-show="spinner" class="progress">
                  <div class="indeterminate"></div>
         </div>
      <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak>
                <th data-field="nombre">Partido/Departamento</th>
                <th data-field="nombre">Provincia/Región</th>
                <th data-field="nombre">Pais</th>
                <th data-field="nombre">¿Está Habilitada?</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-cloak ng-hide="loadingPrev" ng-repeat="city in cities">
                <td>[[city.nombre_partido]]</td>
                <td>[[city.nombre_provincia]]</td>
                <td>[[city.nombre_pais]]</td>
                <td>
                  <input  type="checkbox" 
                  name="habilitado" class="filled-in" 
                  id="filled-in-box-[[city.id]]" 
                  ng-model="city.habilitado"/>
                  <label 
                  for="filled-in-box-[[city.id]]" 
                  ng-click="updateHidden([[city.id]],
                  [[city.habilitado]], [[city.nombre_partido]])"></label>
                </td>
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
  {!!Html::script('scripts/panel/controllers/city-list/controller.js')!!}

@stop
