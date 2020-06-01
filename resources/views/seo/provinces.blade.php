@extends('layouts.master')
@section('meta')
<title>donde.huesped.org.ar | Fundación Huésped</title>
<meta name="description" content="@lang('site.seo_meta_property_description_4') <?php echo html_entity_decode($pais); ?>">
<meta name="author" content="@lang('site.seo_meta_author_content')">
<link rel="canonical" href="@lang('site.seo_meta_canonicallink')"/>
<meta property='og:locale' content="@lang('site.seo_meta_property_local')"/>
<meta property='og:title' content="@lang('site.seo_meta_property_title')"/>
<meta property="og:description" content="@lang('site.seo_meta_property_description_2') <?php echo html_entity_decode($pais); ?> @lang('site.seo_meta_property_description_3')" />
@stop

@section('content')

<div ng-app="dondeDataVizApp">
  @include('navbar')

  <div ng-controller="HomeCtrl">
    <ul class="collection">
      <!-- Header Tabble -->
      <li class="collection-item collection-seo">
        <div class="row valign">
          <div class="row left-align">
            <span class="distanceLanding"><b class="text-seo">{{$pais}}</b></span>
          </div>
        </div>
      </li>
      <li class="collection-item collection-seo">
        <div class="row valign">
          <div class="row left-align">
            <i class="mdi-hardware-keyboard-arrow-down i-seo"></i> <span class="distanceLanding"><b>@lang('site.select_state')</b></span>
          </div>
        </div>
      </li>
      <div class="palcesLanding">
        <div class="container">
          <table class="highlight left">
            <tbody>
              @foreach ($provinces as $p)
              <tr>
                <td ><a class="item-seo" href="provincia/{{$p->nombre_provincia}}/partido">{{$p->nombre_provincia}}</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </ul>
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