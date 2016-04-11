@extends('layouts.panel-master')

@section('content')
  <div class="home" ng-controller="panelplacePreController"
  ng-init="lockid={{$lockId}}">
   <div ng-cloak ng-show="loading">
     <div class="progress">
              <div class="indeterminate"></div>
         </div>
  </div>
  <div  ng-cloak ng-hide="loading" class="ng-cloak section navigate row">
    [[razon_social]]
    <div class="section search search-form row">
        <div class="row">
            <div class="col s12">
                <div class="row">
                  <form class="col s12 m6">

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="nombre" type="text" name="nombre" class="validate" ng-model="lock.nombre" ng-change="formChange()">
                        <label for="nombre">Nombre y Apellido</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="razon_social" type="text" name="razon_social" class="validate" ng-model="lock.razon_social" ng-change="formChange()">
                        <label for="razon_social">Razón social o Nombre de establecimiento</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="direccion" type="text" name="direccion" class="validate" ng-model="lock.direccion" ng-change="formChange()">
                        <label for="direccion">Direccion</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="entre_calle" type="text" name="entre_calle" class="validate" ng-model="lock.entre_calle" ng-change="formChange()">
                        <label for="entre_calle">Entre calle y calle</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="piso" type="text" name="piso" class="validate" ng-model="lock.piso" ng-change="formChange()">
                        <label for="piso">Piso</label>
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
                        <input  id="cp" type="text" name="cp" class="validate" ng-model="lock.cp" ng-change="formChange()">
                        <label for="cp">Codigo Postal</label>
                      </div>
                    </div>

                    <p>
                      <input  type="checkbox" name="movil" class="filled-in" id="filled-in-box-movil" ng-model="lock.movil"/>
                      <label for="filled-in-box-movil">¿Su establecimiento no tiene dirección comercial?</label>
                    </p>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="direccion_particular" ng-disabled="!lock.movil" type="text" name="direccion_particular" class="validate" ng-model="lock.direccion_particular" ng-change="formChange()">
                        <label for="direccion_particular">Dirección particular</label>
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
                        <input disabled id="nombre_localidad" type="text" name="nombre_localidad" class="validate" ng-model="lock.nombre_localidad" ng-change="formChange()">
                        <label for="nombre_localidad">Localidad</label>
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
                        <input id="idNextTel" type="text" name="idNextTel" class="validate" ng-model="lock.idNextTel" ng-change="formChange()">
                        <label for="idNextTel">ID de NextTel</label>
                      </div>
                    </div>

                    <p>
                      <input  type="checkbox" name="abierta_24" class="filled-in" id="filled-in-box" ng-model="lock.abierta_24"/>
                      <label for="filled-in-box">¿Su establecimiento está abierta las 24 hs?</label>
                    </p>

                    <div class="row">
                      <div class="input-field col s12">
                        <input value="" id="tel_24" ng-disabled="!lock.abierta_24" type="text" name="tel_24" class="validate" ng-model="lock.tel_24" ng-change="formChange()">
                        <label for="disabled">Telefono 24 hs</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="cel" type="text" name="cel" class="validate" ng-model="lock.cel" ng-change="formChange()">
                        <label for="cel">Celular</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="web_url" type="text" name="web_url" class="validate" ng-model="lock.web_url" ng-change="formChange()">
                        <label for="web_url">Sitio web</label>
                      </div>
                    </div>


                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="observacion" type="text"
                        name="observacion"

                        class="validate materialize-textarea"  ng-model="lock.observacion" ng-change="formChange()"></textarea>
                        <label for="observacion">Observación</label>
                      </div>
                    </div>


                  </form>
                  <div class="col s12 m6">
                    <div class="row">

                        <label>Localizacion en Mapa</label>
                        <input id="latitude" type="text" name="latitude" class="validate" ng-model="lock.latitude" ng-change="onLatLonInputChange()">
                        <input id="longitude" type="text" name="longitude" class="validate" ng-model="lock.longitude" ng-change="onLatLonInputChange()">
                        
                        


                      <ng-map id="mapEditor" zoom-to-include-markers='true' lazy-init="true"
                            default-style="true" center="[[lock]]"  zoom="16">
                           <marker ng-repeat="pos in positions"
                                icon="/images/mapa_final.png"
                                position="[[pos.latitude]], [[pos.longitude]]"
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
                                <i class="mdi-action-done-all left"></i>
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
                                <i class="mdi-action-delete   left"></i>
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


  {!!Html::script('angular/apps/panel/app.js')!!}
  {!!Html::script('angular/apps/panel/controllers/place-pre/controller.js')!!}
  {!!Html::script('angular/services/places.js')!!}

@stop
