<div id="activos" class="col s12">
  <div class="row">
    
    <div class="col s12 m1">
          <h6> <strong> <span>&#8203;</span> </strong> </h6>
    </div>
    <div class="col s12 m5">
       <h3 ng-cloak ng-hide="loadingPost"  class="title">   </h3>
  
 
  
  <h4 ng-cloak ng-show="!places" translate="panel_actives_title"></h4>

  <select class="rollSelect"
  ng-change="showProvince()" ng-model="selectedCountry"
  ng-options="v.nombre_pais for v in countries" material-select watch>
  <option value="" disabled selected translate="select_country"></option>
</select>

<select class="rollSelect"
ng-change="showPartidos()" ng-model="selectedProvince"
ng-disabled= '!provinceOn'
ng-options="v.nombre_provincia for v in provinces" material-select watch>
<option value="" disabled selected translate="select_state"></option>
</select>

<select class="rollSelect"
ng-change="loadCity()"
ng-options="item.nombre_partido for item in parties"
ng-model="selectedParty"
ng-disabled= '!partidoOn'
material-select watch>
<option value="" disabled="" selected translate="select_department"></option>
</select>

<select class="rollSelect"
ng-disabled= '!showCity'
ng-options="c.nombre_ciudad for c in cities"
ng-model="selectedCity" material-select watch>
<option value="" disabled selected translate="select_city"></option>
</select>

    </div>


      <div class="col m5">
          <h4 ng-cloak ng-show="!places"  ng-hide="loadingPost"> Buscar por Texto </h4>
    <input type="search" ng-model="searchQuery" placeholder="[['panel_actives_input_placeholder_1' | translate]]"/>
    <div class="col s12 m12 ">
              
      
           
                <input type="checkbox" id="exactSearch" ng-model="exactSearchOnly" ng-change="checkExact()"/>
                <label for="exactSearch">Buscar por Texto Exacto </label>
             
          </div>

      </div>

</div>
<div class="row">

  <div class="col m1">  <h6> <strong> <span>&#8203;</span> </strong> </h6></div>
  <div class="col m5">

      <div class="row">
      <div class="col s6">
             
    <a href="" ng-click="getNow()" class="waves-effect waves-light btn wow">
      <i class="mdi-action-search left">
      </i><span> Buscar</span></a>
      </div>
      <div class="col s6">
      

        <a   target="_blank" ng-click="activePlacesExport()"  class="waves-effect waves-light btn wow green">
      <i class="mdi-file-file-download left"></i>
      Descargar</a>

      </div>
    </div>


  </div>
  <div class="col m5"> 

    <div class="row">
      <div class="col s6">
          <a  href="" ng-click="searchNow()" class="waves-effect waves-light btn wow">
      <i class="mdi-action-search left"></i>
      Buscar</a>
      </div>
      <div class="col s6">
      
        
        <a target="_blank" href="panel/importer/export/search/[[searchQuery]]" class="waves-effect waves-light btn wow green">
      <i class="mdi-file-file-download left"></i>
      Descargar</a>

      </div>
    </div>
      
  </div>
  </div>

<div class="row">
    <div class="col s12">
      <h3 ng-cloak ng-show="loadingPost" translate="loadingPlaces"></h3>
       <div ng-cloak ng-show="loadingPost" class="progress">
        <div class="indeterminate"></div>
    </div>
    </div>
    </div>
      <div class="ng-cloak stats" ng-cloak ng-hide="loadingPost">
       <div class="row" ng-hide="!places">
        <h3 ng-if="optionMaster1" class="title"> <span translate="panel_actives_summary_1" translate-values="{places: '[[places.length]]'}"></span><strong> [[selectedCountry.nombre_pais]] [[selectedProvince.provincia]] [[]] [[selectedCity.nombre_ciudad]] [[searchQuery]] </strong>
         
        </h3>
          <h3 ng-if="optionMaster2" class="title" translate="panel_actives_summary_2" translate-values="{places: '[[places.length]]'}"></strong>
        </h3>
        

        <div class="nav-wrapper"  ng-cloak ng-hide="loadingPost">

        </div>
      </nav>

      <ng-map id="mapEditor" zoom-to-include-markers='true'
      lazy-init="true">
      <marker ng-repeat="pos in places"

      position="[[pos.latitude]], [[pos.longitude]]"
      on-click="showInfo(pos)">
    </marker>
  </ng-map>
  <br>

</div>

<div ng-cloak ng-hide="!places">
  
    <div class="row">
     

