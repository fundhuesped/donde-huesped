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
    <div class="col s12 m12 ">
      <h3 ng-cloak ng-hide="loadingPrev"> Existen [[cities.length]] localidades activas </h3>
      <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPrev">
                <th data-field="nombre">Localidad</th>
                <th data-field="nombre">Provincia</th>
                <th data-field="nombre">Oculta</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-cloak ng-hide="loadingPrev" ng-repeat="city in cities">
                <td>[[city.nombre_localidad]]</td>
                <td>[[city.nombre_provincia]]</td>
                <td>
                  <input  type="checkbox" name="hidden" class="filled-in" id="filled-in-box-[[city.id]]" ng-model="city.hidden"/>
                  <label for="filled-in-box-[[city.id]]" ng-click="updateHidden([[city.id]],[[city.hidden]])"></label>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
@stop

@section('js')

  {!!Html::script('libs/trabex-genosha-geolibs.js')!!}
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('angular/apps/panel/app.js')!!}
  {!!Html::script('angular/apps/panel/controllers/city-list/controller.js')!!}

@stop
