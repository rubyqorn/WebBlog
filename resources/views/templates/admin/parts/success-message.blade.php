@if(session('status'))

	<div class="row justify-content-center">
		<div class="col-lg-12 col-md-12 col-12 mt-4 pt-4 w-100">
			<div class="alert alert-success alert-dismissable fade show" role="alert">
				<button class="close" data-dismiss="alert">
					<span>&times;</span>
				</button>
				<p class="h4 text-left font-weight-bold">
					{{ session('status') }}
				</p>
			</div>
		</div>
	</div>

@endif