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

      <table class="bordered striped responsive-table">
        <thead ng-cloak ng-hide="loadingPost">
          <tr>
           <th data-field="">¿Qué buscó?</th>
           <th data-field="">¿Se lo dieron?</th>
           <th data-field="">Información clara</th>
           <th data-field="">Privacidad</th>
           <th data-field="">Edad</th>
           <th data-field="">Género</th>
           <th data-field="">Puntuación</th>
           <th data-field="">Comentario</th>
           <th data-field=""></th>
         </tr>
       </thead>
       <tbody>
        <tr ng-cloak ng-hide="loadingPost">
        <tr ng-cloak ng-hide="loadingPost" ng-repeat="evaluation in evaluationList">
          <td>[[evaluation.que_busca]]</td>
          <td>[[evaluation.le_dieron]]</td>
          <td>[[evaluation.info_ok]]</td>
          <td>[[evaluation.privacidad_ok]]</td>
          <td>[[evaluation.edad]]</td>
          <td>[[evaluation.genero]]</td>
          <td class="center-align"><img alt="" src="../../images/emojis/[[evaluation.voto]]Active.png"></td>
          <td>[[evaluation.comentario]]</td>
       

          <td class="actions">
            <a target="_self" class="waves-effect waves-light btn-floating">
					<i class="mdi-action-done left"></i>
            </a>
            <a ng-click="blockNow(place)"class="waves-effect waves-light btn-floating">
            	<i class="mdi-av-not-interested left"></i>
            </a>
          </td>
        </tr>

      </tbody>
    </table>