<h3 ng-cloak ng-show="places.length == 0 && !loadingPost"> <span translate="panel_actives_no_results_1"></span> <span  ng-cloak ng-show="searchExistence">'[[searchExistence]]'</span> <span ng-cloak ng-show="filterLocalidad" translate="panel_actives_no_results_2" translate-values="{location:'[[filterLocalidad]]'}"></span> </h3>
<div class="section copy row" ng-hide="places.length === 0">
  <div class="col s12 m12 ">

    <table class="bordered striped responsive-table orderded">
      <thead ng-cloak ng-hide="loadingPost">
        <tr>
         <th ng-click="orderWith('establecimiento')" data-field="establecimiento" translate="establishment"></th>
         <th ng-click="orderWith('nombre_ciudad')" data-field="nombre_localidad"><span translate="panel_places_columntable_5"></span>, <span translate="district"></span>, <span translate="state"></span>, <span translate="country"></span></th>
         <th ng-click="orderWith('calle')" data-field="direccion" translate="street_address"></th>
         <th data-field="" translate="services"></th>
         <th ng-click="orderWith('cantidad_votos')" class="center-align" data-field="" translate="puntuation"></th>
         <th data-field=""></th>
       </tr>
     </thead>

      

     <tbody>
        <div clas="row">
      <div class="col m5">

        <input type="search" placeholder="Filtra los resultados." ng-change="filterAllplaces()" ng-model="searchExistence" ng-touched">

      </div>
          <!-- <div class="col s6 m6 input-field">
              
           <div class="input-field" style="margin-top: 25px;">
              <p>

                <input type="checkbox" id="badGeo" ng-model="onlyBadGeo" ng-change="filterAllplaces()"/>
                <label for="badGeo" translate="panel_actives_badgeo_check"></label>
              </p>
            </div>
          </div> -->

            

          </div>
      <tr ng-cloak ng-hide="loadingPost" ng-repeat="place in places | filter:searchExistence | orderBy:dynamicOrderFunction" >
        <td>[[place.establecimiento]]</td>
        <td>  <small>[[place.nombre_ciudad]], [[place.nombre_partido]], [[place.nombre_provincia]], [[place.nombre_pais]]  <small> </td>
        <td ng-show='place.calle'> <small> [[place.calle]] <span ng-show='place.altura'>[[place.altura]] </span><span ng-show='place.cruce' translate="and"> </span><span ng-show='place.cruce'> [[place.cruce]]</span> </small></td>
        <td ng-show='!place.calle' ><small>(Sin Dirección)</small></td>
        <td class="services2">
              <img ng-show="place.condones" alt="Este lugar distribuye preservativos" src="images/preservativos.png">
              <img ng-show="place.prueba" alt="Este lugar puede hacer prueba de HIV" src="images/test.png">
              <img ng-show="place.vacunatorio" alt="Este lugar cuenta con centro vacunatorio" src="images/vacunatorios.png">
              <img ng-show="place.infectologia" alt="Este lugar cuenta con centro de infectologia" src="images/infectologia.png">
              <img ng-show="place.ile" alt="Este lugar cuenta con test rapido" src="images/ile.png">
              <img ng-show="place.ssr" alt="Este lugar cuenta con servicios de salud sexual y reproductiva" src="images/mac.png">
        </td>

        <td class="center-align services2">  <small>
          <div class="row" ng-show="[[place.cantidad_votos]] > -1">

              <div class="col s12 evaluation-panel-count">
                [[place.cantidad_votos]] 
                <span ng-show='place.cantidad_votos > 1' translate="evaluation_plural"></span>
                <span ng-show='place.cantidad_votos == 1' translate="evaluation_singular"></span>
                <span ng-show='place.cantidad_votos == 0' translate="evaluation_plural"></span>
              </div>

            </div>
            <div class="row" ng-show="[[place.cantidad_votos]] < -1">
              <div class="col s12 evaluation-panel-count">
                <span style="color: grey;" translate="without_evaluations"></span>
              </div>

            </div>
          </small>
          </td>

          <td class="actions">
            <a target="_blank"  ng-href="panel/places/[[place.placeId]]" class="waves-effect waves-light btn-floating"><i class="mdi-content-create left"></i></a>
            <a ng-click="blockNow(place)"class="waves-effect waves-light btn-floating"><i class="mdi-av-not-interested left"></i></a>
          </td>
        </tr>


        <div id="exportEvalModal" class="modal">
          <div class="modal-content">
            <div>
              <h5 class="center-align" translate="panel_actives_modal_title"></h5>
            </div>

            <div ng-repeat="service in services">
              <p>
                <input type="checkbox" id="[[service.code]]" ng-checked="exists(service.code, selected)" ng-click="toggle(service.code, selected)"/>
                <label for="[[service.code]]">[[service.label]]</label>
              </p>
            </div>
          </div>
          <div class="modal-footer">
            <div class="col s6" ng-if="optionMaster1">

              <a target="_self" href="" ng-show="!disableExportEvaluationButton()" ng-click="exportEvaluations()" class="waves-effect waves-light btn-floating red left">
                <i class="mdi-file-file-download left modal-action modal-close"></i>
              </a>

            </div>
            <div class="col s6" ng-if="optionMaster2">

              <a target="_self" href="panel/importer/front-export-eval/[[searchQuery]]" ng-click="" class="waves-effect waves-light btn-floating red">
                <i class="mdi-file-file-download left modal-action modal-close"></i>
              </a>
            </div>


            <a href="" class=" modal-action modal-close
            waves-effect waves-green btn-flat right" translate="cancel"></a>
          </div>


        </div>

      </tbody>

    </table>

  </div>

</div>

</div>

</div>

</div>
