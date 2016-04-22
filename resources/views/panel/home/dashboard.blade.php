 <div id="dashboard" class="col s12">
  

      <h3 ng-cloak ng-show="loadingDashboard"> Cargando Resumen ...</h3>
        <div ng-cloak ng-show="loadingDashboard" class="progress">
                  <div class="indeterminate"></div>
         </div>
         
<div ng-cloak ng-show="counters" class="wow fadeIn">
    <h2> Hay <strong>[[counters.lugares]]</strong> lugares en la en <strong> DONDE. </strong></h2>
    <p>  <strong>[[counters.aprobados]]</strong>  estan publicos y aprobados,  <strong>[[counters.rechazados]] </strong> rechazados y hay [[counter.pendientes]] nuevos para revisar </p>
    <p> Existen  <strong>[[counters.conGeo]] </strong> lugares geolocalizados, de los cuales  <strong>[[counters.errorGeo]] </strong> tienen poca confiabilidad de su ubicacion. </p>
    
    <p> Existen  <strong>[[counters.sinGeo]]</strong>  lugares sin geolocalizacion </h3>
    <p> Estamos en <strong> [[counters.paises]]</strong>  paises,  <strong>[[counters.ciudades]] </strong> provincias, y  <strong>[[counters.partido]]  </strong>partidos/departamentos </p>
 </div>
      <div class="section navigate row" ng-cloak ng-hide="loadingDashboard">
               

                 <input type="search" ng-model="search" placed="Escribir el valor por que queres filtrar">        
                <h1> Lugares por Ciudad </h1>
               <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPost">
                <th data-field="nombre">Partido, Provincia, País</th>
                <th data-field="nombre_localidad">Lugares</th>
            </tr>
          </thead>
          <tbody>

              <tr ng-cloak ng-hide="loadingPost" ng-repeat="city in ranking | filter:search">
          
                      <td>[[city.key]]</td>
                      <td>[[city.lugares]]</td>

              </tr>
          </tbody>
        </table>
         <h1> Lugares sin geolocalizacion</h1>
               <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPost">
                <th data-field="nombre">Partido, Provincia, País</th>
                <th data-field="nombre_localidad">Lugares</th>
            </tr>
          </thead>
          <tbody>

              <tr ng-cloak ng-hide="loadingPost" ng-repeat="city in nonGeo | filter:search">
                 <td>[[city.key]]</td>  <td>[[city.lugares]]</td>

              </tr>
          </tbody>
        </table>
        <h1> Lugares con poca certeza de geolocalizacion</h1>
               <table class="bordered striped responsive-table">
          <thead>
              <tr ng-cloak ng-hide="loadingPost">
     
                <th data-field="nombre">Partido, Provincia, País</th>
                <th data-field="nombre_localidad">Lugares</th>
            </tr>
          </thead>
          <tbody>

              <tr ng-cloak ng-hide="loadingPost" ng-repeat="city in badGeo | filter:search">
                 
                     <td>[[city.key]]</td> <td>[[city.lugares]]</td>

              </tr>
          </tbody>
        </table>

            </div>

      </div>


      </div>

    </div>