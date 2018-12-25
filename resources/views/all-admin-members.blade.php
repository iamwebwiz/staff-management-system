@extends('layouts.app')
@extends('layouts.admin')

@section('content')

@section('body')

<div class="panel panel-default">
	<div class="panel-body">
		<h2>View all Admins</h2>
		<hr>
		<a href="{{ url('/home') }}" class="btn btn-primary btn-md"><i class="fa fa-dashboard"></i> Dashboard</a>
		<a href="{{ url('/staff/create') }}" class="btn btn-info btn-md"><i class="fa fa-plus"></i> Add new staff</a>
		<a href="{{ url('/payslips') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i> View Payrolls</a>
		<hr>
		@include('parts.message-block')
		<div class="table-responsive">
			@if (count($admins) !== 0)
				<?php $counter = 1; ?>
				<table class="table table-hover table-bordered">
					<thead>
						<th class="text-center">S/N</th>
						<th class="text-center">Name</th>
						<th class="text-center">Email</th>
						<th class="text-center">Is Super Admin</th>
						{{--<th class="text-center">Last Login</th>--}}
						<th class="text-center">Action</th>
					</thead>
					@foreach($admins as $admin)
						<tbody>
							<tr>
								<td class="text-center">{{ $counter }}</td>
								<td class="text-center">{{ $admin->name }}</td>
								<td class="text-center">{{ $admin->email }}</td>
								<td class="text-center">
									@if ($admin->is_super_admin)
										&#9989;
									@else
										No
									@endif
								</td>
								<td class="text-center">
									<a href="{{ route('edit-admin',$admin) }}" class="btn btn-info">Edit</a>
								</td>
							</tr>
						</tbody>
						<?php $counter++ ?>
					@endforeach
				</table>
			@else
				<h1>There are no admin yet!</h1>
			@endif
		</div>
	</div>
</div>

@endsection

@endsection