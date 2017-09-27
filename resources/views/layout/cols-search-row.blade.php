<div class="row">

	@php
		$index = 0;
	@endphp

	@foreach( $items as $item)

		<div class="col-md-6">
				
			<div class="form-group">
				
				@php

					$stringformat = strtolower(str_replace(' ','',$item))

				@endphp
 
				<label for="input<?= $stringformat ?>" class="col-sm-3 control-label"> {{ $item }}</label>

				<div class="col-sm-9">
					<input value="{{ isset($oldVals) ? $oldVals[$index] :"" }}" type="text" class="form-control" name="<?= $stringformat ?>">

				</div>

			</div>

		</div>
		@php

			$index++;

		@endphp 


	@endforeach
	

</div>