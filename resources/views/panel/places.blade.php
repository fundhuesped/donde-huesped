@extends('layouts.panel-master')

@section('content')
  <div class="home" ng-controller="panelplaceController"
  ng-init="placeId={{$placeId}}">

  <div ng-cloak ng-show="loading">
     <div class="progress">
              <div class="indeterminate"></div>
         </div>
  </div>
  <div  class="ng-cloak section navigate row wow fadeIn" ng-cloak ng-hide="loading">
    [[establecimiento]]
    <div class="section search search-form row ">
        <div class="row">
            <div class="col s12">
                <div class="row">
                  <div class="col s12 m12">

                    <div class="row">
    <div class="col s12">
        <ul class="tabs" tabs>
            <li class="tab col s2"><a class="active" href="#general">General</a></li>
            <li class="tab col s2"><a href="#Prueba">Prueba</a></li>
            <li class="tab col s2"><a href="#test3">Distribucion</a></li>
            <li class="tab col s2"><a href="#test4">Infecciosas</a></li>
            <li class="tab col s2"><a href="#test4">Vacunacion</a></li>
 
        </ul>
    </div>
    <div id="general" class="col s12">

          @include('panel/edit/general')

    </div>
    <!-- `vacunatorio` tinyint DEFAULT NULL,
  `infectologia` tinyint DEFAULT NULL,
  `condones` tinyint DEFAULT NULL,
  `prueba` tinyint DEFAULT NULL, -->
    <div id="Prueba" class="col s12"></div>
        @include('panel/edit/prueba')    
    </div>
    </div>

                  

            </div>
        </div>
    </div>
  </div>
</div>
@stop

@section('js')

  {!!Html::script('libs/trabex-genosha-geolibs.js')!!}
  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/places/controller.js')!!}
  {!!Html::script('scripts/home/services/places.js')!!}

@stop
