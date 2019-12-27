<div id="{!! $modal_id !!}" class="modal">
    {!! Form::open(['url' => 'panel/change-password', 'method' => 'post']) !!}
    <div class="modal-content">
        <div  class="row">
            <h5 class="center-align">Cambiar contraseña de usuario</h5>
            <p class="left-align">
                <i class="material-icons">keyboard_arrow_right</i>
                <span style="vertical-align: super">Usuario: {!! $content !!}</span>
            </p>
        </div>

        {{-- <div ng-repeat="service in services">
            <p>
                <input type="checkbox" id="[[service.code]]" ng-checked="exists(service.code, selected)" ng-click="toggle(service.code, selected)"/>
                <label for="[[service.code]]">[[service.label]]</label>
            </p>
        </div> --}}
        <div class="row">
            <input type="password" name="password"/>
            <label for="password">Nueva contraseña</label>
        </div>
        <div class="row">
            <input type="password" name="password_confirmation"/>
            <label for="password_confirmation">Repetir contraseña</label>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col l6">
                <a class="modal-action modal-close waves-effect waves-light btn grey" {{-- translate="cancel" --}}>Cancelar</a>
            </div>
            <div class="col l6">
                <button type="submit" class="waves-effect waves-light btn red" >Cambiar contraseña</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="id"/ value="{!! $id !!}">
    {!! Form::close() !!}

</div>