@if(isset($mainService) && isset($details))
<form class="col s12 m6">
  <div class="row">

    {{-- Checkbox fields --}}
    <div class="row">
      <p>
        @include('panel.edit.input-checkbox',['service' => $mainService])
        <label for="filled-in-box-{!! $mainService !!}" translate="form_{!! $mainService !!}_option"></label>
      </p>

      <div ng-show="place.{!! $mainService !!}">
        @if(isset($optService))
        <p>
          @include('panel.edit.input-checkbox',['service' => $optService])
          <label for="filled-in-box-{!! $optService !!}" translate="form_{!! $optService !!}_option"></label>
        </p>
        @endif
        <p>
          @include('panel.edit.input-checkbox',['service' => 'friendly_'.$mainService])
          <label for="filled-in-box-friendly_{!! $mainService !!}" translate="form_service_friendly_option"></label>
        </p>
      </div>
    </div>

    {{-- Text fields --}}
    <div class="row">
      <div class="input-field col s12">
        @include('panel.edit.input-text',['field' => $details['responsable']])
        <label for="{!! $details['responsable'] !!}" translate="responsable"></label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        @include('panel.edit.input-text',['field' => $details['ubicacion']])
        <label for="{!! $details['ubicacion'] !!}" translate="location"></label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        @include('panel.edit.input-text',['field' => $details['horario']])
        <label for="{!! $details['horario'] !!}" translate="schedule"></label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        @include('panel.edit.input-text',['field' => $details['mail']])
        <label for="{!! $details['mail'] !!}" translate="email"></label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        @include('panel.edit.input-text',['field' => $details['tel']])
        <label for="{!! $details['tel'] !!}" translate="tel"></label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        @include('panel.edit.input-text',['field' => $details['web']])
        <label for="{!! $details['web'] !!}">Web</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <textarea id="{!! $details['observasiones'] !!}" type="text"
        name="{!! $details['observasiones'] !!}"
        class="validate materialize-textarea"
        ng-model="place.{!! $details['observasiones'] !!}"
        ng-change="formChange()"></textarea>
        <label for="{!! $details['observasiones'] !!}" translate="observations"></label>
      </div>
    </div>

  </div>
</form>
@endif