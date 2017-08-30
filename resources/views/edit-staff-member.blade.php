@extends('layouts.app')
@extends('layouts.admin')

@section('content')
@section('body')

	<div class="panel panel-default">
		<div class="panel-body">
			<h2>Edit {{ $staff->name }}&rsquo;s Profile</h2>
			<hr>
			<a href="{{ url('/home') }}" class="btn btn-primary btn-md"><i class="fa fa-dashboard"></i> Dashboard</a>
			<a href="{{ url('/new-staff') }}" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Add new staff</a>
			<a href="{{ url('/all-staff-members') }}" class="btn btn-primary btn-md"><i class="fa fa-users"></i> View staff members</a>
			<hr>
			@include('parts.message-block')
		</div>
	</div>

@endsection
@endsection