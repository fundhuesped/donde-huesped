<div id="rejected" ng-controller="tableController" ng-init="init('rejectedplaces','establecimiento')" class="col s12">

  <div class="section navigate row">
    <h3 class="title"  ng-cloak ng-hide="loadingPrev" translate="panel_disapproved_summary_1" translate-values="{rejectedplaces : '[[rejectedplaces.length]]'}"></h3>
    <h3 ng-cloak ng-show="loadingPrev" translate="panel_disapproved_loading_label"></h3>
    <div ng-cloak ng-show="loadingPrev" class="progress">
      <div class="indeterminate"></div>
    </div>
  </div>

  <nav>
    <div class="ng-cloak nav-wrapper" ng-cloak ng-hide="loadingPrev">
      <div class="input-field">
        <input type="search" ng-model="search" placeholder="[['panel_table_filter' | translate]]" ng-change="searchValue()"/>
        <label for="search"><i class="mdi-action-search"></i></label>
      </div>
    </div>
  </nav>

  <div class="mt-3 row">
    <div class="col s2">
      <a class="waves-effect waves-light btn btn-small wow animated" ng-class="{'disabled': currentPage == 0}" ng-click="previous()">
        <i class="mdi-navigation-chevron-left left"></i>
        <span translate="previous"></span>
      </a>
    </div>
    <div class="col s8">
      <h4>Página [[currentPage+1]]/[[totalPages]]</h4>
    </div>
    <div class="col s2">
      <a class="waves-effect waves-light btn btn-small wow animated" ng-class="{'disabled': currentPage >= filteredDataTable.length/pageSize - 1}" ng-click="next()">
        <span translate="next"></span>
        <i class="mdi-navigation-chevron-right right"></i>
      </a>
    </div>
  </div>

  <div class="mt-1 row">
    <h6 ng-if="search" translate="total_results" translate-values="{values:'[[filteredDataTable.length]]'}"></h6>
  </div>

  <div class="section copy row">
    <div class="col s12 m12 ">
      <table class="bordered striped responsive-table orderded">
        <thead>
          <tr ng-cloak ng-hide="loadingPrev">
            <th ng-click="orderDataTable('establecimiento')" data-field="establecimiento" translate="establishment"></th>
            <th ng-click="orderDataTable('nombre_ciudad')" data-field="nombre_ciudad">
              <span translate="panel_places_columntable_5"></span>, <span translate="district"></span>, <span translate="state"></span>, <span translate="country"></span>
            </th>
            <th ng-click="orderDataTable('calle')" data-field="direccion" translate="street_address"></th>
            <th translate="actions"></th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="place in (filteredDataTable | startFrom:currentPage*pageSize |  limitTo:pageSize) track by $index">
            <td>
              [[place.establecimiento]]
            </td>
            <td>[[place.nombre_ciudad]], [[place.nombre_partido]], [[place.nombre_provincia]], [[place.nombre_pais]]</td>
            <td>[[place.calle]] [[place.altura]] [[place.cruce]]</td>
            <td class="actions">
              <a target="_blank" ng-href="panel/places/[[place.placeId]]" class="waves-effect waves-light btn-floating orange" title="[['edit'|translate]]"><i class="mdi-content-create left"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>