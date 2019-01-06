@extends('layouts.app')
@extends('layouts.admin')

@section('content')

@section('body')

<div class="panel panel-default">
	<div class="panel-body">
		{{--<h2>View all Leaves By {{ $leaves->user->name }}</h2>--}}
		<h2>You're viewing <span class="text-info">{{ $leave_type }}</span></h2>
		<hr>

		@include('parts.action-buttons')

		<hr>
		@include('parts.message-block')
		<div class="table-responsive">
			@if (count($leaves) !== 0)
				{{ $counter = 1 }}
				<table class="table table-hover table-bordered">
					<thead>
						<th class="text-center">S/N</th>
						<th class="text-center">Staff Name</th>
						<th class="text-center">Leave Start Date</th>
						<th class="text-center">Leave End Date</th>
						<th class="text-center">Reason for Leave</th>
						<th class="text-center">Action/Status</th>
					</thead>
					@foreach($leaves as $leaf)
						<tbody>
							<tr>
								<td class="text-center">{{ $counter }}</td>
								<td class="text-center">{{ $leaf->staff->user->name }}</td>
								<td class="text-center">{{ $leaf->leave_start_date }}</td>
								<td class="text-center">{{ $leaf->leave_end_date }}</td>
								<td class="text-center">{{ $leaf->reason_for_leave }}</td>
								<td class="text-center">
									@if ($leaf->is_approved == false)
										<form method="post" action="{{ route('admin-approve-leave') }}">
											{{ csrf_field() }}
											<input type="hidden" name="leave_id" value="{{ $leaf->id }}">
											<button type="submit" class="btn btn-primary btn-md"> Approve</button>
										</form>
									@else
										<span class="text-info">Approved</span>
									@endif

								</td>
							</tr>
						</tbody>
						{{ $counter++ }}
					@endforeach
				</table>
			@else
				<h1>There are no {{ strtoupper($leave_type) }} yet!</h1>
			@endif
		</div>
	</div>
</div>

@endsection

@endsection