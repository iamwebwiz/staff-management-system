@extends('layouts.app')
@extends('layouts.admin')

@section('content')
@section('body')

	<div class="panel panel-default">
		<div class="panel-body">
			<h2>Edit {{ $staff->user->name }}&rsquo;s Profile</h2>
			<hr>

			@include('parts.action-buttons')

			<hr>
			@include('parts.message-block')

			<img width="300" src="{{ asset('/storage/staff/'.$staff->image) }}" class="thumbnail" alt="{{ $staff->name }}">
			<br>
			<form action="{{ route('update-staff', ['id' => $staff->id]) }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}

				{{ method_field('PUT') }}
				<input type="hidden" name="user_id" value="{{ $staff->user_id }}">
				<div class="form-group">
					<label for="name">Full name</label>
					<input type="text" name="name" placeholder="Full name" value="{{ $staff->user->name }}" class="form-control">
				</div>

				<div class="form-group">
					<label for="email">Email Address</label>
					<input type="email" name="email" placeholder="Email Address" value="{{ $staff->user->email }}" class="form-control">
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
					<label for="image">Update Staff Picture</label>
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
						<option value="Intern" {{ $staff->level == 'Intern' ? 'selected' : ''  }}>Intern</option>
						<option value="Junior" {{ $staff->level == 'Junior' ? 'selected' : ''  }}>Junior</option>
						<option value="Senior" {{ $staff->level == 'Senior' ? 'selected' : ''  }}>Senior</option>
						<option value="Supervisor" {{ $staff->level == 'Supervisor' ? 'selected' : ''  }}>Supervisor</option>
						<option value="Manager" {{ $staff->level == 'Manager' ? 'selected' : ''  }}>Manager</option>
					</select>
				</div>


				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="is_admin" {{ $staff->user->is_admin ? 'checked' : '' }}> Make Admin
						</label>
					</div>
				</div>

				<div class="form-group">
					<label for="start_work_date">Work Start Date</label>
					<input type="date" name="start_work_date" value="{{ $staff->start_work_date->format('Y-m-d') }}" class="form-control">
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-md">Submit Details</button>
				</div>
			</form>
		</div>
	</div>

@endsection
@endsection