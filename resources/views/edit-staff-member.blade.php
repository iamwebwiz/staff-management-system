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
			<img width="300" src="{{ asset('app/public/staff/'.$staff->image) }}" class="thumbnail" alt="{{ $staff->name }}">
			<br>
			<form action="{{ route('edit-staff', ['id' => $staff->id]) }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}

				{{ method_field('PUT') }}
				<div class="form-group">
					<label for="name">Full name</label>
					<input type="text" name="name" placeholder="Full name" value="{{ $staff->name }}" class="form-control">
				</div>

				<div class="form-group">
					<label for="email">Email Address</label>
					<input type="email" name="email" placeholder="Email Address" value="{{ $staff->email }}" class="form-control">
				</div>

				<div class="form-group">
					<label for="age">Age</label>
					<input type="number" name="age" placeholder="Age" value="{{ $staff->age }}" class="form-control">
				</div>

				<div class="form-group">
					<label for="phone">Phone number</label>
					<input type="tel" name="phone" placeholder="Phone number" value="{{ $staff->phone }}" class="form-control">
				</div>

				<div class="form-group">
					<label for="image">Staff Picture</label>
					<input type="file" name="image" class="form-control">
				</div>

				<div class="form-group">
					<label for="address">Residential Address</label>
					<input type="text" name="address" placeholder="Residential Address" value="{{ $staff->address }}" class="form-control">
				</div>

				<div class="form-group">
					<label for="city">City</label>
					<input type="text" name="city" placeholder="City" value="{{ $staff->city }}" class="form-control">
				</div>

				<div class="form-group">
					<label for="state">State</label>
					<input type="text" name="state" placeholder="State" value="{{ $staff->state }}" class="form-control">
				</div>

				<div class="form-group">
					<label for="country">Country</label>
					<input type="text" name="country" placeholder="Country" value="{{ $staff->country }}" class="form-control">
				</div>

				<div class="form-group">
					<label for="level">Staff Level</label>
					<select name="level" class="form-control">
						<option value="">Select Staff Level</option>
						<option value="Intern">Intern</option>
						<option value="Junior">Junior Staff</option>
						<option value="Senior">Senior Staff</option>
						<option value="Supervisor">Supervisor</option>
						<option value="Manager">Manager</option>
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-md">Submit Details</button>
				</div>
			</form>
		</div>
	</div>

@endsection
@endsection