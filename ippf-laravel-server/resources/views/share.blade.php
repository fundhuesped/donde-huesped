@extends('layouts.master')
@section('meta')
    <title>
      {{$p->establecimiento}} en {{$p->nombre_partido}} en VAMOS - IPPF</title>
    <meta name="description" content="{{$p->establecimiento}} en {{$p->nombre_partido}}, {{$p->calle}} {{$p->altura}}  ">
    <meta name="author" content="IPPF">
    <link rel="canonical" href="https://www.huesped.org.ar/donde/"/>
    <meta property='og:locale' content='es_LA'/>
    <meta property='og:title' content='IPPF'/>
    <meta property="og:description" ccontent="{{$p->establecimiento}} en {{$p->nombre_partido}}, {{$p->calle}} {{$p->altura}}  ">
    <meta property='og:url' content='https://www.huesped.org.ar/donde/share/{{$p->placeId}} '/>
    <meta property='og:site_name' content='IPPF'/>
    <meta property='og:type' content='website'/>
    <meta property='og:image' content='{!! $p->image !!}'/>
    <meta property='fb:app_id' content='288554014895839' />
    <meta name="twitter:card" content="summary">
    <meta name='twitter:title' content='IPPF'/>
    <meta name="twitter:description" content="{{$p->establecimiento}} en {{$p->nombre_partido}}, {{$p->calle}} {{$p->altura}}  ">
    <meta name='twitter:url' content='https://www.huesped.org.ar/donde/share/{{$p->placeId}} '/>
    <meta name='twitter:image' content='{!! $p->image !!}'/>
    <meta name='twitter:site' content='@fundhuesped' />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
@stop

@section('content')




@stop


@section('js')
    <script>
    var url = "../#/detail/"+{{$p->placeId}};
        console.log("{{$p->establecimiento}}");
        console.log("{{$p->nombre_pais}}");
        console.log("{{$p->placeId}}");
      document.location.href=url;
    </script>
@stop
