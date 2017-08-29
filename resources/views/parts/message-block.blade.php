@if(count($errors) > 0)
	@foreach($errors->all() as $error)
		<div class="alert alert-danger fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{ $error }}
		</div>
	@endforeach
@endif

@if(Session::has('message'))
	<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{ Session::get('message') }}
	</div>
@endif