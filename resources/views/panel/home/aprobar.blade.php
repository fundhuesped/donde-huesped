   <div id="aprobar" class="col s12">

      <div class="section navigate row">
    <h3 class="title"  ng-cloak ng-hide="loadingPrev"> <span translate="panel_actives_summary_2" translate-values="{places:'[[penplaces.length]]'}"></span> <span translate="pending"></span> <h3>
    <h3 ng-cloak ng-show="loadingPrev" translate="panel_pendings_loading_label"></h3>
    <div ng-cloak ng-show="loadingPrev" class="progress">
              <div class="indeterminate"></div>
         </div>
  </div>
  <nav>
    <div class="ng-cloak nav-wrapper"  ng-cloak ng-hide="loadingPrev">
      <form>
        <div class="input-field">
          <input type="search" ng-model="search" required
          placeholder="Escribí acá el lugar, ciudad, provincia o teléfono que querés encontrar">
          <label for="search"><i class="mdi-action-search"></i></label>
        </div>
      </form>
    </div>
  </nav>
  <hr>
  <div class="row">
  <div class="col s3">
    <h6> <strong> <span>&#8203;</span> </strong> </h6>
  </div>
   <div class="col s6" ng-show="toRemovePlaces.length > 0">

      <a href="" ng-click="removeAllSelected()" class="waves-effect waves-light btn red">
        <i class="mdi-av-not-interested right"></i>
        <span translate="">Rechazar Seleccionados </span>
      </a>

    </div>
 </div>
  <div class="section copy row">
    <div class="col s12">
        <table class="bordered striped responsive-table orderded">
          <thead>
              <tr ng-cloak ng-hide="loadingPrev">
                  <tr>
                   <th ng-click="orderWithPendientes('establecimiento')" data-field="establecimiento" translate="establishment"></th>
                  <th ng-click="orderWithPendientes('barrio_localidad')"data-field="nombre_localidad"><span translate="district"></span>, <span translate="state"></span>, <span translate="country"></span></th>
                  <th ng-click="orderWithPendientes('calle')" data-field="direccion" translate="street_address"></th>
                  <th data-field=""></th>
            </tr>

          </thead>
          <tbody>
              <tr ng-cloak ng-hide="loadingPrev" ng-repeat="place in penplaces | filter:search:strict | orderBy:dynamicOrderPendientes"">
                  <td>
                        [[place.establecimiento]]
                      </td>
                      <td> [[place.barrio_localidad]] [[place.nombre_partido]], [[place.nombre_provincia]], [[place.nombre_pais]]</td>
                      <td>[[place.calle]] [[place.altura]] [[place.cruce]]</td>
                       <td class="actions">
                        <a target="_blank" ng-href="panel/places/[[place.placeId]]" class="waves-effect waves-light btn-floating"><i class="mdi-content-create left"></i></a>
                        <a ng-click="blockNow(place)" class="waves-effect waves-light btn-floating"><i class="mdi-av-not-interested left"></i></a>
                         <a ng-click="addToBlockList(place)" ng-hide="place.inList" class="waves-effect waves-light btn-floating"><i class="mdi-av-my-library-add left"></i></a>
                         <a ng-click="removeFromBlockList(place)" ng-show="place.inList" class="waves-effect waves-light btn-floating"><i class="mdi-av-my-library-remove left"></i></a>
                      </td>

              </tr>
          </tbody>
        </table>
      </div>
    </div>


    </div>

      <!-- Modal Structure -->
      <div id="demoModal" class="modal">
          <div class="modal-content">
              <h4 translate="panel_pendings_modal_title"></h4>
              <h3><strong>[[current.establecimiento]]</strong></h3>
              <h4><small>[[current.nombre_provincia]], [[current.nombre_localidad]]</small></h4>
              <hr/>
              <p translate="panel_pendings_modal_warning"></p>
              <hr/>
          </div>
          <div class="modal-footer">
              <a href="" class=" modal-action modal-close
                waves-effect waves-green btn-flat" translate="no"></a>
              <a ng-click="removePlace()" href="" class=" modal-action waves-effect waves-green btn-flat" translate="yes"></a>
          </div>
      </div>

       <!-- Modal Structure -->
      <div id="removeAllModal" class="modal">
          <div class="modal-content">
              <h4> Remover todos</h4>
              <h3> ¿Estas segurx que deseas remover los [[toRemovePlaces.length]] centros elegidos? </h3>
              <hr/>
          </div>
          <div class="modal-footer">
              <a href="" class=" modal-action modal-close
                waves-effect waves-green btn-flat" translate="no"></a>
              <a ng-click="removeAllPlace()" href="" class=" modal-action waves-effect waves-green btn-flat" translate="yes"></a>
          </div>
      </div>
