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

			<input type="hidden" name="staff_id" value="{{ Auth::user()->id }}">

			<div class="form-group">
				<label for="start_work_date">Preferred Leave Start Date</label>
				<input type="date" name="leave_start_date" placeholder="12th June, 2018" value="{{ old('leave_start_date') }}" class="form-control">
			</div>

			<div class="form-group">
				<label for="start_work_date">Preferred Leave End Date</label>
				<input type="date" name="leave_end_date" placeholder="12th June, 2018" value="{{ old('leave_start_date') }}" class="form-control">
			</div>

			<div class="form-group">
				<label class="col-sm-12" for="inputBody">Reason for Leave</label>
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
					<textarea name="reason_for_leave" class="form-control" id="inputBody" rows="8" data-gramm="true"
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
				<button type="submit" class="btn btn-primary btn-md">Submit Leave Application</button>
			</div>
		</form>
	</div>
</div>

@endsection

@endsection