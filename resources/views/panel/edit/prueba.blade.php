<form class="col s12 m6">
                    <div class="row">
                      <div class="row">
<p>
                      <input  type="checkbox" 
                      name="place.prueba" 
                      id="filled-in-box" 
                      ng-model="place.prueba"/>
                      <label for="filled-in-box">¿Hace pruebas de HIV?</label>
                    </p>

                      <div class="input-field col s12">
                        <input id="responsable_testeo" type="text"
                        name="responsable_testeo" class="validate" 
                        ng-model="place.responsable_testeo" 
                        ng-change="formChange()">
                        <label for="responsable_testeo">Responsable</label>
                      </div>
                    </div>
                     <div class="row">
                      <div class="input-field col s12">
                        <input id="ubicacion_testeo" type="text"
                        name="ubicacion_testeo" class="validate" 
                        ng-model="place.ubicacion_testeo" 
                        ng-change="formChange()">
                        <label for="ubicacion_testeo">Ubicacion</label>
                      </div>
                    </div>


                  <div class="row">
                      <div class="input-field col s12">
                        <input id="horario_testeo" type="text"
                        name="horario_testeo" class="validate" 
                        ng-model="place.horario_testeo" 
                        ng-change="formChange()">
                        <label for="horario_testeo">Horario</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="mail_testeo" type="email"
                        name="mail_testeo" class="validate" 
                        ng-model="place.mail_testeo" 
                        ng-change="formChange()">
                        <label for="mail_testeo">Mail</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <input id="tel_testeo" type="text" 
                        name="tel_testeo" class="validate" 
                        ng-model="place.tel_testeo" ng-change="formChange()">
                        <label for="tel_testeo">Telefono</label>
                      </div>
                    </div>

                         <div class="row">
                      <div class="input-field col s12">
                        <input id="web_testeo" type="text" 
                        name="web_testeo" class="validate" 
                        ng-model="place.web_testeo" ng-change="formChange()">
                        <label for="web_testeo">Web</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="observaciones_testeo" type="text"
                        name="observaciones_testeo"
                        class="validate materialize-textarea" 
                        ng-model="place.observaciones_testeo" 
                        ng-change="formChange()"></textarea>
                        <label for="observaciones_testeo">Observación</label>
                      </div>
                    </div>
                    
                         </form>



                  </div>
                </div>
                