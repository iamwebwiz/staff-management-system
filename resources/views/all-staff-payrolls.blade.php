@extends('layouts.app')
@extends('layouts.admin')

@section('content')

@section('body')

<div class="panel panel-default">
	<div class="panel-body">
		<h2>View all staff members payroll</h2>
		<hr>
		<a href="{{ url('/home') }}" class="btn btn-primary btn-md"><i class="fa fa-dashboard"></i> Dashboard</a>
		<a href="{{ url('/new-staff') }}" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Add new staff</a>
		<a href="{{ url('/all-staff-members/payroll') }}" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> View Payrolls</a>
		<hr>
		@include('parts.message-block')
		<div class="table-responsive">
			@if (count($payrolls) !== 0)
				<?php $counter = 1; ?>
				<table class="table table-hover table-bordered">
					<thead>
						<th class="text-center">S/N</th>
						<th class="text-center">Name</th>
						<th class="text-center">Level</th>
						<th class="text-center">Gross Salary</th>
						<th class="text-center">Net Salary</th>
						<th class="text-center">Action</th>
					</thead>
					@foreach($payrolls as $payroll)
						<tbody>
							<tr>
								<td class="text-center">{{ $counter }}</td>
								<td class="text-center">{{ $payroll->staff->name }}</td>
								<td class="text-center">{{ $payroll->staff->level }}</td>
								<td class="text-center">{{ $payroll->gross_salary }}</td>
								<td class="text-center">{{ $payroll->net_salary }}</td>
								<td class="text-center">
									<a href="{{ route('send-staff-payroll', [$payroll->staff,$payroll]) }}" class="btn btn-success">Send Payroll to Staff</a>
								</td>
							</tr>
						</tbody>
						<?php $counter++ ?>
					@endforeach
				</table>
			@else
				<h1>There are no staff yet!</h1>
			@endif
		</div>
	</div>
</div>

@endsection

@endsection