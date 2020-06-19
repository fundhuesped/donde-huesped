@if(isset($field))
<input type="text" name="{!! $field !!}" class="validate"
id="{!! $field !!}"
ng-model="place.{!! $field !!}"
ng-change="formChange()">
@endif