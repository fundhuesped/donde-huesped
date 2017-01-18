<form class="col s12 m6">
	<div class="row">
		<div class="row">
			<p>

				<input  type="checkbox"
				name="place.ile"
				id="filled-in-box-ile"
				ng-checked="isChecked(place.ile)"
				ng-model="place.ile"/>
				<label for="filled-in-box-ile">¿Cuenta con ile?</label>
			</p>

			<div class="input-field col s12">
			<input id="responsable_ile" type="text"
			name="responsable_ile" class="validate"
			ng-model="place.responsable_ile"
				ng-change="formChange()">
				<label for="responsable_ile">Responsable</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
			<input id="ubicacion_ile" type="text"
			name="ubicacion_ile" class="validate"
			ng-model="place.ubicacion_ile"
				ng-change="formChange()">
				<label for="ubicacion_ile">Ubicación</label>
			</div>
		</div>


		<div class="row">
			<div class="input-field col s12">
			<input id="horario_ile" type="text"
			name="horario_ile" class="validate"
			ng-model="place.horario_ile"
				ng-change="formChange()">
				<label for="horario_ile">Horario</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
			<input id="mail_ile" type="email"
			name="mail_ile" class="validate"
			ng-model="place.mail_ile"
				ng-change="formChange()">
				<label for="mail_ile">Mail</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s12">
			<input id="tel_ile" type="text"
			name="tel_ile" class="validate"
			ng-model="place.tel_ile" ng-change="formChange()">
				<label for="tel_ile">Teléfono</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s12">
			<input id="web_ile" type="text"
			name="web_ile" class="validate"
			ng-model="place.web_ile" ng-change="formChange()">
				<label for="web_ile">Web</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s12">
			<textarea id="comentarios_ile" type="text"
			name="comentarios_ile"
				class="validate materialize-textarea"
				ng-model="place.comentarios_ile"
				ng-change="formChange()"></textarea>
				<label for="comentarios_ile">Observación</label>
			</div>
		</div>
	</div>
</div>

</form>
