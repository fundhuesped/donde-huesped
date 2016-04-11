@extends('layouts.master')
@section('meta')
    <title>donde.huesped.org.ar | Fundación Huésped</title>
    <meta name="description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos.">
    <meta name="author" content="Fundación Huésped">
    <link rel="canonical" href="http://www.huesped.org.ar/donde/"/>
    <meta property='og:locale' content='es_LA'/>
    <meta property='og:title' content='donde.huesped.org.ar | Fundación Huésped'/>
    <meta property="og:description" content="Conoce dónde hacerte la prueba de VIH y buscar condones gratis. También encuentra los vacunatorios y centros de infectología más cercanos." />
    <meta property='og:url' content='http://www.huesped.org.ar/donde/'/>
    <meta property='og:site_name' content='Fundación Huésped'/>
    <meta property='og:type' content='website'/>
    <meta property='og:image' content='http://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
    <meta property='fb:app_id' content='459717130793708' />
    <meta name="twitter:card" content="summary">
    <meta name='twitter:title' content='donde.huesped.org.ar | Fundación Huésped'/>
    <meta name="twitter:description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos." />
    <meta name='twitter:url' content='http://www.huesped.org.ar/donde/'/>
    <meta name='twitter:image' content='http://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
    <meta name='twitter:site' content='@fundhuesped' />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
@stop

@section('content')
<div ng-app="myApp">
  <div class="home" ng-controller="formController">
  <div class="section search search-form row">
      <div class="row">
          <div class="col s12">
              <div class="row">
                  <h3 class="center">¿Tenés una ?</h3>
                  <h3 class="title">Completá el formulario</h3>
              </div>
              <div class="row">
                <form class="col s12">
                  <p>
                    <input  type="checkbox" name="abierta_24" class="filled-in" id="filled-in-box" ng-model="disable24"/>
                  </p>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="nombre" type="text" name="nombre" class="validate" ng-model="nombre" ng-change="formChange()">
                      <label for="nombre">Nombre y Apellido</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="razon_social" type="text" name="razon_social" class="validate" ng-model="razon_social" ng-change="formChange()">
                      <label for="razon_social">Nombre del establecimiento</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="direccion" type="text" name="direccion" class="validate" ng-model="direccion" ng-change="formChange()">
                      <label for="direccion">Dirección</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="entre_calle" type="text" name="entre_calle" class="validate" ng-model="entre_calle" ng-change="formChange()">
                      <label for="entre_calle">¿Entre qué calles?</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="piso" type="text" name="piso" class="validate" ng-model="piso" ng-change="formChange()">
                      <label for="piso">Piso</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="nro_local" type="text" name="nro_local" class="validate" ng-model="nro_local" ng-change="formChange()">
                      <label for="nro_local">Nro. de local</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="cp" type="text" name="cp" class="validate" ng-model="cp" ng-change="formChange()">
                      <label for="cp">Código Postal</label>
                    </div>
                  </div>

                  <p>
                    <input  type="checkbox" name="movil" class="filled-in" id="filled-in-box-movil" ng-model="disablemovil"/>
                    <label for="filled-in-box-movil">
                      No cuenta con local para atención al público.</label>
                  </p>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="direccion_particular" ng-disabled="!disablemovil" type="text" name="direccion_particular" class="validate" ng-model="direccion_particular" ng-change="formChange()">
                      <label for="direccion_particular">Dirección particular</label>
                    </div>
                  </div>

                  <div class="row">
                    <select class="browser-default" ng-model="myCountry" ng-options="c.nombre_pais for c in countries" ng-change="loadProvinces()" ng-change="formChange()">
                      <option value="" selected>Elegí un País (*)</option>
                      <option ng-value="c.nombre_pais"></option>
                      <input type="hidden" name="nombre_pais" ng-value="myCountry.nombre_pais" >
                    </select>
                  </div>

                  <div class="row">
                    <select class="browser-default" ng-model="myProvince" ng-options="p.nombre_provincia for p in provinces" ng-change="loadCities()" ng-change="formChange()">
                      <option value="" selected>Elegí una Provincia (*)</option>
                      <option ng-value="p.nombre_provincia"></option>
                      <input type="hidden" name="nombre_provincia" ng-value="myProvince.nombre_provincia" >
                    </select>
                  </div>

                  <div class="row">
                    <select class="browser-default" ng-model="myCity" ng-options="c.nombre_localidad for c in cities" ng-change="formChange()">
                      <option value="" selected>Elegí una Localidad (*)</option>
                      <option ng-value="c.nombre_localidad"></option>
                      <input type="hidden" name="nombre_localidad" ng-value="myCity.nombre_localidad" >
                    </select>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input  value="" id="otra_localidad" type="text" name="otra_localidad" class="validate" ng-model="otra_localidad" ng-change="formChange()">
                      <label for="otra_localidad">Otra ciudad</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="mail" type="email" name="mail" class="validate" ng-model="mail" ng-change="formChange()">
                      <label for="mail">Email</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="tel" type="text" name="tel" class="validate" ng-model="tel" ng-change="formChange()">
                      <label for="tel">Teléfono</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="idNextTel" type="text" name="idNextTel" class="validate" ng-model="idNextTel" ng-change="formChange()">
                      <label for="idNextTel">ID de Nextel</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input value="" id="tel_24" ng-disabled="!disable24" type="text" name="tel_24" class="validate" ng-model="tel_24" ng-change="formChange()">
                      <label for="disabled">Teléfono 24 hs</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="cel" type="text" name="cel" class="validate" ng-model="cel" ng-change="formChange()">
                      <label for="cel">Teléfono móvil.</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input id="web_url" type="text" name="web_url" class="validate" ng-model="web_url" ng-change="formChange()">
                      <label for="web_url">Sitio web</label>
                    </div>
                  </div>


                  <div class="row">
                    <div class="input-field col s12">
                        <div
                            vc-recaptcha
                            on-success="formChange()"
                            key="'6LfvrxUTAAAAAMnIM1H9bCCc3j9EZBvodWHeUqTo'"
                        ></div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">

 <p>
                              <input type="checkbox" name="acepta_terminos" 
                              class="filled-in" id="terminosCheck" ng-model="aceptaTerminos"/>
                              <label for="terminosCheck">Acepto los 
                                <a href="/acerca" target="_blank">Términos y Condiciones</a>  la publicación de los datos en el sitio.</label>
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
  {!!Html::script('libs/trabex-genosha-geolibs.js')!!}
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
  {!!Html::script('bower_components/angular-recaptcha/release/angular-recaptcha.min.js')!!}
  {!!Html::script('angular/apps/form/app.js')!!}
  {!!Html::script('angular/apps/form/controllers/form/controller.js')!!}
  {!!Html::script('angular/services/places.js')!!}
@stop
