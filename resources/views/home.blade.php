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
				<h3>Recent Activity</h3>

				<ul>
					@foreach($recent_activities as $activity)
						<li>{{ $activity->trail_activity_details }}</li>
					@endforeach
				</ul>
			</p>
		</div>
	</div>
@endsection

@endsection
