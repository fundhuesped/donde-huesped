<div class="modal" id="modal-changePassword">
    <form ng-submit="changePassword()">
        <div class="modal-content">
            <div  class="row">
                <h5 class="center-align" translate="change_user_password"></h5>
                <p class="left-align">
                    <i class="material-icons">keyboard_arrow_right</i>
                    <span class="icon-span-align">
                        <span translate="user"></span>: [[user.name]] ([[user.roll]])
                    </span>
                    <br>
                    <i class="material-icons">keyboard_arrow_right</i>
                    <span class="icon-span-align">
                        <span translate="password_conditions"></span>
                    </span>
                </p>
            </div>
            <div class="row">
                <input type="password" name="password" ng-model="data.new_password"/>
                <label for="password" translate="new_password"></label>
            </div>
            <div class="row">
                <input type="password" name="password_confirmation" ng-model="data.password_confirmation"/>
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
    </form>
</div>