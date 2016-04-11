@extends('layouts.panel-master')

@section('content')


    <div class="home panel" ng-controller="panelIndexController">
    <div class="row" >
    <div class="col s12">
        <ul class="tabs" tabs>
            <li class="tab col s3"><a class="active" href="#dashboard"><i class="small mdi-content-inbox"></i>Resumen</a></li>
            <li class="tab col s3"><a class="" href="#aprobar"><i class="small mdi-content-inbox"></i>Pendientes [['(' + penplaces.length + ')' || '(...)']]</a></li>
            <li class="tab col s3"><a href="#activos"> <i class="small mdi-action-done-all"></i>Activos [['(' + places.length + ')' || '(...)']]</a></li>
            <li class="tab col s3"><a href="#rejected"> <i class="small mdi-action-delete  "></i>Rechazados [['(' + rejected.length + ')' || '(...)']]</a></li>
        </ul>
    </div>
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
                                icon="/images/mapa_final.png"
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
    <div id="aprobar" class="col s12">

      <div class="section navigate row">
    <h3 class="title"  ng-cloak ng-hide="loadingPrev"> Hay [[penplaces.length || '(cargando...)']] Lugares pendientes <h3>
    <h3 ng-cloak ng-show="loadingPrev"> Cargando Lugares pendientes ...</h3>
    <div ng-cloak ng-show="loadingPrev" class="progress">
              <div class="indeterminate"></div>
         </div>
  </div>
  <nav>
    <div class="ng-cloak nav-wrapper"  ng-cloak ng-hide="loadingPrev">
      <form>
        <div class="input-field">
          <input type="search" ng-model="search" required placeholder="Escribí acá  el lugare, ciudad, provincia o teléfono que querés encontrar">
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
                <th data-field="establecimiento">Establecimiento</th>
                <th data-field="nombre">Nombre</th>
                <th data-field="nombre_localidad">Localidad</th>
                <th data-field="nombre_provincia">Provincia</th>
                <th data-field="direccion">Dirección</th>
                <th data-field="tel">Teléfono</th>
            </tr>
          </thead>
          <tbody>
              <tr ng-cloak ng-hide="loadingPrev" ng-repeat="lock in penplaces | filter:search:strict">
                  <td>
                        [[lock.establecimiento]]
                      </td>
                      <td>[[lock.nombre]]</td>
                      <td>[[lock.nombre_localidad]]</td>
                      <td>[[lock.nombre_provincia]]</td>
                      <td>[[lock.direccion]]</td>
                      <td>
                          [[lock.tel]]
                      </td>
                       <td class="actions">
                        <a target="_self" ng-href="panel/place/pre/[[lock.id]]" class="waves-effect waves-light btn-floating"><i class="mdi-content-create left"></i></a>
                        <!-- Modal Trigger -->
                        <a ng-click="blockNow(lock)" class="waves-effect waves-light btn-floating"><i class="mdi-action-delete left"></i></a>
                      </td>

              </tr>
          </tbody>
        </table>
      </div>
    </div>


    </div>
<div id="activos" class="col s12">

 <div class="section navigate row">
    <h3 class="title"  ng-cloak ng-hide="loadingPost"> Hay [[places.length]] Lugares en el sistema 
      <a target="_blank" href="/panel/export" class="waves-effect waves-light btn-floating red"><i class="mdi-file-file-download left"></i></a>

    </h3>
    <h3 ng-cloak ng-show="loadingPost"> Cargando Lugares aprobados ...</h3>
    <div ng-cloak ng-show="loadingPost" class="progress">
              <div class="indeterminate"></div>
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
                placeholder="Escribí acá  el nombre o teléfono que querés encontrar">
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
                  <th data-field="nombre">Nombre</th>
                  <th data-field="nombre_localidad">Localidad</th>
                  <th data-field="nombre_provincia">Provincia</th>
                  <th data-field="direccion">Dirección</th>
                  <th data-field="tel">Teléfono</th>
                  <th data-field=""></th>
              </tr>
            </thead>
              <tbody>
                  <tr ng-cloak ng-hide="loadingPost" ng-repeat="lock in filteredplaces">
                      <td>
                        [[lock.establecimiento]]
                      </td>
                      <td>[[lock.nombre]]</td>
                      <td>[[lock.nombre_localidad]]</td>
                      <td>[[lock.nombre_provincia]]</td>
                      <td>[[lock.direccion]]</td>
                      <td>
                          [[lock.tel]]
                      </td>
                       <td class="actions">
                        <a target="_self" ng-href="panel/place/[[lock.id]]" class="waves-effect waves-light btn-floating"><i class="mdi-content-create left"></i></a>
                        <a ng-click="blockNow(lock)"class="waves-effect waves-light btn-floating"><i class="mdi-action-delete left"></i></a>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>

    </div>
</div>

 <div id="rejected" class="col s12">

      <div class="section navigate row">
    <h3 class="title"  ng-cloak ng-hide="loadingPrev"> Hay [[rejectedplaces.length ]] Lugares rechazados <h3>
    <h3 ng-cloak ng-show="loadingPrev"> Cargando Lugares rechazados ...</h3>
    <div ng-cloak ng-show="loadingPrev" class="progress">
              <div class="indeterminate"></div>
         </div>
  </div>
  <nav>
    <div class="ng-cloak nav-wrapper" ng-cloak ng-hide="loadingPrev">
      <form>
        <div class="input-field">
          <input type="search" ng-model="search" required placeholder="Escriba 
          aquí el lugare, ciudad, provincia o teléfono que querés encontrar">
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
                <th data-field="establecimiento">Establecimiento</th>
                <th data-field="nombre">Nombre</th>
                <th data-field="nombre_localidad">Localidad</th>
                <th data-field="nombre_provincia">Provincia</th>
                <th data-field="tel">Teléfono</th>
            </tr>
          </thead>
          <tbody>
              <tr ng-cloak ng-hide="loadingPrev" ng-repeat="lock in rejectedplaces | filter:search:strict">
                  <td>
                        [[lock.establecimiento]]
                      </td>
                      <td>[[lock.nombre]]</td>
                      <td>[[lock.nombre_localidad]]</td>
                      <td>[[lock.nombre_provincia]]</td>
                      <td>
                          [[lock.tel]]
                      </td>
                       <td class="actions">
                        <a target="_self" ng-href="panel/place/pre/[[lock.id]]" class="waves-effect waves-light btn-floating"><i class="mdi-content-create left"></i></a>
                        <a ng-click="blockNow(lock)"class="waves-effect waves-light btn-floating"><i class="mdi-action-delete left"></i></a>
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
          <h4>¿Estas seguro qué deseás rechazar el siguiente lugare?</h4>
          <hr/>
          <h5>[[current.establecimiento]], [[current.nombre]]</h5>
          <h3><small>[[current.nombre_provincia]], [[current.nombre_localidad]]</small></h3>
          <hr/>
          <p>Una vez rechazado, podrás volver a agregarlo en "Rechazados"</p>
          <hr/>
      </div>
      <div class="modal-footer">
          <a href="" class=" modal-action modal-close
            waves-effect waves-green btn-flat">No</a>
          <a ng-click="removeLock()" href="" class=" modal-action waves-effect waves-green btn-flat">Si</a>
      </div>
  </div>

</div>

  @stop

@section('js')
    {!!Html::script('scripts/genosha-geolibs.js')!!}


  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/index/controller.js')!!}
  {!!Html::script('scripts/home/services/places.js')!!}

@stop
