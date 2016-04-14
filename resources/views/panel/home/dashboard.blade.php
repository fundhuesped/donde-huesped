 <div id="dashboard" class="col s12">
  

      <h3 ng-cloak ng-show="loadingDashboard"> Cargando Resumen ...</h3>
        <div ng-cloak ng-show="loadingDashboard" class="progress">
                  <div class="indeterminate"></div>
         </div>
      <div class="section navigate row" ng-cloak ng-hide="loadingDashboard">

               <h2> Hay [[ranking.length]] ciudades con datos </h2>
                <input type="search" ng-model="search" placed="Escribir el valor por que queres filtrar">        
                <h1> Lugares por Ciudad </h1>
               <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPost">
                <th data-field="establecimiento">Ranking</th>
                <th data-field="nombre">Partido, Provincia, País</th>
                <th data-field="nombre_localidad">establecimientos</th>
                <th data-field="direccion">Porcentaje</th>
            </tr>
          </thead>
          <tbody>

              <tr ng-cloak ng-hide="loadingPost" ng-repeat="city in ranking | filter:search">
                  <td>
                        [[$index]]#
                      </td>
                      <td>[[city.nombre_partido]]  [[city.nombre_provincia]] - [[city.nombre_pais]]</td>
                      <td>[[city.lugares]]</td>

              </tr>
          </tbody>
        </table>
         <h1> Lugares sin geolocalizacion</h1>
               <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPost">
                <th data-field="establecimiento">Lugares sin Geolocalizacion</th>
                <th data-field="nombre">Partido, Provincia, País</th>
                <th data-field="nombre_localidad">establecimientos</th>
                <th data-field="direccion">Porcentaje</th>
            </tr>
          </thead>
          <tbody>

              <tr ng-cloak ng-hide="loadingPost" ng-repeat="city in nonGeo | filter:search">
                  <td>
                        [[$index]]#
                      </td>
                      <td>[[city.nombre_partido]] [[city.nombre_provincia]] , [[city.nombre_pais]]</td>
                      <td>[[city.lugares]]</td>

              </tr>
          </tbody>
        </table>
        <h1> Lugares con poca certeza de geolocalizacion</h1>
               <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPost">
                <th data-field="establecimiento">Lugares con poca certeza</th>
                <th data-field="nombre">Partido, Provincia, País</th>
                <th data-field="nombre_localidad">establecimientos</th>
                <th data-field="direccion">Porcentaje</th>
            </tr>
          </thead>
          <tbody>

              <tr ng-cloak ng-hide="loadingPost" ng-repeat="city in badGeo | filter:search">
                  <td>
                        [[$index]]#
                      </td>
                      <td>[[city.nombre_partido]] [[city.nombre_provincia]] , [[city.nombre_pais]]</td>
                      <td>[[city.lugares]]</td>

              </tr>
          </tbody>
        </table>

            </div>

      </div>


      </div>

    </div>