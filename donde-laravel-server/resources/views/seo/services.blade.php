@extends('layouts.clear')
@section('meta')
<title>donde.huesped.org.ar | Fundación Huésped</title>
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

<nav>
	<div class="nav-wrapper">
		<a href="{{ url('/#/') }}" class="brand-logo">
		<img class="logoTop" src="/donde/public_html/donde/images/HUESPED_logo_donde_RGB-07_cr.png"> </a>
	</div>
</nav>


<div class="boxLanding">
	<ul class="collection">
		<!-- Header Tabble -->
		<li class="collection-item collection-landing">
			<div class="row valign">
				<div class="row center-align">
					<span class="distanceLanding"><b>{{$pais}}</b> > <b>{{$provincia}}</b> > <b>{{$partido}}</b></span>
				</div>
			</div>
		</li>
		<li class="collection-item collection-landing">
			<div class="row valign">
				<div class="row center-align">
					<i class="mdi-hardware-keyboard-arrow-down"></i><span class="distanceLanding"><b>Selecciona un Distrito</b></span>
				</div>
			</div>
		</li>
		<div>
			<div class="container">
				<table class="highlight centered">
				<div class="row">
					@foreach ($allElements as $key => $service)
					    <div class="col s6 m6 l6" style="padding: 5%;">
					        <a href="servicio/{{serialize($service)}}">
					        	<div class="center promo">
					             <img width="70px" src="/donde/public_html/donde/images/{{$service['icon']}}">
					            <p class="promo-caption">{{$service['title']}}</p>
					        	</div>
					        </a>
					    </div>
					@endforeach
				</div>
			</div>
		</div>
	</ul>
</div>

@include('acerca')

@stop


