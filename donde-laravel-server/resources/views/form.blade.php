@extends('layouts.master')
@section('meta')
    <title>donde.huesped.org.ar | Fundación Huésped</title>
    <meta name="description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos.">
    <meta name="author" content="Fundación Huésped">
    <link rel="canonical" href="https://www.huesped.org.ar/donde/"/>
    <meta property='og:locale' content='es_LA'/>
    <meta property='og:title' content='donde.huesped.org.ar | Fundación Huésped'/>
    <meta property="og:description" content="Conoce dónde hacerte la prueba de VIH y buscar condones gratis. También encuentra los vacunatorios y centros de infectología más cercanos." />
    <meta property='og:url' content='https://www.huesped.org.ar/donde/'/>
    <meta property='og:site_name' content='Fundación Huésped'/>
    <meta property='og:type' content='website'/>
    <meta property='og:image' content='https://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
    <meta property='fb:app_id' content='459717130793708' />
    <meta name="twitter:card" content="summary">
    <meta name='twitter:title' content='donde.huesped.org.ar | Fundación Huésped'/>
    <meta name="twitter:description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos." />
    <meta name='twitter:url' content='https://www.huesped.org.ar/donde/'/>
    <meta name='twitter:image' content='https://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
    <meta name='twitter:site' content='@fundhuesped' />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
@stop

@section('content')
<div ng-app="dondev2App">   
    <nav>
    <div class="nav-wrapper">
      <a href="{{ url('/#/') }}" class="brand-logo">
        <img class="logoTop" src="images/HUESPED_logo_donde_RGB-07_cr.png">
</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse">
        <i class="mdi-navigation-menu"></i></a>
      
    </div>
  </nav>
  <div class="home" ng-controller="formController">
  <div class="section search search-form row">
      <h1>SUGERIR NUEVO LUGAR </h1>
        <p>A continuación complete el formulario con el nuevo establecimiento. Con * se encuentran marcados los campos requeridos.</p>
      <form class="col s12 m6">
                    
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="establecimiento" type="text" name="establecimiento" class="validate" ng-model="place.establecimiento" 
                        ng-change="formChange()">
                        <label for="establecimiento">Nombre del Establecimiento</label>
                    </div>
                     </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="tipo" type="text" name="tipo" 
                        class="validate" ng-model="place.tipo" 
                        ng-change="formChange()">
                        <label for="tipo">Tipo de Establecimiento</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="calle" type="text" 
                        name="calle" class="validate" 
                        ng-model="place.calle" ng-change="formChange()">
                        <label for="calle">Calle</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="altura" type="text" name="altura" class="validate" ng-model="place.altura" ng-change="formChange()">
                        <label for="altura">Altura</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="cruce" type="text" name="cruce" class="validate" ng-model="place.cruce" ng-change="formChange()">
                        <label for="cruce">Cruce</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="piso_dpto" type="text" 
                        name="piso_dpto" class="validate" 
                        ng-model="place.piso_dpto" ng-change="formChange()">
                        <label for="piso_dpto">Piso o Departamento</label>
                      </div>
                    </div>

                
 <div class="row">
                      <div class="input-field col s12">
                    <select class="" 
                ng-change="showProvince()" ng-model="place.idPais"
                ng-options="v.id as v.nombre_pais for v in countries" material-select watch>
                    <option value="" disabled selected>(Elegir País)</option>
                              
                    
                </select>

                <select class="" 
                ng-change="loadCity()"  
                ng-options="item.id as 
                item.nombre_provincia for item in provinces track by item.id"
                ng-model="place.idProvincia" 
                material-select watch>
                    <option value="" selected>(Elegir Provincia)</option>
                              
                   
                </select>

            <select class="wow " 
            ng-change="showSearch()" 
            ng-disabled="!showCity" 

            ng-options="v.id as v.nombre_partido for v in cities track by v.id"
            ng-model="place.idPartido" material-select watch>
                
                <option value="" disabled selected>(Elegir Partido o Departamento)</option>
            </select>
                                  </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="barrio_localidad" type="text" name="barrio_localidad" class="validate" ng-model="place.barrio_localidad" ng-change="formChange()">
                        <label for="barrio_localidad">Barrio o Localidad</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="responsable" type="text" 
                        name="responsable" class="validate" 
                        ng-model="place.responsable" ng-change="formChange()">
                        <label for="responsable">Responsable</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="horario" type="text" 
                        name="horario" class="validate" 
                        ng-model="place.horario" ng-change="formChange()">
                        <label for="horario">Horario</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="mail" type="email" 
                        name="mail" class="validate" 
                        ng-model="place.mail"
                         ng-change="formChange()">
                        <label for="mail">Mail</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="tel" type="text" 
                        name="tel" class="validate" 
                        ng-model="place.telefono" ng-change="formChange()">
                        <label for="tel">Teléfono</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="Web" type="text" 
                        name="Web" class="validate" 
                        ng-model="place.web" ng-change="formChange()">
                        <label for="Web">Web</label>
                      </div>
                    </div>
                    <p>

                      <input  type="checkbox" 
                      name="place.condones" 
                      id="filled-in-box-condones" 
                      ng-checked="isChecked(place.condones)"
                      ng-model="place.condones"/>
                      <label for="filled-in-box-condones">¿Entrega condones?</label>
                    </p>
                    <p>

                      <input  type="checkbox" 
                      name="place.prueba" 
                      id="filled-in-box-prueba" 
                      ng-checked="isChecked(place.prueba)"
                      ng-model="place.prueba"/>
                      <label for="filled-in-box-prueba" >¿Hace pruebas de HIV?</label>
                    </p>
                    <p>

                      <input  type="checkbox" 
                      name="place.infectologia" 
                      id="filled-in-box-infectologia" 
                      ng-checked="isChecked(place.infectologia)"
                      ng-model="place.infectologia"/>
                      <label for="filled-in-box-infectologia">¿Cuenta con atención por infectología?</label>
                    </p>
                    <p>

                      <input  type="checkbox" 
                      name="place.vacunatorio" 
                      id="filled-in-box-vac" 
                      ng-checked="isChecked(place.vacunatorio)"
                      ng-model="place.vacunatorio"/>
                      <label for="filled-in-box-vac">¿Cuenta con vacunatorio?</label>
                    </p>
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="observacion" type="text"
                        name="observacion"
                        class="validate materialize-textarea" ng-model="place.observacion" ng-change="formChange()"></textarea>
                        <label for="observacion">¿Algo más que desees agregar?</label>
                      </div>
                    </div>
                    
                         </form>


