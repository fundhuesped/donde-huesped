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
                <h3>Tu solicitud ha sido enviada con éxito.</h3>
                  <h3 class="title">¡Muchas Gracias!</h3>
              </div>

          </div>
      </div>
  </div>
 
</div>
</div>

@stop

@section('js')
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}


  {!!Html::script('scripts/form/app.js')!!}
  {!!Html::script('scripts/home/services/form.js')!!}
@stop
