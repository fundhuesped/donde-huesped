 <div id="dashboard" class="col s12">
      <div class="section navigate row">
        <h3 ng-cloak ng-hide="loadingPost" class="title">   </h3>
        <h3 ng-cloak ng-show="loadingPost"> Cargando Lugares aprobados ...</h3>
        <div ng-cloak ng-show="loadingPost" class="progress">
                  <div class="indeterminate"></div>
         </div>
         <div class="ng-cloak stats" ng-cloak ng-hide="loadingPost">
           <div class="row">
               <h3 class="title">
                Hay [[places.length]] Lugares distribuidos 
                en [[cityRanking.length]] Ciudades <a target="_blank" href="/panel/export" class="waves-effect waves-light btn-floating red"><i class="mdi-file-file-download left"></i></a></h3>

                

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

               <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPost">
                <th data-field="establecimiento">Ranking</th>
                <th data-field="nombre">Localidad, Provincia, País</th>
                <th data-field="nombre_localidad">establecimientos</th>
                <th data-field="direccion">Porcentaje</th>
            </tr>
          </thead>
          <tbody>
              <tr ng-cloak ng-hide="loadingPost" ng-repeat="city in cityRanking | filter:search">
                  <td>
                        [[city.position]]#
                      </td>
                      <td>[[city.key]]</td>
                      <td>[[city.count]]</td>
                      <td>[[city.percentage | number:2]]%</td>


              </tr>
          </tbody>
        </table>

            </div>

      </div>


      </div>

    </div>