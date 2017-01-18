<form class="col s12 m6">
                    <div class="row">
                      <div class="row">
<p>

                      <input  type="checkbox"
                      name="place.mac"
                      id="filled-in-box-mac"
                      ng-checked="isChecked(place.mac)"
                      ng-model="place.mac"/>
                      <label for="filled-in-box-mac">¿Cuenta con mac?</label>
                    </p>

                      <div class="input-field col s12">
                        <input id="responsable_mac" type="text"
                        name="responsable_mac" class="validate"
                        ng-model="place.responsable_mac"
                        ng-change="formChange()">
                        <label for="responsable_mac">Responsable</label>
                      </div>
                    </div>
                     <div class="row">
                      <div class="input-field col s12">
                        <input id="ubicacion_mac" type="text"
                        name="ubicacion_mac" class="validate"
                        ng-model="place.ubicacion_mac"
                        ng-change="formChange()">
                        <label for="ubicacion_mac">Ubicación</label>
                      </div>
                    </div>


                  <div class="row">
                      <div class="input-field col s12">
                        <input id="horario_mac" type="text"
                        name="horario_mac" class="validate"
                        ng-model="place.horario_mac"
                        ng-change="formChange()">
                        <label for="horario_mac">Horario</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="mail_mac" type="email"
                        name="mail_mac" class="validate"
                        ng-model="place.mail_mac"
                        ng-change="formChange()">
                        <label for="mail_mac">Mail</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="tel_mac" type="text"
                        name="tel_mac" class="validate"
                        ng-model="place.tel_mac" ng-change="formChange()">
                        <label for="tel_mac">Teléfono</label>
                      </div>
                    </div>

                         <div class="row">
                      <div class="input-field col s12">
                        <input id="web_mac" type="text"
                        name="web_mac" class="validate"
                        ng-model="place.web_mac" ng-change="formChange()">
                        <label for="web_mac">Web</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="comentarios_mac" type="text"
                        name="comentarios_mac"
                        class="validate materialize-textarea"
                        ng-model="place.comentarios_mac"
                        ng-change="formChange()"></textarea>
                        <label for="comentarios_mac">Observación</label>
                      </div>
                    </div>
                     </div>
                      </div>

                         </form>
