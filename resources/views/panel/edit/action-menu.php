<div class="col offset-s6 s2">
  <div class="valign-demo  valign-wrapper">
    <div class="valign full-width actions">

      <button class="waves-effect waves-light btn btn-small orange" ng-href="" ng-disabled="spinerflag" ng-click="clicky()" title="[['save'|translate]]">

      <div class="preloader-wrapper small active" ng-cloak ng-show="spinerflag">
        <div class="spinner-layer spinner-red-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>

      <div class="" ng-cloak ng-show="!spinerflag">
        <i class="mdi-content-save"></i>
       <!--  <span translate="save"></span> -->
      </div>

    </button>
  </div>
</div>
</div>
<div class="col s2" ng-cloak ng-show="place.aprobado == -1 || place.aprobado == 0">
  <div class="valign-demo  valign-wrapper" ng-show="place.aprobado == -1 || place.aprobado == 0">
    <div class="valign full-width actions">
      <button class="waves-effect waves-light btn btn-small green"
      ng-href="" ng-disabled="spinerflag" ng-click="clickyApr()" title="[['approve'|translate]]">

      <div class="preloader-wrapper small active" ng-cloak ng-show="spinerflag">
        <div class="spinner-layer spinner-red-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>

      <div class="" ng-cloak ng-show="!spinerflag">
        <i class="mdi-action-done"></i>
        <!-- <span translate="approve"></span> -->
      </div>

    </button>
  </div>
</div>
</div>

<div class="col s2" ng-cloak ng-show="place.aprobado != -1 || place.aprobado == 0">
  <div class="valign-demo  valign-wrapper" ng-show="place.aprobado != -1 || place.aprobado == 0">
    <div class="valign full-width actions">
      <button class="waves-effect waves-light btn btn-small red "
      ng-href="" ng-disabled="spinerflag" ng-click="clickyDis()" title="[['reject'|translate]]">

      <div class="preloader-wrapper small active" ng-cloak ng-show="spinerflag">
        <div class="spinner-layer spinner-red-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>

      <div class="" ng-cloak ng-show="!spinerflag">
        <i class="mdi-av-not-interested"></i>
        <!-- <span translate="reject"></span> -->
      </div>

    </button>
  </div>
</div>
</div>