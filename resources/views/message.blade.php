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
									<ghost>
										<div style="position: absolute; color: transparent; overflow: hidden; white-space: pre-wrap; border: 1.33333px solid rgb(204, 204, 204); border-radius: 4px; box-sizing: border-box; height: 228px; width: 817.333px; z-index: 0; padding: 6px 12px; margin: 0px; top: auto; left: auto; background: none 0% 0% / auto repeat scroll padding-box border-box rgb(255, 255, 255);"
											 data-id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06"
											 data-gramm_id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06" data-gramm="gramm"
											 data-gramm_editor="true" data-grammarly-reactid=".2"
											 contenteditable="true" width="817.3333740234375"><span
													style="display:inline-block;line-height:26.6667px;color:transparent;overflow:hidden;text-align:left;float:initial;clear:none;box-sizing:border-box;vertical-align:baseline;white-space:pre-wrap;width:100%;margin:0;padding:0;border:0;font:normal normal normal normal 14px / 26.6667px 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:14px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;letter-spacing:normal;text-shadow:none;height:225px;"
													data-grammarly-reactid=".2.0"></span><br
													data-grammarly-reactid=".2.1"></div>
									</ghost>
									<textarea name="content" class="form-control" id="inputBody" rows="8" data-gramm="true"
											  data-txt_gramm_id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06"
											  data-gramm_id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06"
											  spellcheck="false" data-gramm_editor="true"
											  style="z-index: auto; position: relative; line-height: 26.6667px; font-size: 14px; transition: none; overflow: auto; background: transparent !important;"></textarea>
									<div>
										<div style="z-index: 2; opacity: 1; margin-left: 794px; margin-top: 197px;"
											 class="gr-textarea-btn " data-grammarly-reactid=".3">
											<div title="Protected by Grammarly" class="gr-textarea-btn_status"
												 data-grammarly-reactid=".3.0">
											</div>
										</div>
									</div>
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
