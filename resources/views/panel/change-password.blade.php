<div id="{!! $modal_id !!}" class="modal">
    {!! Form::open(['url' => 'panel/change-password', 'method' => 'post']) !!}
    <div class="modal-content">
        <div  class="row">
            <h5 class="center-align" translate="change_user_password"></h5>
            <p class="left-align">
                <i class="material-icons">keyboard_arrow_right</i>
                <span style="vertical-align: super">
                    <span translate="user"></span>: {!! $content !!}
                </span>
                <br>
                <i class="material-icons">keyboard_arrow_right</i>
                <span style="vertical-align: super">
                    <span translate="password_conditions"></span>
                </span>
            </p>
        </div>

        <div class="row">
            <input type="password" name="password"/>
            <label for="password" translate="new_password"></label>
        </div>
        <div class="row">
            <input type="password" name="password_confirmation"/>
            <label for="password_confirmation" translate="password_confirmation"></label>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col l6">
                <a class="modal-action modal-close waves-effect waves-light btn grey" translate="cancel"></a>
            </div>
            <div class="col l6">
                <button type="submit" class="waves-effect waves-light btn red" translate="change_password"></button>
            </div>
        </div>
    </div>
    <input type="hidden" name="id"/ value="{!! $id !!}">
    {!! Form::close() !!}

</div>