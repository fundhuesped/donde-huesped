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
                         <div class="card-panel hoverable">
                <h4>Elegir ubicación </h4>
                <select class="" 
                ng-change="showProvince()" ng-model="selectedCountry"
                ng-options="v.nombre_pais for v in countries" material-select watch>
                    <option value="" disabled selected>(Elegir Pais)</option>
                              
                    
                </select>

                <select class="" 
                ng-change="loadCity()"  ng-options="item as 
                item.nombre_provincia for item in provinces track by item.id"
                ng-model="selectedProvince"material-select watch>
                    <option value="" selected>(Elegir Provincia)</option>
                              
                   
                </select>

            <select class="wow " ng-change="showSearch()" ng-disabled="!showCity" 

            ng-options="v.nombre_partido for v in cities track by v.id"
            ng-model="selectedCity" material-select watch>
                
                <option value="" disabled selected>(Elegir Partido o Departamento)</option>
            </select>

            <a  href="" ng-click="getNow()"
            class="waves-effect waves-light btn wow">
              <i class="mdi-navigation-chevron-right right"></i>
              <i class="mdi-editor-format-list-bulleted left"></i>Buscar</a>
            </div>
          </div>
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