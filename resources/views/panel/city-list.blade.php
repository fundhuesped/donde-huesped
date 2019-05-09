@extends('layouts.panel-master')

@section('content')
{{ csrf_field() }}

  <div class="home panel" ng-controller="cityListController">
    <div class="row">
      <div class="col s4">
        <p> </p>
      </div>
      <div class="col s4">
        <h2> Limpieza Automatica </h2>
        <p> Eliminá todos las regiones que no tengan centros con un click </p>
         <div ng-cloak ng-show="spinner" class="progress">
                  <div class="indeterminate"></div>
         </div>
        <div ng-hide="spinner">
        <div class="row"> 
            <div ng-cloak ng-show="loadingCiudades" class="progress">
                  <div class="indeterminate"></div>
         </div>
            <a  href="" ng-hide="loadingCiudades" ng-click="clearCiudades()" class="waves-effect waves-light btn wow animated" style="visibility: visible;">
              <span class="ng-scope">Ciudades</span>
            </a>
          </div>
          <div class="row">
            <div ng-cloak ng-show="loadingPartido" class="progress">
                  <div class="indeterminate"></div>
         </div>
            <a  href="" ng-hide="loadingPartido" ng-click="clearPartidos()" class="waves-effect waves-light btn wow animated green" style="visibility: visible;">
              <span class="ng-scope">Partidos</span>
            </a>
                      </div>
          <div class="row">
            <div ng-cloak ng-show="loadingProvincias" class="progress">
                  <div class="indeterminate"></div>
         </div>
            <a  href="" ng-hide="loadingProvincias" ng-click="clearProvincias()" class="waves-effect waves-light btn wow animated blue" style="visibility: visible;">
              <span class="ng-scope">Provincias</span>
            </a>
                      </div>
          <div class="row">
            <div ng-cloak ng-show="loadingPaises" class="progress">
                  <div class="indeterminate"></div>
         </div>
            <a  href="" ng-hide="loadingPaises"  ng-click="clearPais()" class="waves-effect waves-light btn wow animated black" style="visibility: visible;">
              <span class="ng-scope">Paises</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <br>
      <br>
      <hr/>
      <h3> Busca y Administra Ciudades</h3>


    </div>
  <div class="section navigate row">
    <h2 ng-cloak ng-show="loadingPrev" traslate="panel_places_loadingplaces"> </h2>
  </div>
  <div class="section copy row">
    <div class="col s12 m12 ">
      <p ng-cloak ng-hide="loadingPrev" translate="panel_places_summary" translate-values="{cities:'[[cities.total]]'}"> </p>
    
          <div class="col s10">
         <input type="text" ng-model="search" rol ="search" placeholder="Ingresar una ciudad" />
       </div>
          <div class="col s2">
            <a  href="" ng-click="loadPage()" class="waves-effect waves-light btn wow animated" style="visibility: visible;">
              <span class="ng-scope">Buscar</span>
            </a>
          </div>
          <div class="col s12">
            <div class="row" ng-hide="loadingPrev">
          <div class="col s2" >
            <a  href="" ng-click="previousPage()" class="waves-effect waves-light btn wow animated" style="visibility: visible;">
              <i class="mdi-navigation-chevron-left left"></i>
              <span class="ng-scope">Anterior</span>
            </a>
          </div>

          <div class="col s8"><h4>Página [[ page ]] / [[ pages ]]</h4></div>

          <div class="col s2">
            <a  href="" ng-click="nextPage()" class="waves-effect waves-light btn wow animated" style="visibility: visible;">
              <span class="ng-scope">Siguiente</span>
              <i class="mdi-navigation-chevron-right right"></i>
            </a>
          </div>
        </div>
          </div>

      <table class="bordered striped responsive-table">

          <thead>
              <tr ng-cloak>

                <th data-field="nombre" translate="panel_places_columntable_5"></th>              
                <th data-field="nombre" translate="panel_places_columntable_1"></th>
                <th data-field="nombre" translate="panel_places_columntable_2"></th>
                <th data-field="nombre" translate="panel_places_columntable_6"></th>
                <th data-field="nombre" translate="panel_places_columntable_3"></th>
                <th data-field="nombre" translate="panel_places_columntable_4"></th>

            </tr>
          </thead>
            <div ng-cloak ng-show="loadingPrev" class="progress">
                  <div class="indeterminate"></div>
         </div>
         <div ng-cloak ng-show="spinner" class="progress">
                  <div class="indeterminate"></div>
         </div>
          <tbody ng-hide="loadingPrev" ng-show="cities.length > 0">
            <tr ng-cloak ng-hide="loadingPrev" ng-repeat="city in cities">
                <td>[[city.nombre_ciudad]]</td>
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
                  [[city.habilitado]], [[city.nombre_ciudad]])"></label>
                </td>
                <td>[[city.countPlaces]]</td>
            </tr>
          </tbody>
        </table>

        <br/>

        <div class="row" ng-hide="loadingPrev">
          <div class="col s2" >
            <a  href="" ng-click="previousPage()" class="waves-effect waves-light btn wow animated" style="visibility: visible;">
              <i class="mdi-navigation-chevron-left left"></i>
              <span class="ng-scope">Anterior</span>
            </a>
          </div>

          <div class="col s8"><h4>Página [[ page ]] / [[ pages ]]</h4></div>

          <div class="col s2">
            <a  href="" ng-click="nextPage()" class="waves-effect waves-light btn wow animated" style="visibility: visible;">
              <span class="ng-scope">Siguiente</span>
              <i class="mdi-navigation-chevron-right right"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
</div>
@stop

@section('js')

  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/city-list/controller.js')!!}

@stop
