@extends('layouts.app')
@extends('layouts.admin')

@section('content')

@section('body')

<div class="panel panel-default">
	<div class="panel-body">
		<h2>Hello You're Applying for Leave</h2>
		<hr>
		@include('parts.action-buttons')
		<hr>
		@include('parts.message-block')
		<form action="{{ route('store.leave') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}

			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

			<div class="form-group">
				<label for="start_work_date">Preferred Leave Start Date</label>
				<input type="date" name="leave_start_date" placeholder="12th June, 2018" value="{{ old('leave_start_date') }}" class="form-control">
			</div>

			<div class="form-group">
				<label for="start_work_date">Preferred Leave End Date</label>
				<input type="date" name="leave_end_date" placeholder="12th June, 2018" value="{{ old('leave_end_date') }}" class="form-control">
			</div>

			<div class="form-group">
				<label class="col-sm-12" for="inputBody">Reason for Leave</label>
				<div class="col-sm-12">

					<textarea name="reason_for_leave" class="form-control" id="inputBody" rows="5" data-gramm="true"
							  data-txt_gramm_id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06"
							  data-gramm_id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06"
							  spellcheck="false" data-gramm_editor="true"
							  style="z-index: auto; position: relative; line-height: 26.6667px; font-size: 14px; transition: none; overflow: auto; background: transparent !important;">
                        {{ old('reason_for_leave') }}
					</textarea>

					&nbsp;&nbsp;&nbsp;
				</div>
			</div>


			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-md">Submit Leave Application</button>
			</div>
		</form>
	</div>
</div>

@endsection

@endsection