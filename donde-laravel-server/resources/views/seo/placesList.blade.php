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
      <a href="{{ url('/#/') }}" class="brand-logo"><img class="logoTop" src="/images/HUESPED_logo_donde_RGB-07_cr.png"> </a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
      <ul class="right hide-on-med-and-down">
           <li><a class="modal-trigger" href="#modal1"><i class="mdi-action-info"></i></a></li>
           <li><a class="modal-trigger" href="/#/localizar/all/listado"><i class="mdi-maps-place left"></i></a></li>
           <li><a class="" href="/form"><i class="mdi-content-add-circle-outline"></i></a></li>
           <li><a class="" href="listado-paises"><i class="mdi-action-language"></i></a></li>
      </ul>
      
      <ul ng-show="navigating"  class="left wow fadeIn">
           <li><a href="{{ url('/#/') }}"> <i class="mdi-navigation-chevron-left right"></i></a></li>
	        <li>INICIO</li>
      </ul>

      <ul class="side-nav" id="mobile-demo">
          <li><a href="#/acerca">
            <i class="mdi-action-info left"></i>Información
            </a>
          </li>
          <li><a href="#/localizar/all/listado">
            <i class="mdi-maps-place left"></i>Cercanos</a></li>
          <li><a href="form">
            <i class="mdi-content-add-circle-outline left"></i>
            Sugerir</a>
          </li>

      </ul>
    </div>
  </nav>





  <div class="result-seo">
  	<div class="Aligner">
  		<b>{{$cantidad}} {{$resu['title']}}</b>
  	</div>

  	<div class="Aligner">
  		<div class="Aligner-item Aligner-item--top"><img width="50px" src="/images/{{$resu['icon']}}"></div>
  		<div class="Aligner-item">
  			<span class="text-seo"><b>En {{$partido}}</span>, <span class="text-seo">{{$provincia}}</span></b>
  		</div>
  	</div>


</div>

@if (count($places) > 0 )
<div class="container">
	<table class="striped" >
		<thead>
			<th>Direccion</th>
			<th>Lugar</th>
			<th>Horario</th>
			<th>Responsable</th>
			<th>Telefono</th>
		</thead>
		<tbody>
			@foreach ($places as $p)
			<tr>
				<td><a class="item-seo" href="/share/{{$p->placeId}}">{{$p->calle}}</a></td>
				<td><a class="item-seo" href="/share/{{$p->placeId}}">{{$p->establecimiento}}</a></td>
				<td><a class="item-seo" href="/share/{{$p->placeId}}">{{$p->horario}}</a></td>
				<td><a class="item-seo" href="/share/{{$p->placeId}}">{{$p->responsable}}</a></td>
				<td><a class="item-seo" href="/share/{{$p->placeId}}">{{$p->telefono}}</a></td>
			</tr>	
			@endforeach
		</tbody>

	</table>
</div>

@else
<div class="container option-seo">
	<div class="centrada-seo">
		<a href="{{ url('listado-paises') }}" class="waves-effect waves-light btn btn-seo">
			<i class="mdi-navigation-chevron-right right"></i>
			<i class="mdi-action-search left"></i>Nueva búsqueda</a>
		</div>

		<div class="centrada-seo">
			<a href="{{ url('/form') }}" class="waves-effect waves-light btn btn-seo">
				<i class="mdi-navigation-chevron-right right"></i>
				<i class="mdi-content-add-circle left"></i>Sugerir lugar</a>
			</div>	
		</div>
@endif


@include('acerca')

@stop