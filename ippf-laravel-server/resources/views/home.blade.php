@extends('layouts.master')
@section('meta')
<title>VAMOS | IPPF</title>
<meta name="google-site-verification" content="RQh3eES_sArPYfFybCM87HsV6mbwmttWlAIk-Upf1EQ" />
<meta name="description" content="@lang('site.seo_meta_description_content')">
<meta name="author" content="IPPF">
<link rel="canonical" href="https://www.huesped.org.ar/donde/"/>
<meta property='og:locale' content='es_LA'/>
<meta property='og:title' content='IPPF'/>
<meta property="og:description" content="@lang('site.seo_meta_description_content')" />
<meta property='og:url' content=''/>
<meta property='og:site_name' content='IPPF'/>
<meta property='og:type' content='website'/>
<meta property='og:image' content='https://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
<meta property='fb:app_id' content='459717130793708' />
<meta name="twitter:card" content="summary">
<meta name='twitter:title' content='IPPF'/>
<meta name="twitter:description" content="@lang('site.seo_meta_description_content')" />
<meta name='twitter:url' content='https://www.huesped.org.ar/donde/'/>
<meta name='twitter:image' content='https://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
<meta name='twitter:site' content='@fundhuesped' />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
@stop

@section('content')
<div ng-app="dondev2App" style="height:100vh">
  <nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo"><img class="logoTop" src="images/logo_blanco.svg">
       <!-- <span ng-cloak ng-show="navBar">/ [[navBar]] </span> --></a>
       <a href="#" data-activates="mobile-demo" class="button-collapse">
        <i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
         <li><a class="modal-trigger" href="#modal1"><i class="mdi-action-info"></i></a></li>
         <li><a class="modal-trigger" href="#/localizar/all/listado"><i class="mdi-maps-place left"></i></a></li>
         <li><a class="" href="form"><i class="mdi-content-add-circle-outline"></i></a></li>
         <li><a class="" href="listado-paises"><i class="mdi-action-language"></i></a></li>
         <li>
           <select name="language1" id="language1" ng-model="selectedLanguage" ng-change="changeLanguage()"  material-select watch>
            <option value="" disabled><span>LANG</span></option>
           <option value="en" name="en" ng-selected="[[selectedLanguage]]">EN</option>
           <option value="es" name="es" ng-selected="[[selectedLanguage]]">ES</option>
           <option value="br" name="br" ng-selected="[[selectedLanguage]]">BR</option>
         </select>

       </li>

       </ul>
       <ul ng-cloak ng-show="navigating"  class="left wow fadeIn">
         <li><a href="" onclick="window.history.back();"><i class="mdi-navigation-chevron-left right"></i></a></li>
       </ul>

       <ul class="side-nav" id="mobile-demo">

         <li>
           <select name="language2" id="language2" ng-model="selectedLanguage" ng-change="changeLanguage()" material-select watch>
           <option value="" disabled><span></span></option>
           <option value="en" ng-selected="[[selectedLanguage]]">EN</option>
           <option value="es" ng-selected="[[selectedLanguage]]">ES</option>
           <option value="br" ng-selected="[[selectedLanguage]]">BR</option>
         </select>
       </li>

       <li><a href="#/acerca" >
         <i class="mdi-action-info left"></i><span translate="information"></span>
       </a>
     </li>

        <li><a href="#/acerca">
          <i class="mdi-action-info left"></i><span translate="about"></span>
        </a>
      </li>

      <li><a href="#/localizar/all/listado">
        <i class="mdi-maps-place left"></i><span translate="closer"></span>
      </a>
      </li>

      <li><a href="form">
        <i class="mdi-content-add-circle-outline left"></i><span translate="seggest"></span>
      </a>
      </li>

      <li><a href="listado-paises">
        <i class="mdi-action-language left"></i><span translate="list"></span>
      </a>
      </li>

      </ul>
    </div>
  </nav>
</nav>

<div class="row">
  <div class="view" ng-view autoscroll="true">
  </div>

  <div class="map" ng-controller="mapController">
      <!--<div ng-cloak> -->
        <div ng-cloak class="wow fadeIn fadeInRight">
          <ng-map id="mainMap"
            zoom-to-include-markers="auto"
            default-style="true">
            <marker
              icon="images/place-off.png"
              on-click="showCurrent(p)"
              ng-repeat="p in places"
              position="[[p.latitude]],[[p.longitude]]">
            </marker>

        <marker
          icon="images/place-on.png"
          ng-repeat="p in centerMarkers"
          position="[[p.latitude]],[[p.longitude]]">
        </marker>

    </ng-map>
  </div>
<!--</div>-->
</div>

</div>

@include('acerca')

@stop


@section('js')
  {!!Html::script('bower_components/materialize/dist/js/materialize.min.js')!!}
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
  {!!Html::script('bower_components/angularjs-socialshare/dist/angular-socialshare.min.js')!!}
  {!!Html::script('bower_components/angular-recaptcha/release/angular-recaptcha.js')!!}
  {!!Html::script('bower_components/ng-text-truncate/ng-text-truncate.js')!!}
  {!!Html::script('bower_components/angular-translate/angular-translate.js')!!}
  {!!Html::script('scripts/translations/es.js')!!}
  {!!Html::script('scripts/translations/br.js')!!}
  {!!Html::script('scripts/translations/en.js')!!}
  {!!Html::script('scripts/home/app.js')!!}
  {!!Html::script('scripts/home/controllers/home/controller.js')!!}
  {!!Html::script('scripts/home/controllers/acerca/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-list/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-map/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-map/controller2.js')!!}
  {!!Html::script('scripts/home/controllers/locate-list/controller.js')!!}
  {!!Html::script('scripts/home/controllers/locate-map/controller.js')!!}
  {!!Html::script('scripts/home/controllers/map/controller.js')!!}
  {!!Html::script('scripts/home/controllers/location/controller.js')!!}
  {!!Html::script('scripts/home/controllers/suggest-location/controller.js')!!}
  {!!Html::script('scripts/home/controllers/party-list/controller.js')!!}
  {!!Html::script('scripts/home/controllers/evaluation/controller.js')!!}
  {!!Html::script('scripts/home/services/places.js')!!}
  {!!Html::script('scripts/home/services/copy.js')!!}

<script>
$(document).ready(function() {
    $('select').material_select();
  });
</script>
@stop
