@extends('layouts.master')
@section('meta')
    <title> {{$p->establecimiento}} @ {{$p->nombre_partido}} - @lang('page_title')</title>
    <meta name="description" content="{{$p->establecimiento}} en {{$p->nombre_ciudad}}, {{$p->calle}} {{$p->altura}}  ">
    <meta name="author" content="@lang('page_title')">
    <link rel="canonical" href="https://vamoslac.org"/>
    <meta property='og:locale' content='es_LA'/>
    <meta property='og:title' content='VAMOS'/>
    <meta property="og:description" ccontent="{{$p->establecimiento}} en {{$p->nombre_ciudad}}, {{$p->calle}} {{$p->altura}}  ">
    <meta property='og:url' content='https://vamoslac.org/share/{{$p->placeId}} '/>
    <meta property='og:site_name' content="@lang('page_title')"/>
    <meta property='og:type' content='website'/>
    <meta property='og:image' content='{!! $p->image !!}'/>
    <meta property='fb:app_id' content='288554014895839' />
    <meta name="twitter:card" content="summary">
    <meta property="og:description" content="@lang('site.seo_meta_description_content')" />
    <meta name="twitter:description" content="{{$p->establecimiento}} en {{$p->nombre_ciudad}}, {{$p->calle}} {{$p->altura}}  ">
    <meta name='twitter:url' content='https://vamoslac.org/share/{{$p->placeId}} '/>
    <meta name='twitter:image' content='{!! $p->image !!}'/>
    <meta name='twitter:site' content='@vamoslac' />
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
