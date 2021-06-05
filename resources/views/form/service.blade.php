@if(isset($mainService))
<div class="card-panel">
	<div class="form-group">
		@include('form.input-service',['service' => $mainService])
		<label for="filled-in-box-{!! $mainService !!}" translate="form_{!! $mainService !!}_option"></label>

		<div ng-show="place.{!! $mainService !!}">
			@if(isset($optService))
			<p>
				@include('form.input-service',['service' => $optService])
				<label for="filled-in-box-{!! $optService !!}" translate="form_{!! $optService !!}_option"></label>
			</p>
			@endif
			<!-- Descomentar esta parte cuando LGBT salga a producción -->
			{{-- <p>
				@include('form.input-service',['service' => 'friendly_'.$mainService])
				<label for="filled-in-box-friendly_{!! $mainService !!}" translate="form_service_friendly_option"></label>
			</p> --}}
		</div>
	</div>
</div>
@endif