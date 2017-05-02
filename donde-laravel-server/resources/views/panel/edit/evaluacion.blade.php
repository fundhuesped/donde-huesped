<nav>
    <div class="ng-cloak nav-wrapper"  ng-cloak ng-hide="loadingPrev">
        <div class="input-field">
          <input type="search" ng-model="searchText" placeholder="Escribí acá para buscar dentro en los comentarios">
          <label for="searchText"><i class="mdi-action-search"></i></label>
        </div>
    </div>
  </nav>

  <div class="card-panel">
    <div class="card-panel">
       <span class="card-title">Filtro por Servicios</span>
       <br>
       <div class="row">
         <div class="col s12 right-align">
           <b>Exportar CSV</b>
           <a target="_self" href="../../panel/importer/eval-export/[[id]]" ng-click="" class="waves-effect waves-light btn-floating red">
             <i class="mdi-file-file-download left"></i>
           </a>
         </div>
       </div>
       <div class="row">
      <div ng-repeat="service in services">
          <div class="col s2">
              <input type="checkbox" id="[[service.shortname]]" ng-checked="exists(service.shortname, selected)" ng-click="toggle(service.shortname, selected)"/>
                <label for="[[service.shortname]]">[[service.name]]</label>
        </div>
    </div>
    </div>
  </div>
      <table class="bordered striped responsive-table" style="word-wrap:break-word; table-layout: fixed;">
        <thead ng-cloak ng-hide="loadingPost">
          <tr>
           <th class="evaluation-panel-searched-header">¿Qué buscó?</th>
           <th class="evaluation-panel-received-header">¿Se lo dieron?</th>
           <th class="evaluation-panel-info-header">Información clara</th>
           <th class="evaluation-panel-privacy-header">Privacidad</th>
           <th class="evaluation-panel-age-header">Edad</th>
           <th class="evaluation-panel-genre-header">Género</th>
           <th class="evaluation-panel-vote-header">Puntuación</th>
           <th class="evaluation-panel-comment-header">Comentario</th>
           <th style="width:60px;"></th>
         </tr>
       </thead>
       <tbody>
        <tr ng-cloak ng-hide="loadingPost">
        <tr ng-cloak ng-hide="loadingPost" ng-repeat="evaluation in evaluationList | filter:searchText | filter:serviceFilter">
          <td class="evaluation-panel-searched-body">[[evaluation.que_busca]]</td>
          <td class="evaluation-panel-received-body">[[evaluation.le_dieron]]</td>
          <td class="evaluation-panel-info-body">[[evaluation.info_ok]]</td>
          <td class="evaluation-panel-privacy-body">[[evaluation.privacidad_ok]]</td>
          <td class="evaluation-panel-age-body">[[evaluation.edad]]</td>
          <td class="evaluation-panel-genre-body">[[evaluation.genero]]</td>
          <td class="evaluation-panel-vote-body">
            <img ng-show="[[evaluation.voto]]" class="panel-evaluation-activos" alt="" src="../../images/emojis/[[evaluation.voto]]active.png">
          </td>
          <td class="evaluation-panel-comment-body">[[evaluation.comentario]]</td>


          <td class="actions">
            <a target="_self" ng-hide="evaluation.aprobado === 1" ng-click="voteYes(evaluation)" class="waves-effect waves-light btn-floating">
              <i class="mdi-action-done left"></i>
            </a>
            <a target="_self" ng-hide="evaluation.aprobado === 0" ng-click="voteNo(evaluation)" class="waves-effect waves-light btn-floating">
              <i class="mdi-av-not-interested left"></i>
            </a>
          </td>

        </tr>

      </tbody>
    </table>
  </div>
