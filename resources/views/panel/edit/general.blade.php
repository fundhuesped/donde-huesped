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
    <div class="input-field col s12">
      <input disabled id="nombre_pais" type="text" name="nombre_pais" class="validate" ng-model="place.nombre_pais" ng-change="formChange()">
      <label for="nombre_pais" translate="country"></label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input disabled id="nombre_provincia" type="text" name="nombre_provincia" class="validate" ng-model="place.nombre_provincia" ng-change="formChange()">
      <label for="nombre_provincia" translate="state"></label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input disabled id="nombre_partido" type="text" name="nombre_partido" class="validate" ng-model="place.nombre_partido" ng-change="formChange()">
      <label for="nombre_partido" translate="district"></label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input disabled id="nombre_ciudad" type="text" name="nombre_ciudad" class="validate" ng-model="place.nombre_ciudad" ng-change="formChange()">
      <label for="nombre_partido" translate="panel_places_columntable_5"></label>
    </div>
  </div>

  <!-- SELECT COUNTRY -->
  <select class=""
  ng-change="showProvince()" ng-model="place.idPais"
  ng-options="v.id as v.nombre_pais for v in countries" material-select watch>
  <option value="" disabled selected="selected" translate="select_country"></option>
</select>

<!--SELECT PROVINCE -->
<select class=""
ng-change="showPartidos()"  ng-model="place.idProvincia"
ng-options="item.id as item.nombre_provincia for item in provinces track by item.id" material-select watch>
<option value="" selected translate="select_state"></option>
</select>

<!--SELECT PARTY -->
<select class=""
ng-change="loadCity()" ng-model="place.idPartido"
ng-disabled= '!partidoOn'
ng-options="p.id as p.nombre_partido for p in parties track by p.id" material-select watch>
<option value="" selected translate="select_department"></option>
</select>

<!--SELECT CITY -->
<select class=""
ng-model="place.ciudad"
ng-change="trackCiudad()"
ng-disabled="!showCity"
ng-options="c as c.nombre_ciudad for c in cities track by c.id" material-select watch>
<option value="" selected translate="select_city"></option>
</select>


<div class="row">
  <div class="input-field col s12">
    <input id="otra_ciudad" type="text" name="otra_ciudad" class="validate"
    ng-model="place.otra_ciudad" ng-change="formChange()">
    <label for="otra_ciudad" translate="panel_detail_general_seggest"></label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <input id="barrio_localidad" type="text" name="barrio_localidad" class="validate" ng-model="place.barrio_localidad" ng-change="formChange()">
    <label for="barrio_localidad" translate="neighborhood"></label>
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
