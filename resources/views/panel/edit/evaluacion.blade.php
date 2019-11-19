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
      <table class="bordered striped responsive-table" style="word-wrap:break-word;">
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
            <img ng-show="evaluation.service == 'condones' " alt="Este lugar distribuye condones" src="../../images/preservativos.png">
            <img ng-show="evaluation.service == 'prueba' " alt="Este lugar puede hacer prueba de HIV" src="../../images/test.png" >
            <img ng-show="evaluation.service == 'vacunatorio' " alt="Este lugar cuenta con Vacunatorio" src="../../images/vacunatorios.png" >
            <img ng-show="evaluation.service == 'ile' " alt="Este lugar cuenta con centro de Interrupcion Legal del Embarazo" src="../../images/ile.png" >
            <img ng-show="evaluation.service == 'ssr' " alt="Este lugar cuenta con Servicios de Salud Sexual y Reproductiva" src="../../images/salud.svg" >
            <img ng-show="evaluation.service == 'sssr' " alt="Este lugar cuenta con Servicios de Salud Sexual y Reproductiva" src="../../images/salud.svg" >
            <img ng-show="evaluation.service == 'cdi' " alt="Este lugar cuenta con atención de Infectología" src="../../images/infectologia.png" >
            <img ng-show="evaluation.service == 'infectologia' " alt="Este lugar cuenta con atención de Infectología" src="../../images/infectologia.png" >
          </td>

          <td class="evaluation-panel-searched-body">
            <small><p ng-cloak ng-repeat="que_busca in evaluation.que_busca">
              [[que_busca]]</p></small>
          </td>
           <td class="evaluation-panel-received-body services2"><img src="/images/emojis/[[evaluation.voto]]active.png" alt="[[evaluation.voto]]"></td>


          <td class="evaluation-panel-comment-body"> <small>[[evaluation.comentario]]</small></td>

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
