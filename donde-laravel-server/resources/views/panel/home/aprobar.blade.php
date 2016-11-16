   <div id="aprobar" class="col s12">

      <div class="section navigate row">
    <h3 class="title"  ng-cloak ng-hide="loadingPrev"> Hay [[penplaces.length]] Lugares pendientes <h3>
    <h3 ng-cloak ng-show="loadingPrev"> Cargando Lugares pendientes ...</h3>
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
  <div class="section copy row">
    <div class="col s12 m12 ">
      <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPrev">
                  <tr>
                   <th data-field="establecimiento">Establecimiento</th>
                  <th data-field="nombre_localidad">Partido, Provincia, Pais</th>
                  <th data-field="direccion">Dirección</th>
                  <th data-field=""></th>
            </tr>

          </thead>
          <tbody>
              <tr ng-cloak ng-hide="loadingPrev" ng-repeat="place in penplaces | filter:search:strict">
                  <td>
                        [[place.establecimiento]]
                      </td>
                      <td> [[place.barrio_localidad]] [[place.nombre_partido]], [[place.nombre_provincia]], [[place.nombre_pais]]</td>
                      <td>[[place.calle]] [[place.altura]] [[place.cruce]]</td>
                       <td class="actions">

                        <a target="_self" ng-href="panel/places/[[place.placeId]]" class="waves-effect waves-light btn-floating"><i class="mdi-content-create left"></i></a>
                        <!-- Modal Trigger -->
                        <a ng-click="blockNow(place)" class="waves-effect waves-light btn-floating"><i class="mdi-av-not-interested left"></i></a>
                        <div ng-click="fire()">JONA FIRE</div>
                      </td>
                      <div ng-click="fire()">JONA FIRE</div>

              </tr>
          </tbody>
        </table>
      </div>
    </div>


    </div>
