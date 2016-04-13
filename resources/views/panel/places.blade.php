@extends('layouts.panel-master')

@section('content')
  <div class="home" ng-controller="panelplaceController"
  ng-init="placeId={{$placeId}}">

  <div ng-cloak ng-show="loading">
     <div class="progress">
              <div class="indeterminate"></div>
         </div>
  </div>
  <div  class="ng-cloak section navigate row wow fadeIn" ng-cloak ng-hide="loading">
    [[establecimiento]]
    <div class="section search search-form row ">
        <div class="row">
            <div class="col s12">
                <div class="row">
                  <form class="col s12 m6">
                    
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="establecimiento" type="text" name="establecimiento" class="validate" ng-model="lock.establecimiento" 
                        ng-change="formChange()">
                        <label for="establecimiento">Nombre del Establecimiento</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="calle" type="text" name="calle" class="validate" ng-model="lock.calle" ng-change="formChange()">
                        <label for="calle">Calle</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="altura" type="text" name="altura" class="validate" ng-model="lock.altura" ng-change="formChange()">
                        <label for="altura">Altura</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="cruce" type="text" name="cruce" class="validate" ng-model="lock.cruce" ng-change="formChange()">
                        <label for="cruce">Cruce</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="piso_dpto" type="text" name="piso_dpto" class="validate" ng-model="lock.piso_dpto" ng-change="formChange()">
                        <label for="piso_dpto">Piso o Departamento</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="nro_local" type="text" name="nro_local" class="validate" ng-model="lock.nro_local" ng-change="formChange()">
                        <label for="nro_local">Nro. de local</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input disabled id="nombre_pais" type="text" name="nombre_pais" class="validate" ng-model="lock.nombre_pais" ng-change="formChange()">
                        <label for="nombre_pais">Pais</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input disabled id="nombre_provincia" type="text" name="nombre_provincia" class="validate" ng-model="lock.nombre_provincia" ng-change="formChange()">
                        <label for="nombre_provincia">Provincia</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="nombre_partido" type="text" name="nombre_partido" class="validate" ng-model="lock.nombre_partido" ng-change="formChange()">
                        <label for="nombre_partido">Partido</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="barrio_localidad" type="text" name="barrio_localidad" class="validate" ng-model="lock.barrio_localidad" ng-change="formChange()">
                        <label for="barrio_localidad">Barrio o Localidad</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="mail" type="email" name="mail" class="validate" ng-model="lock.mail" ng-change="formChange()">
                        <label for="mail">Mail</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="tel" type="text" name="tel" class="validate" ng-model="lock.tel" ng-change="formChange()">
                        <label for="tel">Telefono</label>
                      </div>
                    </div>

                  
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="observacion" type="text"
                        name="observacion"
                        class="validate materialize-textarea" ng-model="lock.observacion" ng-change="formChange()"></textarea>
                        <label for="observacion">Observación</label>
                      </div>
                    </div>



                  </form>
                  <div class="col s12 m6">
                    <div class="row">

                        <label>Localizacion en Mapa</label>
                        <input id="latitude" type="text" name="latitude" 
                        class="validate" ng-model="lock.latitude" ng-change="onLatLonInputChange()">
                        <input id="longitude" type="text" name="longitude" class="validate" ng-model="lock.longitude" ng-change="onLatLonInputChange()">
                        
                        


                      <ng-map id="mapEditor" zoom-to-include-markers='true' 
                            lazy-init="true" zoom="16">
                           <marker ng-repeat="pos in positions"
                                
                                position="[[pos.latitude]],[[pos.longitude]]"
                                on-dragend="onDragEnd()"
                                draggable="true">
                          </marker>
                        </ng-map>


                      </br>
                    <div class="row">
                      <div class="valign-demo  valign-wrapper">
                          <div class="valign full-width actions">

                            <button class="waves-effect waves-light btn btn-large full"
                            ng-href="" ng-disabled="spinerflag" ng-click="clicky()">

                            <div class="preloader-wrapper small active" ng-cloak ng-show="spinerflag">
                              <div class="spinner-layer spinner-red-only">
                                <div class="circle-clipper left">
                                <div class="circle"></div>
                                </div><div class="gap-patch">
                                <div class="circle"></div>
                                </div><div class="circle-clipper right">
                                <div class="circle"></div>
                                </div>
                              </div>
                            </div>

                            <div class="" ng-cloak ng-show="!spinerflag">
                              <i class="mdi-content-save left"></i>
                              Guardar
                            </div>

                           </button>
                          </div>
                      </div>
                    </div>

                  </br>
                  <div class="row">
                      <div class="valign-demo  valign-wrapper">
                          <div class="valign full-width actions">
                              <button class="waves-effect waves-light btn btn-large full"
                              ng-href="" ng-disabled="spinerflag" ng-click="clickyApr()">

                              <div class="preloader-wrapper small active" ng-cloak ng-show="spinerflag">
                                <div class="spinner-layer spinner-red-only">
                                  <div class="circle-clipper left">
                                  <div class="circle"></div>
                                  </div><div class="gap-patch">
                                  <div class="circle"></div>
                                  </div><div class="circle-clipper right">
                                  <div class="circle"></div>
                                  </div>
                                </div>
                              </div>

                              <div class="" ng-cloak ng-show="!spinerflag">
                                <i class="mdi-action-done  left"></i>
                                Aprobar
                              </div>

                            </button>
                          </div>
                      </div>
                    </div>
                     </br>
                    <div class="row">
                      <div class="valign-demo  valign-wrapper">
                          <div class="valign full-width actions">
                              <button class="waves-effect waves-light btn btn-large full"
                              ng-href="" ng-disabled="spinerflag" ng-click="clickyDis()">

                              <div class="preloader-wrapper small active" ng-cloak ng-show="spinerflag">
                                <div class="spinner-layer spinner-red-only">
                                  <div class="circle-clipper left">
                                  <div class="circle"></div>
                                  </div><div class="gap-patch">
                                  <div class="circle"></div>
                                  </div><div class="circle-clipper right">
                                  <div class="circle"></div>
                                  </div>
                                </div>
                              </div>

                              <div class="" ng-cloak ng-show="!spinerflag">
                                <i class="mdi-av-not-interested  left"></i>
                                Rechazar
                              </div>

                            </button>
                          </div>
                      </div>
                    </div>

                  </div>
                </div>

            </div>
        </div>
    </div>
  </div>
</div>
@stop

@section('js')

  {!!Html::script('libs/trabex-genosha-geolibs.js')!!}
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/places/controller.js')!!}
  {!!Html::script('scripts/home/services/places.js')!!}

@stop
