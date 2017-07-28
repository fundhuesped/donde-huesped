@extends('layouts.master')
@section('meta')
<title translate="page_title"></title>
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
        <h1 translate="suggest_place"></h1>
        <p translate="form_intro_text"></p>
        <form class="col s12 m6">

          <div class="row">
            <div class="input-field col s12">
              <input id="establecimiento" type="text" name="establecimiento" class="validate" ng-model="place.establecimiento"
              ng-change="formChange()">
              <label for="establecimiento" translate="form_establishment_name"></label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="tipo" type="text" name="tipo"
              class="validate" ng-model="place.tipo"
              ng-change="formChange()">
              <label for="tipo" translate="form_establishment_type"></label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input id="calle" type="text"
              name="calle" class="validate"
              ng-model="place.calle" ng-change="formChange()">
              <label for="calle" translate="form_establishment_street">*</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="altura" type="text" name="altura" class="validate" ng-model="place.altura" ng-change="formChange()">
              <label for="altura" translate="form_establishment_street_height"></label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input id="cruce" type="text" name="cruce" class="validate" ng-model="place.cruce" ng-change="formChange()">
              <label for="cruce" translate="form_establishment_street_intersection"></label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input id="piso_dpto" type="text"
              name="piso_dpto" class="validate"
              ng-model="place.piso_dpto" ng-change="formChange()">
              <label for="piso_dpto" translate="form_establishment_floor"></label>
            </div>
          </div>


          <div class="row">
            <div class="input-field col s12">
              <select class=""
              ng-change="showProvince()" ng-model="place.idPais"
              ng-options="v.id as v.nombre_pais for v in countries" material-select watch>
              <option value="" disabled selected translate="select_country">*</option>
            </select>

            <select class=""
            ng-change="loadCity()"
            ng-options="item.id as
            item.nombre_provincia for item in provinces track by item.id"
            ng-model="place.idProvincia"
            material-select watch>
            <option value="" selected translate="select_state"></option>
          </select>

          <select class="wow "
          ng-change="showSearch()"
          ng-disabled="!showCity"
          ng-options="v.id as v.nombre_partido for v in cities track by v.id"
          ng-model="place.idPartido" material-select watch>
          <option value="" disabled selected translate="select_department"></option>
        </select>

      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input id="barrio_localidad" type="text" name="barrio_localidad" class="validate" ng-model="place.barrio_localidad" ng-change="formChange()">
        <label for="barrio_localidad" translate="neighborhood"></label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input id="responsable" type="text"
        name="responsable" class="validate"
        ng-model="place.responsable" ng-change="formChange()">
        <label for="responsable" translate="responsable"></label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="horario" type="text"
        name="horario" class="validate"
        ng-model="place.horario" ng-change="formChange()">
        <label for="horario" translate="schedule"></label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="mail" type="email"
        name="mail" class="validate"
        ng-model="place.mail"
        ng-change="formChange()">
        <label for="mail" translate="email"></label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input id="tel" type="text"
        name="tel" class="validate"
        ng-model="place.telefono" ng-change="formChange()">
        <label for="tel" translate="tel"></label>
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


    <div class="card-panel">

      <input  type="checkbox"
      name="place.condones"
      id="filled-in-box-condones"
      ng-checked="isChecked(place.condones)"
      ng-model="place.condones" ng-change="formChange()"/>
      <label for="filled-in-box-condones" translate="form_select_condones"></label>

      <div class="form-group" ng-show="place.condones">
        <div class="col s12">
          <label translate="form_select_service_type_title"></label>
        </div>

        <p>
          <input type="radio" id="st_condones1" name="servicetype_condones" value="arancel" ng-model="place.servicetype_condones" ng-change="formChange()">
          <label for="st_condones1" translate="form_service_type_option_arancel"></label>
        </p>


        <p>
          <input type="radio" id="st_condones2" name="servicetype_condones" value="gratuito" ng-model="place.servicetype_condones" ng-change="formChange()">
          <label for="st_condones2" translate="form_service_type_option_gratuito"></label>
        </p>


        <p>
          <input type="radio" id="st_condones3" name="servicetype_condones" value="cobertura" ng-model="place.servicetype_condones" ng-change="formChange()">
          <label for="st_condones3" translate="form_service_type_option_consultar"></label>
        </p>

        <p>
        <input  type="checkbox"
        name="friendly_condones"
        id="friendly_condones"
        ng-model="place.friendly_condones" />
        <label for="friendly_condones" translate="form_service_friendly_option"></label>
        </p>

      </div>

    </div>


    <div class="card-panel">

      <input  type="checkbox"
      name="place.prueba"
      id="filled-in-box-prueba"
      ng-checked="isChecked(place.prueba)"
      ng-model="place.prueba" ng-change="formChange()"/>
      <label for="filled-in-box-prueba" translate="form_prueba_option"></label>

      <div class="form-group" ng-show="place.prueba">
        <div class="col s12">
          <label translate="form_select_service_type_title"></label>
        </div>

        <p>
          <input type="radio" id="st_prueba1" name="servicetype_prueba" value="arancel" ng-model="place.servicetype_prueba" ng-change="formChange()">
          <label for="st_prueba1" translate="form_service_type_option_arancel"></label>
        </p>


        <p>
          <input type="radio" id="st_prueba2" name="servicetype_prueba" value="gratuito" ng-model="place.servicetype_prueba" ng-change="formChange()">
          <label for="st_prueba2" translate="form_service_type_option_gratuito"></label>
        </p>


        <p>
          <input type="radio" id="st_prueba3" name="servicetype_prueba" value="cobertura" ng-model="place.servicetype_prueba" ng-change="formChange()">
          <label for="st_prueba3" translate="form_service_type_option_consultar"></label>
        </p>

        <p>
        <input  type="checkbox"
        name="friendly_prueba"
        id="friendly_prueba"
        ng-model="place.friendly_prueba" />
        <label for="friendly_prueba" translate="form_service_friendly_option"></label>
        </p>

      </div>

    </div>

    <div class="card-panel">
      <input  type="checkbox"
      name="place.sd"
      id="filled-in-box-dc"
      ng-checked="isChecked(place.dc)"
      ng-model="place.dc"  ng-change="formChange()"/>
      <label for="filled-in-box-dc" translate="form_dc_option"></label>

      <div class="form-group" ng-show="place.dc">
        <div class="col s12">
          <label translate="form_select_service_type_title"></label>
        </div>

        <p>
          <input type="radio" id="st_dc1" name="servicetype_dc" value="arancel" ng-model="place.servicetype_dc" ng-change="formChange()">
          <label for="st_dc1" translate="form_service_type_option_arancel"></label>
        </p>


        <p>
          <input type="radio" id="st_dc2" name="servicetype_dc" value="gratuito" ng-model="place.servicetype_dc" ng-change="formChange()">
          <label for="st_dc2" translate="form_service_type_option_gratuito"></label>
        </p>


        <p>
          <input type="radio" id="st_dc3" name="servicetype_dc" value="cobertura" ng-model="place.servicetype_dc" ng-change="formChange()">
          <label for="st_dc3" translate="form_service_type_option_consultar"></label>
        </p>

        <p>
        <input  type="checkbox"
        name="friendly_dc"
        id="friendly_dc"
        ng-model="place.friendly_dc" />
        <label for="friendly_dc" translate="form_service_friendly_option"></label>
        </p>

      </div>
    </div>

    <div class="card-panel">
      <input  type="checkbox"
      name="place.ssr"
      id="filled-in-box-ssr"
      ng-checked="isChecked(place.ssr)"
      ng-model="place.ssr" ng-change="formChange()"/>
      <label for="filled-in-box-ssr" translate="form_ssr_option"></label>

      <div class="form-group" ng-show="place.ssr">
        <div class="col s12">
          <label translate="form_select_service_type_title"></label>
        </div>

        <p>
          <input type="radio" id="st_ssr1" name="servicetype_ssr" value="arancel" ng-model="place.servicetype_ssr" ng-change="formChange()">
          <label for="st_ssr1" translate="form_service_type_option_arancel"></label>
        </p>


        <p>
          <input type="radio" id="st_ssr2" name="servicetype_ssr" value="gratuito" ng-model="place.servicetype_ssr" ng-change="formChange()">
          <label for="st_ssr2" translate="form_service_type_option_gratuito"></label>
        </p>


        <p>
          <input type="radio" id="st_ssr3" name="servicetype_ssr" value="cobertura" ng-model="place.servicetype_ssr" ng-change="formChange()">
          <label for="st_ssr3" translate="form_service_type_option_consultar"></label>
        </p>

        <p>
        <input  type="checkbox"
        name="friendly_ssr"
        id="friendly_ssr"
        ng-model="place.friendly_ssr" />
        <label for="friendly_ssr" translate="form_service_friendly_option"></label>
        </p>

      </div>

    </div>
    <div class="card-panel">
      <input  type="checkbox"
      name="place.mac"
      id="filled-in-box-mac"
      ng-checked="isChecked(place.mac)"
      ng-model="place.mac" ng-change="formChange()"/>
      <label for="filled-in-box-mac" translate="form_mac_option"></label>

      <div class="form-group" ng-show="place.mac">
        <div class="col s12">
          <label translate="form_select_service_type_title"></label>
        </div>

        <p>
          <input type="radio" id="st_mac1" name="servicetype_mac" value="arancel" ng-model="place.servicetype_mac" ng-change="formChange()">
          <label for="st_mac1" translate="form_service_type_option_arancel"></label>
        </p>


        <p>
          <input type="radio" id="st_mac2" name="servicetype_mac" value="gratuito" ng-model="place.servicetype_mac" ng-change="formChange()">
          <label for="st_mac2" translate="form_service_type_option_gratuito"></label>
        </p>


        <p>
          <input type="radio" id="st_mac3" name="servicetype_mac" value="cobertura" ng-model="place.servicetype_mac" ng-change="formChange()">
          <label for="st_mac3" translate="form_service_type_option_consultar"></label>
        </p>

        <p>
        <input  type="checkbox"
        name="friendly_mac"
        id="friendly_mac"
        ng-model="place.friendly_mac" />
        <label for="friendly_mac" translate="form_service_friendly_option"></label>
        </p>

      </div>

    </div>

    <div class="card-panel">
      <input  type="checkbox"
      name="place.ile"
      id="filled-in-box-ile"
      ng-checked="isChecked(place.ile)"
      ng-model="place.ile" ng-change="formChange()"/>
      <label for="filled-in-box-ile" translate="form_ile_option"></label>

      <div class="form-group" ng-show="place.ile">
        <div class="col s12">
          <label translate="form_select_service_type_title"></label>
        </div>

        <p>
          <input type="radio" id="st_ile1" name="servicetype_ile" value="arancel" ng-model="place.servicetype_ile" ng-change="formChange()">
          <label for="st_ile1" translate="form_service_type_option_arancel"></label>
        </p>


        <p>
          <input type="radio" id="st_ile2" name="servicetype_ile" value="gratuito" ng-model="place.servicetype_ile" ng-change="formChange()">
          <label for="st_ile2" translate="form_service_type_option_gratuito"></label>
        </p>


        <p>
          <input type="radio" id="st_ile3" name="servicetype_ile" value="cobertura" ng-model="place.servicetype_ile" ng-change="formChange()">
          <label for="st_ile3" translate="form_service_type_option_consultar"></label>
        </p>

        <p>
        <input  type="checkbox"
        name="friendly_ile"
        id="friendly_ile"
        ng-model="place.friendly_ile" />
        <label for="friendly_ile" translate="form_service_friendly_option"></label>
        </p>

      </div>

    </div>

    <div class="row">
      <div class="input-field col s12">
        <textarea id="observacion" type="text"
        name="observacion"
        class="validate materialize-textarea" ng-model="place.observacion" ng-change="formChange()"></textarea>
        <label for="observacion" translate="form_observation_input"></label>
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
              <span translate="form_gps_find"></span>
            </div>

          </button>
        </div>
      </div>
      <label translate="location"></label>

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
      <label for="terminosCheck">
        <a href="/acerca" target="_blank" translate="terms_and_conditions1"></a> <span translate="terms_and_conditions2"></span></label>
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


        <div class="" ng-cloak ng-show="!spinerflag" translate="send">

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


<footer class="landing-service-footer">
  <p translate="footer_text"></p>
</footer>
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
{!!Html::script('bower_components/angular-translate/angular-translate.js')!!}
{!!Html::script('scripts/translations/es.js')!!}
{!!Html::script('scripts/translations/en.js')!!}
{!!Html::script('scripts/translations/br.js')!!}

{!!Html::script('scripts/form/app.js')!!}
{!!Html::script('scripts/form/controllers/form/controller.js')!!}
{!!Html::script('scripts/home/services/places.js')!!}

@stop
