<div id="imports" ng-controller="tableController" ng-init="init('tagsImportaciones','-modification_date')" class="col s12">
  
  <div class="section navigate row">
    <h3 class="title"  ng-cloak ng-hide="loadingPrev" translate="panel_imports_summary_1" translate-values="{imports : '[[tagsImportaciones.length]]'}">
    </h3>
    <h3 ng-cloak ng-show="loading" translate="loading_label"></h3>
    <div ng-cloak ng-show="loading" class="progress">
      <div class="indeterminate"></div>
    </div>
  </div>

  <nav>
    <div class="ng-cloak nav-wrapper"  ng-cloak ng-hide="loading">
      <div class="input-field">
        <input type="search" ng-model="search" placeholder="[['panel_table_filter' | translate]]" ng-change="searchValue()">
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

  <div class="section">
    <div class="card-panel teal lighten-2" translate="panel_imports_disabledbutton_label"></div>
    <div class="col s12 m12 ">
      <table class="bordered striped responsive-table responsive-table orderded">
        <thead>
          <tr ng-cloak ng-hide="loadingPrev">
            <th ng-click="orderDataTable('csvname')" data-field="csvname" translate="panel_imports_csv_th"></th>
            <th ng-click="orderDataTable('entry_type')" data-field="descripcion" translate="description"></th>
            <th ng-click="orderDataTable('modification_date')" data-field="fecha" translate="date"></th>
            <th ng-click="orderDataTable('user_name')" data-field="usuario" translate="user"></th>
            <th data-field="action" translate="panel_imports_download_th"></th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="tag in (filteredDataTable | startFrom:currentPage*pageSize |  limitTo:pageSize) track by $index">
            <td>[[tag.csvname]]</td>
            <td>[[tag.entry_type]]</td>
            <td>[[tag.modification_date]]</td>
            <td>[[tag.user_name]]</td>
            <td class="actions">
              <a target="_self" id="exportbutton_[[tag.id]]" ng-class="{'disabled': tag.countPlaces == 0}" ng-href="panel/tagsimportaciones/[[tag.id]]" class="waves-effect waves-light btn-floating red" title="[['panel_imports_download_th'|translate]]"><i class="mdi-file-file-download left"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>