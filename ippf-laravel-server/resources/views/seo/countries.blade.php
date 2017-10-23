@extends('layouts.master')
@section('meta')
<div ng-app="dondev2App">
<!--title translate="seo_countries_headertitle"></title-->
<title>VAMOS | vamoslac.org</title>
<meta name="google-site-verification" content="RQh3eES_sArPYfFybCM87HsV6mbwmttWlAIk-Upf1EQ" />
<meta name="description" content="@lang('site.seo_meta_description_content')">
<meta name="author" content="@lang('site.seo_meta_author_content')">
<link rel="canonical" href="@lang('site.seo_meta_canonicallink')"/>
<meta property='og:locale' content="@lang('site.seo_meta_property_local')"/>
<meta property='og:title' content="@lang('site.seo_meta_property_title')"/>
<meta property="og:description" content="@lang('site.seo_meta_property_description')" />

@stop

@section('content')
<link rel="stylesheet" href="resume/styles/resume.css">
  <div ng-controller="countryListController">

  </div>
  @include('navbar')
  <div class="container home new-home ">
      <div class = "container " ng-view></div>
  </div>
</div>

@include('acerca')

@stop

@section('js')
  {!!Html::script('bower_components/materialize/dist/js/materialize.min.js')!!}
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
  {!!Html::script('bower_components/angularjs-socialshare/dist/angular-socialshare.min.js')!!}
  {!!Html::script('bower_components/angular-recaptcha/release/angular-recaptcha.js')!!}
  {!!Html::script('bower_components/ng-text-truncate/ng-text-truncate.js')!!}
  {!!Html::script('bower_components/angular-translate/angular-translate.js')!!}
  {!!Html::script('scripts/translations/es.js')!!}
  {!!Html::script('scripts/translations/br.js')!!}
  {!!Html::script('scripts/translations/en.js')!!}
  {!!Html::script('scripts/home/app.js')!!}
  {!!Html::script('scripts/home/controllers/home/controller.js')!!}
  {!!Html::script('scripts/home/controllers/acerca/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-list/controller.js')!!}
  {!!Html::script('scripts/home/controllers/country-list/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-map/controller.js')!!}
  {!!Html::script('scripts/home/controllers/city-map/controller2.js')!!}
  {!!Html::script('scripts/home/controllers/locate-list/controller.js')!!}
  {!!Html::script('scripts/home/controllers/locate-map/controller.js')!!}
  {!!Html::script('scripts/home/controllers/map/controller.js')!!}
  {!!Html::script('scripts/home/controllers/location/controller.js')!!}
  {!!Html::script('scripts/home/controllers/suggest-location/controller.js')!!}
  {!!Html::script('scripts/home/controllers/party-list/controller.js')!!}
  {!!Html::script('scripts/home/controllers/evaluation/controller.js')!!}
  {!!Html::script('scripts/home/services/places.js')!!}
  {!!Html::script('scripts/home/services/copy.js')!!}

<script>
$(document).ready(function() {
    $('select').material_select();
  });
</script>
@stop
