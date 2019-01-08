@extends('layouts.app')
@extends('layouts.admin')

@section('content')

@section('body')
	<div class="panel panel-default">
		<div class="panel-body">
			<h4>Welcome, {{ Auth::user()->name }} {{ "you're about sending a message to ".$staff->user->name }}</h4>
			<hr>
			<a href="{{ url('/new-staff') }}" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Add new staff</a>
			<a href="{{ url('/all-staff-members') }}" class="btn btn-primary btn-md"><i class="fa fa-users"></i> View staff members</a>
			<hr>
			<p class="lead">
				{{--<ul>--}}
					{{--@foreach($recent_activities as $activity)--}}
						{{--<li>{{ $activity->trail_activity_details }}</li>--}}
					{{--@endforeach--}}

			<form action="{{ route('send-staff-message', ['id' => $staff->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
				{{ csrf_field() }}

				<div class="row">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Message Form</h3>
						</div>
						<div class="panel-body">

							{{--@include('partials.form-validation-errors')--}}

							<div class="form-group">
								<label class="col-sm-2" for="inputTo">To</label>
								<div class="col-sm-10"><input name="email" type="email" class="form-control" id="inputTo"
															  placeholder="comma separated list of recipients" value="{{ $staff->user->email }}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2" for="inputSubject">Subject</label>
								<div class="col-sm-10"><input name="subject" type="text" class="form-control" id="inputSubject"
															  placeholder="subject"></div>
							</div>

							<div class="form-group">
								<label class="col-sm-12" for="inputBody">Message</label>
								<div class="col-sm-12">

									<textarea name="content" class="form-control" id="inputBody" rows="8" data-gramm="true"
											  data-txt_gramm_id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06"
											  data-gramm_id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06"
											  spellcheck="false" data-gramm_editor="true"
											  style="z-index: auto; position: relative; line-height: 26.6667px; font-size: 14px; transition: none; overflow: auto; background: transparent !important;"></textarea>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-md">Send A Message</button>
							</div>
						</div>
					</div>
				</div>
				<br>


			</form>


			</p>
		</div>
	</div>
@endsection

@endsection
