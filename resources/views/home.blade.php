@extends('layouts.app')
@extends('layouts.admin')

@section('content')

@section('body')
	<div class="panel panel-default">
		<div class="panel-body">
			<h2>Welcome, {{ Auth::user()->name }}</h2>
			<hr>
			<a href="{{ url('/new-staff') }}" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Add new staff</a>
			<a href="{{ url('/all-staff-members') }}" class="btn btn-primary btn-md"><i class="fa fa-users"></i> View staff members</a>
			<hr>
			<p class="lead">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
		</div>
	</div>
@endsection

@endsection
