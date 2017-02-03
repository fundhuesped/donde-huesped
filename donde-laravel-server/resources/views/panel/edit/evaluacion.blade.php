  <nav>
    <div class="ng-cloak nav-wrapper"  ng-cloak ng-hide="loadingPrev">
      <form>
        <div class="input-field">
          <input type="search" ng-model="search" required
          placeholder="Escribí acá para buscar dentro en los comentarios">
          <label for="search"><i class="mdi-action-search"></i></label>
        </div>
      </form>
    </div>
  </nav>

      <table class="bordered striped responsive-table" style="word-wrap:break-word; table-layout: fixed;">
        <thead ng-cloak ng-hide="loadingPost">
          <tr>
           <th class="evaluation-panel-searched">¿Qué buscó?</th>
           <th class="evaluation-panel-received">¿Se lo dieron?</th>
           <th class="evaluation-panel-info">Información clara</th>
           <th class="evaluation-panel-privacy">Privacidad</th>
           <th class="evaluation-panel-age">Edad</th>
           <th class="evaluation-panel-genre">Género</th>
           <th class="evaluation-panel-vote">Puntuación</th>
           <th class="evaluation-panel-comment">Comentario</th>
           <th style="width:60px;"></th>
         </tr>
       </thead>
       <tbody>
        <tr ng-cloak ng-hide="loadingPost">
        <tr ng-cloak ng-hide="loadingPost" ng-repeat="evaluation in evaluationList">
          <td class="evaluation-panel-searched">[[evaluation.que_busca]]</td>
          <td class="evaluation-panel-received">[[evaluation.le_dieron]]</td>
          <td class="evaluation-panel-info">[[evaluation.info_ok]]</td>
          <td class="evaluation-panel-privacy">[[evaluation.privacidad_ok]]</td>
          <td class="evaluation-panel-age">[[evaluation.edad]]</td>
          <td class="evaluation-panel-genre">[[evaluation.genero]]</td>
          <td class="center-align"><img class="panel-evaluation-activos" alt="" src="../../images/emojis/[[evaluation.voto]]Active.png"></td>
          <td class="evaluation-panel-comment">[[evaluation.comentario]]</td>
       

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