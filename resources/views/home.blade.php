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
@stop

@section('content')
<div ng-app="dondev2App">
    <nav ng-cloak ng-hide="main">
          <div class="nav-wrapper wow fadeIn">
            <div class="col s12">
              <a href="#/" class="breadcrumb" >[[navBar]]</a>
            </div>
          </div>
      </nav>
  <div class="view" ng-view>
  </div>

</div>
@stop


@section('js')
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}  
  {!!Html::script('scripts/home/app.js')!!}
  {!!Html::script('scripts/home/controllers/home/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-list/controller.js')!!}  
  {!!Html::script('scripts/home/controllers/city-map/controller.js')!!}  
  {!!Html::script('scripts/home/controllers/locate-list/controller.js')!!}  
  {!!Html::script('scripts/home/controllers/locate-map/controller.js')!!}  
  {!!Html::script('scripts/home/controllers/country/controller.js')!!}
  {!!Html::script('scripts/home/controllers/service/controller.js')!!}
  {!!Html::script('scripts/home/controllers/place/controller.js')!!}
  
  {!!Html::script('scripts/home/services/places.js')!!}
@stop






