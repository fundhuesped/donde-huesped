@extends('layouts.master')
@section('meta')

<title> 
  Dónde <?php echo html_entity_decode($resu['titleCopySeo']);?> en 
  <?php echo html_entity_decode($pais)." . ".html_entity_decode($provincia)." , ".html_entity_decode($partido)." , ".html_entity_decode($ciudad); ?> | Fundación Huésped
</title>
<meta name="description" content="@lang('site.seo_meta_description_content_2') <?php echo html_entity_decode($resu['descriptionCopy']);?> @lang('site.on') <?php echo html_entity_decode($pais)." . ".html_entity_decode($provincia)." , ".html_entity_decode($partido)." , ".html_entity_decode($ciudad); ?>">
<meta name="author" content="@lang('site.seo_meta_author_content')">
<link rel="canonical" href="@lang('site.seo_meta_canonicallink')"/>
<meta property='og:locale' content="@lang('site.seo_meta_property_local')"/>
<meta property='og:title' content="Dónde <?php echo html_entity_decode($resu['titleCopySeo']);?> en 
<?php echo html_entity_decode($pais)." . ".html_entity_decode($provincia)." , ".html_entity_decode($partido)." , ".html_entity_decode($ciudad); ?> | Fundación Huésped"/>
<meta property="og:description" content="@lang('site.seo_meta_placelist_title_1') <?php echo html_entity_decode($resu['descriptionCopy']);?> @lang('site.on') <?php echo html_entity_decode($pais)." . ".html_entity_decode($provincia)." , ".html_entity_decode($partido)." , ".html_entity_decode($ciudad); ?>" />

@stop

@section('content')

<div ng-app="dondeDataVizApp">
  @include('navbar')

  <div ng-controller="HomeCtrl">
    @if (count($places) > 0 )
    <div class="result-seo">
      <div class="Aligner">
        @if ( count($places) < 2 )
        {{$cantidad}} {{$resu['preCopyFoundSingle']}} &nbsp<b>{{$resu['newServiceTitleSingle']}}</b> &nbsp @lang('site.on')
        @else
        {{$cantidad}} {{$resu['preCopyFound']}} &nbsp<b>{{$resu['newServiceTitle']}}</b> &nbsp @lang('site.on')
        @endif
      </div>


      <div class="Aligner">
        <div class="Aligner-item Aligner-item--top"><img width="50px" src="/resume/images/{{$resu['icon']}}" alt="servicio"></div>
        <div class="Aligner-item">
          <b><span class="text-seo">{{$ciudad}}</span>, <span class="text-seo">{{$partido}}</span>, <span class="text-seo">{{$provincia}}</span></b>
        </div>
      </div>

    </div>

    <div class="container">
      <table class="striped">
        <thead>
          <th>@lang('site.street_address')</th>
          <th>@lang('site.place')</th>
          <th>@lang('site.schedule')</th>
          <th>@lang('site.responsable')</th>
          <th>@lang('site.tel')</th>
        </thead>
        <tbody>
          @foreach ($places as $p)
          <tr>
            @if (isset($p->altura) && ($p->altura != "" ) && ($p->altura != " " ) )
            <td><a class="item-seo" href="/share/es/{{$p->placeId}}">{{$p->calle}}  {{$p->altura}}</a></td>
            @else
            <td><a class="item-seo" href="/share/es/{{$p->placeId}}">{{$p->calle}} Sin número</a></td>
            @endif

            <td><a class="item-seo" href="/share/es/{{$p->placeId}}">{{$p->establecimiento}}</a></td>
            <td><a class="item-seo" href="/share/es/{{$p->placeId}}">{{$p->horario}}</a></td>
            <td><a class="item-seo" href="/share/es/{{$p->placeId}}">{{$p->responsable}}</a></td>
            <td><a class="item-seo" href="/share/es/{{$p->placeId}}">{{$p->telefono}}</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <br>
    <div class="container option-seo">
      <div class="centrada-seo">
        <a href="{{ url('/form') }}" class="waves-effect waves-light btn btn-seo">
          <i class="mdi-navigation-chevron-right right"></i>
          <i class="mdi-content-add-circle left"></i>@lang('site.suggest_place')
        </a>
      </div>
    </div>

    @else
    <div class="result-seo">
      <div class="Aligner">
        {{$resu['titleCopyNotFound']}} &nbsp <b>{{$resu['newServiceTitle']}}</b> &nbsp @lang('site.on')
      </div>

      <div class="Aligner">
        <div class="Aligner-item Aligner-item--top"><img width="50px" src="/images/{{$resu['icon']}}" alt="servicio"></div>
        <div class="Aligner-item">
          <b><span class="text-seo">{{$partido}}</span>, <span class="text-seo">{{$provincia}}</span></b>
        </div>
      </div>
    </div>

    <div class="container option-seo">
      <div class="centrada-seo">
        <a href="{{ url('listado-paises') }}" class="waves-effect waves-light btn btn-seo">
          <i class="mdi-navigation-chevron-right right"></i>
          <i class="mdi-action-search left"></i>@lang('site.seo_placeslist_new_search')
        </a>
      </div>
      <div class="centrada-seo">
        <a href="{{ url('/form') }}" class="waves-effect waves-light btn btn-seo">
          <i class="mdi-navigation-chevron-right right"></i>
          <i class="mdi-content-add-circle left"></i>@lang('site.suggest_place')
        </a>
      </div>
    </div>
    @endif
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