@extends('layouts.master')
@section('meta')

<title>Términos y Condiciones - #Dónde | Fundación Huésped</title>
<meta name="google-site-verification" content="RQh3eES_sArPYfFybCM87HsV6mbwmttWlAIk-Upf1EQ" />

<?php
$lang = \Session::get('lang');
\App::setlocale($lang);
?>


<meta name="author" content="Fundación Huésped">
<link rel="canonical" href="https://donde.huesped.org.ar/"/>
<meta property='og:title' content="@lang('site.page_title')" />
<meta property="og:description" content="@lang('site.seo_meta_description_content')" />
<meta property='og:type' content="@lang('site.page_title')" />
<meta property='og:locale' content='es_LA'/>
<meta property='og:url' content='https://donde.huesped.org.ar/'/>
<meta property='og:site_name' content='DONDE'/>
<meta property='og:image' content='https://donde.huesped.org.ar/og.png'/>
<meta property='fb:app_id' content='1964173333831483' />
<meta name="twitter:card" content="summary">
<meta name='twitter:title' content="@lang('site.page_title')" />
<meta name="twitter:description" content="@lang('site.seo_meta_description_content')" />
<meta name='twitter:url' content='https://donde.huesped.org.ar/'/>
<meta name='twitter:image' content='https://donde.huesped.org.ar/og.png'/>
<meta name='twitter:site' content='@fundhuesped' />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
@stop


@section('content')
<div ng-app="dondev2App">

	@include('navbar')

    <div class="home new-home" ng-controller="formController">

     <!-- Terms & Conditions -->

     <div class="row">

			<div class="col s0 m3 center-align">

				<p></p>
			</div>

			<div class="col s12 m6 center-align  ">

				<a href='https://www.huesped.org.ar/' target="_blank">
					<img src="images/logo_huesped.png" width="40%" />
				</a>

			</div>

			<br />
			<br />
			<br />

			<h4 id="menu">Gracias por utilizar #Dónde.</h4>

			<br/>
</div>
<div class="row">
	<div class="col s0 m3">
		<p></p>
	</div>
	<div class="col s12 m6 left-align">
			<p>En #Dónde  podés encontrar en un mapa lugares que ofrecen diferentes servicios de salud sexual y reproductiva con información adicional como: tipo de servicio, dirección, teléfono, correo electrónico y sitio web, entre otros datos.
</p>
			<p>Las condiciones reales en los servicios pueden ser diferentes de los resultados que te dé la plataforma. Con tu participación y la de las demás personas que acceden podemos corregir y mejorar la información que ofrecemos. #Dónde es una fuente de referencia para las personas que la usan y son ellas las responsables de las decisiones que toman con la información que ofrecemos.</p>
			<p>Las personas que usan la plataforma pueden sugerir nuevos sitios. En Fundación Huésped recibimos la sugerencia y nos comunicamos para confirmar los datos, pedir más información y aprobar o rechazar la sugerencia.
</p>
			<p>También es posible evaluar la atención recibida en los servicios localizados mediante una encuesta anónima. Fundación Huésped no es responsable de las evaluaciones y comentarios realizados en #Dónde. Se eliminarán los comentarios que violen normas del país, revelen información privada o sensible, contengan publicidad o atenten contra los derechos humanos.

</p>
			<p>Las evaluaciones que realizan quienes usan la página se publican inmediatamente. Se muestra públicamente cuál es el servicio evaluado, el emoticón asignado y los comentarios. La información es recopilada para realizar acciones de incidencia política con el objetivo de mejorar el acceso a los servicios de salud. Los datos de contacto los utilizaremos para enviarte más información del trabajo de Fundación Huésped. Podrás darte de baja de nuestra lista de distribución cuando quieras.
</p>
			<p>Está permitido compartir la información incluida en #Dónde. También, difundir la plataforma por diferentes medios y usarla con fines no lucrativos personales, educativos, laborales u otros. Agradecemos siempre la mención de #Dónde y que nos informes sobre tu experiencia de uso. 
</p>
			<p>#Dónde no tiene fines comerciales y el uso es totalmente gratuito. Ninguna persona o institución puede usar la plataforma o sus funcionalidades con fines de lucro.
</p>
			<p>Ante cualquier consulta, podés comunicarte con Fundación Huésped a <a href="mailto:donde@huesped.org.ar"> donde@huesped.org.ar </a></p>
		
			

</div>
	</div>
		</div>
	</div>

</div>

@stop

@section('js')
<script
src="https://www.google.com/recaptcha/api.js?hl=es-419&onload=vcRecaptchaApiLoaded&render=explicit"
async defer
></script>
{!!Html::script('bower_components/materialize/dist/js/materialize.min.js')!!}
{!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
{!!Html::script('bower_components/angular-recaptcha/release/angular-recaptcha.min.js')!!}
{!!Html::script('bower_components/angular-translate/angular-translate.js')!!}
{!!Html::script('scripts/translations/es.js')!!}
{!!Html::script('scripts/translations/en.js')!!}
{!!Html::script('scripts/translations/br.js')!!}

{!!Html::script('scripts/form/app.js')!!}
{!!Html::script('scripts/form/controllers/form/controller.js')!!}
{!!Html::script('scripts/home/services/places.js')!!}

@stop
