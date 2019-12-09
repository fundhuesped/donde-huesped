  <form class="col s12 m6">

  <div class="row">
    <div class="input-field col s12">
      <input id="establecimiento" type="text" name="establecimiento" class="validate" ng-model="place.establecimiento"
      ng-change="formChange()">
      <label for="establecimiento" translate="establishment"></label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="tipo" type="text" name="tipo"
      class="validate" ng-model="place.tipo"
      ng-change="formChange()">
      <label for="tipo" translate="type"></label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="calle" type="text" name="calle" class="validate" ng-model="place.calle" ng-change="formChange()">
      <label for="calle" translate="street_address"></label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="altura" type="text" name="altura" class="validate" ng-model="place.altura" ng-change="formChange()">
      <label for="altura" translate="form_establishment_street_height"></label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="cruce" type="text" name="cruce" class="validate" ng-model="place.cruce" ng-change="formChange()">
      <label for="cruce" translate="form_establishment_street_intersection"></label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="piso_dpto" type="text" name="piso_dpto" class="validate" ng-model="place.piso_dpto" ng-change="formChange()">
      <label for="piso_dpto" translate="form_establishment_floor"></label>
    </div>
  </div>



  
<div class="row">
  <div class="col s12">
    </div>   
  <div class="input-field col s12">
    <h5 class="a-left"> Ubicado en </h5>
    <small><p class="left"> Escribi otra ciudad para cambiarla </p></small>
        <angucomplete-alt id="ciudad"
        required
        match-class="highlight"
        field-required="true"
        placeholder="[[place.nombre_ciudad]],[[place.nombre_partido]],[[place.nombre_provincia]]"
        selected-object="updateAddressComponents"
        input-changed="updatePlacePredictions"
        local-data="placesPredictions"
        title-field="nombre,departamento.nombre,provincia.nombre"
        description-field="twitter"
        search-fields="nombre"
        focus-out="locationOut()"
        required pattern="\S+.*"
        input-class="form-control form-control-small validate required"
        text-no-results="[[ 'autocomplete_no_result' | translate ]]"
        text-searching="[[ 'autocomplete_searching' | translate ]]"
        autocomplete="new-password">
        
        </angucomplete-alt>  
                

    
  </div>
</div>


<div class="row">
  <div class="input-field col s12">
    <textarea id="observacion" type="text"
    name="observacion"
    class="validate materialize-textarea" ng-model="place.observacion" ng-change="formChange()"></textarea>
    <label for="observacion" translate="observations"></label>
  </div>
</div>

<br/>

    <div class="row uploader-information">
      <div class="col s12">
          <h4 class="form-section-title" translate="uploader_info"></h4>
      </div>
      <div class="col s12" ng-if="!place.uploader_name && !place.uploader_email && !place.uploader_tel">
          <h5><span class="bold-type no-info" translate="no_uploader_information"></h5>
      </div>
      <div ng-if="place.uploader_name || place.uploader_email || place.uploader_tel">
          <div class="col s12">
              <p><span class="bold-type">[[ "name" | translate ]]:</span> [[place.uploader_name]]</h4>
          </div>
          <div class="col s12">
              <p><span class="bold-type">[[ "email" | translate ]]:</span> [[place.uploader_email]]</h4>
          </div>
          <div class="col s12">
              <p><span class="bold-type">[[ "tel" | translate ]]:</span> [[place.uploader_tel]]</h4>
          </div>
      </div>
    </div>

</form>


<div class="col s12 m6">
  <div class="row">

    <label translate="panel_detail_general_map_localization"></label>
    <input id="latitude" type="text" name="latitude"
    class="validate" ng-model="place.latitude" ng-change="onLatLonInputChange()">
    <input id="longitude" type="text" name="longitude" class="validate" ng-model="place.longitude" ng-change="onLatLonInputChange()">




    <ng-map id="mapEditor"
    lazy-init="true" zoom="14">
    <marker ng-repeat="pos in positions"

    position="[[pos.latitude]],[[pos.longitude]]"
    on-dragend="onDragEnd()"
    draggable="true">
  </marker>
</ng-map>


</br>

</div>
</div>
</div>
