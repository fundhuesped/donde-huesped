@extends('layouts.panel-master')

@section('content')


    <div class="home panel" ng-controller="panelIndexController">
    <div class="row" >
    <div class="col s12">
        <ul class="tabs" tabs>
            <li class="tab col s3"><a class="active" href="#dashboard"><i class="small mdi-content-inbox"></i>Resumen</a></li>
            <li class="tab col s3"><a class="" href="#aprobar"><i class="small mdi-content-inbox"></i>Pendientes [['(' + penplaces.length + ')' || '(...)']]</a></li>
            <li class="tab col s3"><a href="#activos"> <i class="small mdi-action-done-all"></i>Activos [['(' + places.length + ')' || '(...)']]</a></li>
            <li class="tab col s3"><a href="#rejected"> <i class="small mdi-action-delete  "></i>Rechazados [['(' + rejectedplaces.length + ')' || '(...)']]</a></li>
        </ul>
    </div>
    @include('panel/home/dashboard')
    @include('panel/home/aprobar')  
    @include('panel/home/activos')
    @include('panel/home/desaprobados')  
 






  <!-- Modal Structure -->
  <div id="demoModal" class="modal">
      <div class="modal-content">
          <h4>¿Estas seguro qué deseás rechazar el siguiente lugar?</h4>
          <h3><strong>[[current.establecimiento]]</strong></h3>
          <h4><small>[[current.nombre_provincia]], [[current.nombre_localidad]]</small></h4>
          <hr/>
          <p>Una vez rechazado, podrás volver a agregarlo en "Rechazados"</p>
          <hr/>
      </div>
      <div class="modal-footer">
          <a href="" class=" modal-action modal-close
            waves-effect waves-green btn-flat">No</a>
          <a ng-click="removePlace()" href="" class=" modal-action waves-effect waves-green btn-flat">Si</a>
      </div>
  </div>

</div>

  @stop

@section('js')
    {!!Html::script('scripts/genosha-geolibs.js')!!}


  {!!Html::script('bower_components/ngmap/build/scripts/ng-map.min.js')!!}

  {!!Html::script('scripts/panel/app.js')!!}
  {!!Html::script('scripts/panel/controllers/index/controller.js')!!}
  {!!Html::script('scripts/home/services/places.js')!!}

@stop
