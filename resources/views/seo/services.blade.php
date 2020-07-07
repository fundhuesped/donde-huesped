@extends('layouts.master')

@section('meta')

<title>donde.huesped.org.ar | Fundación Huésped</title>
<meta name="description" content="@lang('site.seo_meta_property_description_4') <?php echo html_entity_decode($pais)." . ".html_entity_decode($provincia)." , ".html_entity_decode($partido)." , ".html_entity_decode($ciudad); ?>">
<meta name="author" content="@lang('site.seo_meta_author_content')">
<link rel="canonical" href="@lang('site.seo_meta_canonicallink')"/>
<meta property='og:locale' content="@lang('site.seo_meta_property_local')"/>
<meta property='og:title' content="@lang('site.seo_meta_property_title')"/>
<meta property="og:description" content="@lang('site.seo_meta_property_description_2') <?php echo html_entity_decode($pais)." . ".html_entity_decode($provincia)." , ".html_entity_decode($partido)." , ".html_entity_decode($ciudad); ?> @lang('site.seo_meta_property_description_3')" />

@stop

@section('content')

<div ng-app="dondeDataVizApp">
  @include('navbar')

  <div ng-controller="HomeCtrl">
    <div class="boxLanding-seo">
      <ul class="collection">
        <li class="collection-item collection-seo">
          <div class="row valign">
            <div class="row left-align">
              <span>
                <b class="text-seo">{{$pais}}</b> > 
                <b class="text-seo">{{$provincia}}</b> > 
                <b class="text-seo">{{$partido}}</b> >
                <b class="text-seo">{{$ciudad}}</b>
              </span>
            </div>
          </div>
        </li>
        <li class="collection-item collection-seo">
          <div class="row valign ">
            <div class="Aligner-seo">
              <div class="Aligner-item Aligner-item--top"><i class="mdi-hardware-keyboard-arrow-down i-seo"></i></div>
              <div class="Aligner-item"><span><b>@lang('site.seo_services_whatareyoulookingfor_label')</b></span></div>
            </div>
          </div>
        </li>
        <div class="icon-seo">
          <div class="">
            <table class="highlight centered">
              <div class="row">
                @foreach ($allElements as $key => $service)
                <div class="col s6 m6 l6 grid-seo">
                  <a class="services-seo" href="servicio/{{$service['code']}}">
                    <div class="center promo">
                      <img width="70px" src="/resume/images/{{$service['icon']}}" alt="servicio">
                      <p class="item-seo">@lang($service['title'])</p>
                    </div>
                  </a>
                </div>
                @endforeach
              </div>
            </table>
          </div>
        </div>
      </ul>
    </div>
  </div>

  @include('acerca')
</div>

@stop

@section('js')
{{-- Includes --}}
{!!Html::script('bower_components/materialize/dist/js/materialize.min.js')!!}
{!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}
{!!Html::script('bower_components/angularjs-socialshare/dist/angular-socialshare.min.js')!!}
{!!Html::script('bower_components/angular-recaptcha/release/angular-recaptcha.js')!!}
{!!Html::script('bower_components/ng-text-truncate/ng-text-truncate.js')!!}
{!!Html::script('bower_components/angular-translate/angular-translate.js')!!}

{{-- Translates --}}
{!!Html::script('scripts/translations/es.js')!!}
{!!Html::script('scripts/translations/br.js')!!}
{!!Html::script('scripts/translations/en.js')!!}
{{-- AngularJs --}}
{!!Html::script('resume/scripts/app.js')!!}
{!!Html::script('resume/scripts/controllers/home.js')!!}

{{-- Servicios --}}
@stop