<div id="eval" class="col s12">

  <h3 ng-cloak ng-hide="loadingPost"  class="title"></h3>

  <h3 ng-cloak ng-show="loadingPost" translate="loadingPlaces"></h3>

  <div ng-cloak ng-show="loadingPost" class="progress">

    <div class="indeterminate"></div>

  </div>

  <select class="rollSelect"
  ng-change="showProvince()" ng-model="selectedCountryEval"
  ng-options="v.nombre_pais for v in countries" material-select watch>
  <option value="" disabled selected translate="select_country"></option>
  </select>

  <select class="rollSelect"
  ng-change="showPartidos()" ng-model="selectedProvinceEval"
  ng-disabled= '!provinceEvalOn'
  ng-options="v.nombre_provincia for v in provincesEval" material-select watch>
  <option value="" disabled selected translate="select_state"></option>
  </select>

  <select class="rollSelect"
  ng-change="loadCity()"
  ng-options="item.nombre_partido for item in partiesEval"
  ng-model="selectedPartyEval"
  ng-disabled= '!partidoEvalOn'
  material-select watch>
  <option value="" disabled="" selected translate="select_department"></option>
  </select>

  <select class="rollSelect"
  ng-disabled= '!showCityEval'
  ng-options="c.nombre_ciudad for c in citiesEval"
  ng-model="selectedCityEval" material-select watch>
  <option value="" disabled selected translate="select_city"></option>
  </select>
  <!-- CONDOMS CARD -->
        <div class="form-checkbox-cards">
          <input type="checkbox"
          checked="checked" 
          name="onlyApproved"
          id="filled-in-box-aprobadas"
          ng-model="onlyApproved"
          ng-checked="" ng-change=""/>
          <label for="filled-in-box-aprobadas" >Solo aprobadas</label>
        </div>
 
 <div class="row">
  <div class="col s4">
    <h6> <strong> <span>&#8203;</span> </strong> </h6>
  </div>
   <div class="col s4">
      
      <a href="" ng-click="getNowEval()" class="waves-effect waves-light btn green">
        <i class="mdi-navigation-chevron-right right"></i>
        <i class="mdi-editor-format-list-bulleted left"></i>
        <span translate="">Buscar y Filtrar</span>
      </a>

    </div>
 </div>
 
  <h3 ng-cloak ng-show="totalEvals == '0' && !loadingPost"> <span translate="panel_actives_no_results_1"></span> [[selectedCityEval.nombre_ciudad]]</h3>


  <div class="section copy row" ng-show="totalEvals != '0'">

    <h3 ng-show='!fromSearch && totalEvals == 1' translate="result_evaluations_singular"></h3>


    <h3 ng-show='!fromSearch && totalEvals > 1' translate="result_evaluations_plural" translate-values="{evaluations_length: '[[totalEvals]]' }"></h3>

     <div class="row">

   


  </div>
  <hr/>

    <div class="col s12 m12 ">

      <table id='eval' class="bordered striped responsive-table orderded">

        <thead ng-cloak ng-hide="loadingPost">

          <tr>
            <th ng-click="orderWith('establecimiento')" class="col s3" data-field="establecimiento" translate="establishment"></th>

            <th ng-click="orderWith('nombre_localidad')" class="col s2" data-field="nombre_localidad"><span translate="panel_places_columntable_5"></span>, <span translate="district"></span>, <span translate="state"></span>, <span translate="country"></span></th>

            <th ng-click="orderWith('service')" class="col s1" data-field="" translate="services"></th>

            <th ng-click="orderWith('voto')" class="col s1" class="center-align" data-field="" translate="puntuation"></th>

            <th ng-click="orderWith('comentario')" class="col s2" class="center-align" data-field="" translate="comment"></th>

            <th ng-click="orderWith('name')" class="col s1" class="center-align" data-field="" translate="name"></th>
             <th ng-click="orderWith('created_at')" class="col s1" class="center-align" data-field="" > Fecha </th>

            <th class="col s2" data-field=""></th>

          </tr>

        </thead>

        <tbody>

          <tr  ng-repeat="e in evaluations  | orderBy:dynamicOrderFunction" >

            <td class="col s3">[[e.establecimiento]]</td>

            <td class="col s2"> <small>[[e.nombre_ciudad]], [[e.nombre_partido]], [[e.nombre_provincia]], [[e.nombre_pais]] </small></td>

            <td class="col s1 services2">

              <img ng-show="e.service == 'condones'" alt="Este lugar distribuye condones" src="images/preservativos.png">

              <img ng-show="e.service == 'prueba'" alt="Este lugar puede hacer prueba de HIV" src="images/test.png" >

              <img ng-show="e.service == 'vacunatorios'" alt="Este lugar cuenta con Servicios de Salud Sexual y Reproductiva" src="images/vacunatorios.png" >

              <img ng-show="e.service == 'cdi'" alt="Este lugar cuenta con centro de Interrupcion Legal del Embarazo" src="images/infectologia.png" >

              <img ng-show="e.service == 'sssr'" alt="Este lugar cuenta con Servicios de Salud Sexual y Reproductiva" src="images/mac.png" >
              <img ng-show="e.service == 'ssr'" alt="Este lugar cuenta con Servicios de Salud Sexual y Reproductiva" src="images/mac.png" >

              <img ng-show="e.service == 'ile'" alt="Este lugar cuenta con centro de Detección de Cancer" src="images/ile.png" >
               <span ng-show="!e.service">-</span>
            </td>

            <td class="center-align col s1 services2"><img src="images/emojis/[[e.voto]]active.png" alt="[[e.voto]]"></td>

            <td class="center-align col s2">
              <small>[[e.comentario || "-"]]<small>
              <small>
            </td>

            <td class="center-align col s1"><small>[[e.name || "-"]]</small></td>
            <td class="center-align col s1"><small>[[e.created_at || "-"]]</small></td>
            
            <td class="actions col s1">

              <a ng-show="e.aprobado == 0" ng-cloak target="_blank" ng-href="panel/places/[[e.idPlace]]" data-toggle="tooltip" title="[[details]]" class="waves-effect waves-light btn-floating"><i class="mdi-image-loupe left"></i></a>

              <a ng-show="e.aprobado == 1" ng-click="removeNow(e.id)" data-toggle="tooltip" title="[[delete]]" class="waves-effect waves-light btn-floating"><i class="mdi-av-not-interested left"></i></a>

            </td>

          </tr>

        </tbody>

      </table>

    </div>

  </div>

</div>

  <!-- Modal Evaluations -->
  <div id="demoModalEval" class="modal">
      <div class="modal-content">
          <h4 translate="confirm_delete_evaluation"></h4><br />
          <hr/>
          <p translate="confirm_description"></p>
          <hr/>
      </div>
      <div class="modal-footer">
          <a href="" class=" modal-action modal-close
            waves-effect waves-green btn-flat" translate="no"></a>
          <a ng-click="removeEval([[evalId]])" href="" class=" modal-action waves-effect waves-green btn-flat" translate="yes"></a>
      </div>
  </div>