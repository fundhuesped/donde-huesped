@extends('layouts.clear')
@section('meta')
<title>Fundación Huésped | donde.huesped.org.ar</title>
<meta name="description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos.">
<meta name="author" content="DONDE">
<link rel="canonical" href="https://donde.huesped.org.ar"/>
<meta property='og:locale' content='es_LA'/>
<meta property='og:title' content='Fundación Huésped | donde.huesped.org.ar'/>
<meta property="og:description" content="Conoce dónde hacerte la prueba de VIH y buscar condones gratis. También encuentra los vacunatorios y centros de infectología más cercanos." />
<meta property='og:url' content='https://donde.huesped.org.ar'/>
<meta property='og:site_name' content='DONDE'/>
<meta property='og:type' content='website'/>
<meta property='og:image' content='https://donde.huesped.org.ar/img/icon/apple-touch-icon-152x152.png'/>
<meta property='fb:app_id' content='459717130793708' />
<meta name="twitter:card" content="summary">
<meta name='twitter:title' content='Fundación Huésped | donde.huesped.org.ar'/>
<meta name="twitter:description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos." />
<meta name='twitter:url' content='https://donde.huesped.org.ar'/>
<meta name='twitter:image' content='https://donde.huesped.org.ar/img/icon/apple-touch-icon-152x152.png'/>
<meta name='twitter:site' content='@fundhuesped' />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
@stop

@section('content')
@include('navbar')
<div class="home no-page valign-demo valign-wrapper">
    <div class="row valign full-width">
        <div class="col s12">
            <br>
            <h2>Be Right Back</h2>
            @if (config('app.debug') == true)
            <div class="row valign full-width">
                <div class="row">
                    <div class="col s12 error-container">
                        <p> <b>Detalles tecnicos</b></p>
                        <p>{{ $exception->getCode() }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 error-container">
                        <h6>{{ $exception->getMessage() }}</h6>
                        <p> <small> {{$exception}}</small></p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@stop

@section('js')
@stop