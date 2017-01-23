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
        {{-- <tr ng-cloak ng-hide="loadingPost" ng-repeat="place in filteredplaces"> --}}
          {{-- <td>[[place.establecimiento]]</td> --}}
          <td>Informacion, Tes de embarazo, Otros</td>
          <td>No, me duieron turno para otro dia</td>
          <td>No</td>
          <td>Si</td>
          <td>21</td>
          <td>Mujer</td>
           <td class="center-align"><img alt="" src="images/caritas/3.png"></td>
          <td>Mas alla de las montañas viven los textos simulados</td>
          <td class="actions">
            <a target="_self" class="waves-effect waves-light btn-floating">
					<i class="mdi-action-done left"></i>
            </a>
            <a ng-click="blockNow(place)"class="waves-effect waves-light btn-floating">
            	<i class="mdi-av-not-interested left"></i>
            </a>
          </td>
        </tr>

                <tr ng-cloak ng-hide="loadingPost">
        {{-- <tr ng-cloak ng-hide="loadingPost" ng-repeat="place in filteredplaces"> --}}
          {{-- <td>[[place.establecimiento]]</td> --}}
          <td>Informacion, Tes de embarazo, Otros</td>
          <td>No, me duieron turno para otro dia</td>
          <td>No</td>
          <td>Si</td>
          <td>21</td>
          <td>Mujer</td>
           <td class="center-align"><img alt="" src="images/caritas/3.png"></td>
          <td>Mas alla de las montañas viven los textos simulados</td>
          <td class="actions">
            <a target="_self" class="waves-effect waves-light btn-floating">
					<i class="mdi-action-done left"></i>
            </a>
            <a ng-click="blockNow(place)"class="waves-effect waves-light btn-floating">
            	<i class="mdi-av-not-interested left"></i>
            </a>
          </td>
        </tr>
                <tr ng-cloak ng-hide="loadingPost">
        {{-- <tr ng-cloak ng-hide="loadingPost" ng-repeat="place in filteredplaces"> --}}
          {{-- <td>[[place.establecimiento]]</td> --}}
          <td>Informacion, Tes de embarazo, Otros</td>
          <td>No, me duieron turno para otro dia</td>
          <td>No</td>
          <td>Si</td>
          <td>21</td>
          <td>Mujer</td>
           <td class="center-align"><img alt="" src="images/caritas/3.png"></td>
          <td>Mas alla de las montañas viven los textos simulados</td>
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