<div class="col s12 m6">
                    <div class="row">

                 
                    <div class="row">
                      <div class="valign-demo  valign-wrapper">
                          <div class="valign full-width actions">

                            <button class="waves-effect waves-light btn btn-large full"
                            ng-href="" 
                            ng-click="lookupLocation()">

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

                            <div class="" ng-cloak >
                              <i class="mdi-content-save left"></i>
                              Localizar con GPS
                            </div>

                           </button>
                          </div>
                      </div>
                             <label>Ubicación</label>

                        <input id="latitude" readonly type="text" name="latitude" 
                        class="validate" ng-model="place.latitude" ng-change="onLatLonInputChange()">
                        <input id="longitude" readonly  type="text" name="longitude" class="validate" ng-model="place.longitude" ng-change="onLatLonInputChange()">
                      <div ng-cloak ng-show="waitingLocation">
                         <div class="progress">
                                  <div class="indeterminate"></div>
                             </div>
                      </div>

                      <ng-map id="mapEditor" 
                            lazy-init="true" zoom="14">
                           <marker ng-repeat="pos in positions"
                                position="[[pos.latitude]],[[pos.longitude]]"
                                on-dragend="onDragEnd()"
                                draggable="true">
                          </marker>
                        </ng-map>


                      </br>


                    </div>


                  </div>
                </div>
                
                  <div class="row">

                    <div class="input-field col s12">

 <p>
                              <input type="checkbox" name="acepta_terminos" 
                              class="filled-in" id="terminosCheck" 
                                ng-change="formChange()"
                                ng-model="aceptaTerminos"/>
                              <label for="terminosCheck">Acepto los 
                                <a href="/acerca" target="_blank">Términos y Condiciones</a> y la publicación de los datos en el sitio.</label>
                            </p> 
                          </div>
                        </div>
                      </div>
                      <p></p>
                    <div class="row">

                  <div class="row">
                    <div class="valign-demo  valign-wrapper">
                        <div class="valign full-width actions">
                            <button class="waves-effect waves-light btn btn-large full"
                            ng-href="" ng-disabled="invalid" ng-click="clicky()">

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
                              Enviar
                            </div>

                           </button>
                        </div>
                    </div>
                  </div>


                </br>
                </form>
              </div>

          </div>
      </div>
  </div>
 
</div>
</div>

@stop

@section('js')
  <script
  src="https://www.google.com/recaptcha/api.js?hl=es-419&onload=vcRecaptchaApiLoaded&render=explicit"
  async defer
></script>
  {!!Html::script('bower_components/materialize/dist/js/materialize.min.js')!!}  
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}  
  {!!Html::script('bower_components/angular-recaptcha/release/angular-recaptcha.min.js')!!}

  {!!Html::script('scripts/form/app.js')!!}
  {!!Html::script('scripts/form/controllers/form/controller.js')!!}
  {!!Html::script('scripts/home/services/places.js')!!}

@stop
