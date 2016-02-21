@extends('layouts.master')
@section('meta')
    <title>donde.huesped.org.ar | Fundación Huésped</title>
    <meta name="description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos.">
    <meta name="author" content="Fundación Huésped">
    <link rel="canonical" href="http://www.huesped.org.ar/donde/"/>
    <meta property='og:locale' content='es_LA'/>
    <meta property='og:title' content='donde.huesped.org.ar | Fundación Huésped'/>
    <meta property="og:description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos." />
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
<div ng-app="dondev2App">   
    <nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo">Donde</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse">    <i class="mdi-navigation-menu"></i></a>
      <ul class="right hide-on-med-and-down">
           <li><a href="#/localizar/test/listado"><i class="mdi-maps-place left"></i></a></li>
           <li><a class="modal-trigger " href="#modal1"><i class="mdi-action-info"></i></a></li>
           
      </ul>
      <ul class="side-nav" id="mobile-demo">
           <li><a href="/#/acerca">
            <i class="mdi-action-info left"></i>Información</a></li>
          <li><a href="#/localizar/test/listado">
            <i class="mdi-maps-place left"></i>¿Que hay cerca?</a></li>
          <li><a href="/#/agregar">
            <i class="mdi-action-add left"></i>Agregar un centro</a></li>
            
      </ul>
    </div>
  </nav>
      </nav>
      <div class="row">
        <div class="view" ng-view>
        </div>

    <div class="map" ng-controller="mapController">
  <div class="container">
          
          <div ng-cloak >

          <div class="wow fadeIn fadeInRight">
            <div class="detail row wow fadeIn fadeInDown" ng-cloak ng-show="currentMarker">
              <h5>[[currentMarker.calle]] [[currentMarker.altura]]</h5>
              <p> [[currentMarker.barrio_localidad]], [[currentMarker.provincia]]</p>
              <div class="row">
              <div class="col s0 m4"><p></p></div>
              <div class="col s12 m4">
                <a ng-cloak ng-show="currentMarker.telefono" ng-href="tel:[[currentMarker.telefono]]" class="waves-effect waves-light btn"><i class="mdi-communication-call left"></i>
                              [[currentMarker.telefono]]</a>
                    </div>
            </div>
          </div>
            <ng-map id="mainMap"
              zoom-to-include-markers="auto"
              default-style="true">
              <marker  
               on-click="showCurrent(p)" ng-repeat="p in places" position="[[p.latitude]],[[p.longitude]]"></marker>
            </ng-map>
          </div>
        </div>
    </div>
</div>

</div>

  
  
  @include('acerca')

@stop


@section('js')
    {!!Html::script('bower_components/materialize/dist/js/materialize.min.js')!!}  
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}  
  {!!Html::script('scripts/home/app.js')!!}
  {!!Html::script('scripts/home/controllers/home/controller.js')!!}
  {!!Html::script('scripts/home/controllers/acerca/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-list/controller.js')!!}  
  {!!Html::script('scripts/home/controllers/city-map/controller.js')!!}  
  {!!Html::script('scripts/home/controllers/locate-list/controller.js')!!}  
  {!!Html::script('scripts/home/controllers/locate-map/controller.js')!!}  
  {!!Html::script('scripts/home/controllers/map/controller.js')!!}  
  {!!Html::script('scripts/home/controllers/location/controller.js')!!}
  {!!Html::script('scripts/home/controllers/place/controller.js')!!}
  
  {!!Html::script('scripts/home/services/places.js')!!}
@stop






