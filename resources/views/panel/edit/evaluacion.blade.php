<nav>
    <div class="ng-cloak nav-wrapper"  ng-cloak ng-hide="loadingPrev">
        <div class="input-field">
          <input type="search" ng-model="searchText" placeholder="[['panel_detail_evaluation_filterserviceplaceholder' | translate]]">
          <label for="searchText"><i class="mdi-action-search"></i></label>
        </div>
    </div>
  </nav>

  <div class="card-panel">
    <div class="card-panel">
       <span class="card-title" translate="panel_detail_evaluation_filterservicelabel"></span>
       <br>
       <div class="row">
         <div class="col s12 right-align">
           <b translate="panel_evaluations_exportbutton"></b>
           <span target="_self" ng-click="exportEvaluationsFilterByService([[id]])" class="waves-effect waves-light btn-floating red">
             <i class="mdi-file-file-download left"></i>
           </span>
           <!--
           <a target="_self" href="../../panel/importer/eval-export/[[id]]" ng-click="" class="waves-effect waves-light btn-floating red">
             <i class="mdi-file-file-download left"></i>
           </a>
         -->
         </div>
       </div>
       <div class="row">
      <div ng-repeat="service in services">
          <div class="col s2">
              <input type="checkbox" id="[[service.code]]" ng-checked="exists(service.code, selected)" ng-click="toggle(service.code, selected)"/>
                <label for="[[service.code]]">[[service.label]]</label>
        </div>
    </div>
    </div>
  </div>
      <table class="bordered striped responsive-table break-word">
        <thead ng-cloak ng-hide="loadingPost">
          <tr>
            <th class="evaluation-panel-searched-header" translate="panel_detail_evaluation_th_1"></th>
            <th class="evaluation-panel-searched-header" translate="panel_detail_evaluation_th_2"></th>
            <th class="evaluation-panel-received-header" translate="panel_detail_evaluation_th_3"></th>
            <th class="evaluation-panel-vote-header" translate="panel_detail_evaluation_th_4"></th>
            <th class="evaluation-panel-comment-header" translate="panel_detail_evaluation_th_5"></th>
          </tr>
        </thead>
       <tbody>

        <tr ng-cloak ng-hide="loadingPost" ng-repeat="evaluation in evaluationList | filter:searchText">
          <td class="services2">
            <img ng-show="evaluation.service == 'condones'" title="Este lugar distribuye preservativos" alt="Este lugar distribuye preservativos" src="/images/condones.png">
            <img ng-show="evaluation.service == 'prueba'" title="Este lugar puede hacer prueba de HIV" alt="Este lugar puede hacer prueba de HIV" src="/images/prueba.png">
            <img ng-show="evaluation.service == 'vacunatorios'" title="Este lugar cuenta con centro vacunatorio" alt="Este lugar cuenta con centro vacunatorio" src="/images/vacunatorio.png">
            <img ng-show="evaluation.service == 'cdi'" title="Este lugar cuenta con centro de infectologia" alt="Este lugar cuenta con centro de infectologia" src="/images/infectologia.png">
            <img ng-show="evaluation.service == 'ile'" title="Este lugar cuenta con test rapido" alt="Este lugar cuenta con test rapido" src="/images/ile.png">
            <img ng-show="evaluation.service == 'ssr'" title="Este lugar cuenta con servicios de salud sexual y reproductiva" alt="Este lugar cuenta con servicios de salud sexual y reproductiva" src="/images/ssr.png">
          </td>

          <td class="evaluation-panel-searched-body">
            <small><p ng-cloak ng-repeat="que_busca in evaluation.que_busca">
            [[que_busca]]</p></small>
          </td>
          <td class="evaluation-panel-received-body services2"><img src="/images/emojis/[[evaluation.voto]]active.png" alt="[[evaluation.voto]]">
          </td>
          <td class="evaluation-panel-comment-body"> <small>[[evaluation.comentario]]</small></td>
          <td class="actions">
            <a target="_self" ng-hide="evaluation.aprobado === 1" ng-click="voteYes(evaluation)" class="waves-effect waves-light btn-floating green" title="[['approve'|translate]]">
              <i class="mdi-action-done left"></i>
            </a>
            <a target="_self" ng-hide="evaluation.aprobado === 0" ng-click="voteNo(evaluation)" class="waves-effect waves-light btn-floating red" title="[['reject'|translate]]">
              <i class="mdi-av-not-interested left"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>