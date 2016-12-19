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

 
  

@stop


@section('js')
{{--     <script> 
        // document.location.href="https://www.huesped.org.ar/donde";
        document.location.href="https://donde.huesped.org.ar";
    </script> --}}
@stop





