<form class="col s12 m6">
                    <div class="row">
                      <div class="row">
<p>

                      <input  type="checkbox"
                      name="place.ssr"
                      id="filled-in-box-ssr"
                      ng-checked="isCheckBoxChecked(place.ssr)"
                      ng-model="place.ssr"/>
                      <label for="filled-in-box-ssr">¿Cuenta con SSR?</label>
                    </p>

                    <p>
                      <input  type="checkbox"
                      name="friendly_ssr"
                      id="friendly_ssr"
                      ng-model="place.friendly_ssr"/>
                      <label for="friendly_ssr">¿Adolecente Friendly?</label>
                    </p>


                      <div class="input-field col s12">
                        <input id="responsable_ssr" type="text"
                        name="responsable_ssr" class="validate"
                        ng-model="place.responsable_ssr"
                        ng-change="formChange()">
                        <label for="responsable_ssr">Responsable</label>
                      </div>
                    </div>
                     <div class="row">
                      <div class="input-field col s12">
                        <input id="ubicacion_ssr" type="text"
                        name="ubicacion_ssr" class="validate"
                        ng-model="place.ubicacion_ssr"
                        ng-change="formChange()">
                        <label for="ubicacion_ssr">Ubicación</label>
                      </div>
                    </div>


                  <div class="row">
                      <div class="input-field col s12">
                        <input id="horario_ssr" type="text"
                        name="horario_ssr" class="validate"
                        ng-model="place.horario_ssr"
                        ng-change="formChange()">
                        <label for="horario_ssr">Horario</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="mail_ssr" type="email"
                        name="mail_ssr" class="validate"
                        ng-model="place.mail_ssr"
                        ng-change="formChange()">
                        <label for="mail_ssr">Mail</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="tel_ssr" type="text"
                        name="tel_ssr" class="validate"
                        ng-model="place.tel_ssr" ng-change="formChange()">
                        <label for="tel_ssr">Teléfono</label>
                      </div>
                    </div>

                         <div class="row">
                      <div class="input-field col s12">
                        <input id="web_ssr" type="text"
                        name="web_ssr" class="validate"
                        ng-model="place.web_ssr" ng-change="formChange()">
                        <label for="web_ssr">Web</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="comentarios_ssr" type="text"
                        name="comentarios_ssr"
                        class="validate materialize-textarea"
                        ng-model="place.comentarios_ssr"
                        ng-change="formChange()"></textarea>
                        <label for="comentarios_ssr">Observación</label>
                      </div>
                    </div>
                     </div>
                      </div>

                         </form>
