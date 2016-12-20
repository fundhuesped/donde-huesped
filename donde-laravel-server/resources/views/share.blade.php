@extends('layouts.master')
@section('meta')
    <title>
      {{$p->establecimiento}} en {{$p->nombre_partido}} en Donde - Fundación Huésped</title>
    <meta name="description" content="{{$p->establecimiento}} en {{$p->nombre_partido}}, {{$p->calle}} {{$p->altura}}  ">
    <meta name="author" content="Fundación Huésped">
    <link rel="canonical" href="https://www.huesped.org.ar/donde/"/>
    <meta property='og:locale' content='es_LA'/>
    <meta property='og:title' content='www.huesped.org.ar | Fundación Huésped'/>
    <meta property="og:description" ccontent="{{$p->establecimiento}} en {{$p->nombre_partido}}, {{$p->calle}} {{$p->altura}}  ">
    <meta property='og:url' content='https://www.huesped.org.ar/donde/share/{{$p->placeId}} '/>
    <meta property='og:site_name' content='Fundación Huésped'/>
    <meta property='og:type' content='website'/>
    <meta property='og:image' content='{!! $p->image !!}'/>
    <meta property='fb:app_id' content='459717130793708' />
    <meta name="twitter:card" content="summary">
    <meta name='twitter:title' content='www.huesped.org.ar | Fundación Huésped'/>
    <meta name="twitter:description" content="{{$p->establecimiento}} en {{$p->nombre_partido}}, {{$p->calle}} {{$p->altura}}  ">
    <meta name='twitter:url' content='https://www.huesped.org.ar/donde/share/{{$p->placeId}} '/>
    <meta name='twitter:image' content='{!! $p->image !!}'/>
    <meta name='twitter:site' content='@fundhuesped' />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
@stop

@section('content')

<nav>
    <div class="nav-wrapper">
      <a href="{{ url('/#/') }}" class="brand-logo">
        <img class="logoTop" src="../images/HUESPED_logo_donde_RGB-07_cr.png">
</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse">
        <i class="mdi-navigation-menu"></i></a>
      
    </div>
  </nav>

<br>
<br>

<div class="home">


<div> {{$p->nombre_pais}} > {{$p->nombre_provincia}} > {{$p->barrio_localidad}}</div>
<div>Establecimiento: {{$p->establecimiento}}</div>
<div>Tipo: {{$p->tipo}}</div>
<div>Calle: {{$p->calle}}</div>
<div>Altura: {{$p->altura}}</div>
<div>Latitude: {{$p->latitude}}</div>
<div>Longitude: {{$p->longitude}}</div>


<img src="{{$p->image}}" width="145" height="126" usemap="#staticmap">
<map name="staticmap"></map>


<div class="row">
  <div class="col s12 l12">
  </div>
  <div class="col s12 l12 servicios" >
    <ul class="collection">
    <div >
      @if ($p->vacunatorio)
        <img width="45" height="45" alt="Este lugar distribuye vacunatorio" src="../images/iconos-new_vacunacion-3.png"> Condones
      @endif
    </div>

<div>
@if ($p->prueba)
<img width="45" height="45" alt="Este lugar distribuye condones" src="../images/iconos-new_analisis-3.png"> Condones
@endif
</div>

<div>
@if ($p->infectologia)
<img width="45" height="45" alt="Este lugar distribuye condones" src="../images/iconos-new_atencion-3.png"> Condones
@endif
</div>

<div>
@if ($p->condones)
<img width="45" height="45" alt="Este lugar distribuye condones" src="../images/iconos-new_preservativos-3.png"> Condones
@endif
</div>

    </ul>

  </div>
</div>
</div>










@stop


@section('js')
{!!Html::script('bower_components/materialize/dist/js/materialize.min.js')!!}
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
  {!!Html::script('bower_components/angularjs-socialshare/dist/angular-socialshare.min.js')!!}

  {!!Html::script('scripts/home/app.js')!!}
  {!!Html::script('scripts/home/controllers/home/controller.js')!!}
  {!!Html::script('scripts/home/controllers/acerca/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-list/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-map/controller.js')!!}
  {!!Html::script('scripts/home/controllers/locate-list/controller.js')!!}
  {!!Html::script('scripts/home/controllers/locate-map/controller.js')!!}
  {!!Html::script('scripts/home/controllers/map/controller.js')!!}
  {!!Html::script('scripts/home/controllers/location/controller.js')!!}

  {!!Html::script('scripts/home/controllers/suggest-location/controller.js')!!}

  {!!Html::script('scripts/home/services/places.js')!!}
  {!!Html::script('scripts/home/services/copy.js')!!}
{{--     <script> 
        // document.location.href="https://www.huesped.org.ar/donde";
        document.location.href="https://donde.huesped.org.ar";
    </script> --}}
@stop





