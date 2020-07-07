<div class="modal" id="modal-deleteUser" ng-if="[[user.id]] != {!! Auth::user()->id !!}">
    <form ng-submit="deleteUser()">
        <div class="modal-content">
            <div  class="row">
                <h5 class="center-align" translate="delete_user"></h5>
                <p class="center-align">
                    <i class="material-icons red-text">priority_high</i>
                    <span class="icon-span-align">
                        <span translate="delete_confirmation_q"></span>
                        <span class="danger">[[user.name]] ([[user.roll]]) </span>?
                    </span>
                </p>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col l6">
                    <a class="modal-action modal-close waves-effect waves-light btn grey" translate="cancel"></a>
                </div>
                <div class="col l6">
                    <button type="submit" class="waves-effect waves-light btn red" translate="delete"></button>
                </div>
            </div>
        </div>
    </form>
</div>