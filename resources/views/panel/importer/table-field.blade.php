@if(isset($err) && isset($data) && isset($err_info))
	@if($err)
		<span class="text-error" title="{!! $err_info !!}">
			{!! $data !!}
		</span>
	@else
		<span>{!! $data !!}</span>
	@endif
@endif