<div id="activos" class="col s12">

 <div class="section navigate row">
   
   
  </div>
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
  <nav>
    <div class="ng-cloak nav-wrapper"  ng-cloak ng-hide="loadingPost">
      <form>
        <div class"row">
          <div class="col s12 m6">
            <div class="input-field">
              <input type="search" ng-change="filterAllplaces()"
                ng-model="searchExistence"
                placeholder="Escribí acá el nombre,ciudad o pais que querés encontrar">
              <label for="search"><i class="mdi-action-search"></i></label>
            </div>
          </div>
          <div class="col s12 m6">
            <div class="input-field">
              <input type="search" ng-change="filterAllplaces()"
                ng-model="filterLocalidad"
                placeholder="Escribí acá  la ciudad que querés encontrar">
              <label for="search"><i class="mdi-action-search"></i></label>
            </div>
          </div>
      </form>
    </div>
  </nav>

  <h3 ng-cloak ng-show="searchExistence.length > 3 && filteredplaces.length > 0"> Mostrando [[filteredplaces.length ]] resultados </h3>
  <h3 ng-cloak ng-show="filteredplaces.length == 0 && !loadingPost"> No hay resultados para <span  ng-cloak ng-show="searchExistence">'[[searchExistence]]'</span> <span ng-cloak ng-show="filterLocalidad"> en [[filterLocalidad]]</span> </h3>
  <div class="section copy row" ng-cloak ng-show="filteredplaces.length > 0">
      <div class="col s12 m12 ">

          <table class="bordered striped responsive-table">
            <thead ng-cloak ng-hide="loadingPost">
                <tr>
                   <th data-field="establecimiento">Establecimiento</th>
                  <th data-field="nombre_localidad">Partido, Provincia, Pais</th>
                  <th data-field="direccion">Dirección</th>
                  <th data-field="">Servicios</th>
                  <th data-field=""></th>
              </tr>
            </thead>
              <tbody>
                  <tr ng-cloak ng-hide="loadingPost" ng-repeat="place in filteredplaces">
                       <td>
                        [[place.establecimiento]]
                      </td>
                      <td> [[place.barrio_localidad]] [[place.nombre_partido]], [[place.nombre_provincia]], [[place.nombre_pais]]</td>
                      <td>[[place.calle]] [[place.altura]] [[place.cruce]]</td>
                      <td class="services">
            
                      <img ng-show="place.condones"
                        alt="Este lugar distribuye condones"
                        src="../images/iconos-new_preservativos-3.png">
                        <img ng-show="place.prueba"
                        alt="Este lugar puede hacer prueba de HIV"
                        src="../images/iconos-new_analisis-3.png" >
                        <img ng-show="place.vacunatorio"
                        alt="Este lugar cuenta con centro vacunatorio"
                        src="../images/iconos-new_vacunacion-3.png">
                        <img ng-show="place.infectologia"
                        alt="Este lugar cuenta con centro de infectologia"
                        src="../images/iconos-new_atencion-3.png" >
                   
             
            </td>
                       <td class="actions">

                        <a target="_self" ng-href="panel/places/[[place.placeId]]" class="waves-effect waves-light btn-floating"><i class="mdi-content-create left"></i></a>
                        <a ng-click="blockNow(place)"class="waves-effect waves-light btn-floating"><i class="mdi-av-not-interested left"></i></a>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>

    </div>
</div>
