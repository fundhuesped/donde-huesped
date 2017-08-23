@extends('layouts.panel-master')
@section('meta')
<title>ippf-staging.com.ar | Fundación Huésped</title>
<meta name="description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos.">
<meta name="author" content="Fundación Huésped">
<link rel="canonical" href="http://www.huesped.org.ar/donde/"/>
<meta property='og:locale' content='es_LA'/>
<meta property='og:title' content='ippf-staging.com.ar | Fundación Huésped'/>
<meta property="og:description" content="Conoce dónde hacerte la prueba de VIH y buscar condones gratis. También encuentra los vacunatorios y centros de infectología más cercanos." />
<meta property='og:url' content='http://www.huesped.org.ar/donde/'/>
<meta property='og:site_name' content='Fundación Huésped'/>
<meta property='og:type' content='website'/>
<meta property='og:image' content='http://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
<meta property='fb:app_id' content='459717130793708' />
<meta name="twitter:card" content="summary">
<meta name='twitter:title' content='ippf-staging.com.ar | Fundación Huésped'/>
<meta name="twitter:description" content="Conocé dónde hacerte el test de VIH o dónde conseguir preservativos gratuitos." />
<meta name='twitter:url' content='http://www.huesped.org.ar/donde/'/>
<meta name='twitter:image' content='http://www.huesped.org.ar/donde/img/icon/apple-touch-icon-152x152.png'/>
<meta name='twitter:site' content='@fundhuesped' />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
@stop

@section('content')
<div >
	<div class="home no-page valign-demo valign-wrapper">
		<div class="row valign full-width">
			<div class="col s12">
				<br>
				<h2>Ha ocurrido un problema en el proceso de importación.</h2>
				<p>
					:-(, encontramos un problema al importar, si vuelve a pasar contacta a los administradores de plataforma
				</p>
				<div class="row valign full-width">
					<div class="row">				
						<div class="col s12 error-container">
							<p> <b>Detalles tecnicos: (formateado) </b></p>
							<p>{{$formated}}</p>
						</div>
					</div>
					<div class="row">				
						<div class="col s12 error-container">
							<p> <b>Detalles tecnicos: (full exception ) </b></p>
							<p>{{$exception }}</p>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
</div>
</div>

</div>
</div>

@stop


@section('js')

@stop
