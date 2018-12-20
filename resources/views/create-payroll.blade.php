@extends('layouts.app')
@extends('layouts.admin')

@section('content')

@section('body')

<div class="panel panel-default">
	<div class="panel-body">
		<h2>Generate Payroll for  {{ $staff->name }}</h2>
		<hr>
		<a href="{{ url('/home') }}" class="btn btn-primary btn-md"><i class="fa fa-dashboard"></i> Dashboard</a>
		<a href="{{ url('/all-staff-members') }}" class="btn btn-primary btn-md"><i class="fa fa-users"></i> View staff members</a>
		<hr>
		@include('parts.message-block')
		<form action="{{ route('store-staff-payroll') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}

			<input type="hidden" name="staff_id" value="{{ $staff->id }}">
			<div class="form-group">
				<label for="gross_salary">Gross Salary</label>
				<input type="number" name="gross_salary" placeholder="Enter Gross Salary E.g 50000" value="{{ old('gross_salary') }}" class="form-control">
			</div>

			<div class="form-group">
				<label for="tax_percentage">Tax Percentage</label>
				<input type="number" name="tax_percentage" placeholder="Enter Tax Percentage E.g 15 " value="{{ old('tax_percentage') }}" class="form-control">
			</div>

			<div class="form-group">
				<label for="month">Salary for the Month of ? </label>
				<select name="month" class="form-control">
					<option value="">Select Month</option>
					<option value="January">January</option>
					<option value="February">February</option>
					<option value="March">March</option>
					<option value="April">April</option>
					<option value="May">May</option>
					<option value="June">June</option>
					<option value="July">July</option>
					<option value="August">August</option>
					<option value="September">September</option>
					<option value="October">October</option>
					<option value="October">October</option>
					<option value="November">November</option>
					<option value="December">December</option>
				</select>
			</div>


			<div class="form-group">
				<label for="year">Select Year of the above Month? </label>
				<select name="year" class="form-control">
					<option value="">Select Year</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="year">2019</option>
					<option value="2019">2020</option>
					<option value="2021">2021</option>
					<option value="year">2022</option>
					<option value="2022">2023</option>
					<option value="2024">2024</option>
					<option value="2025">2025</option>
					<option value="2026">2026</option>
					<option value="2027">2027</option>
					<option value="2028">2028</option>
					<option value="2029">2029</option>
				</select>
			</div>

			<div class="form-group">
				<label for="comment">Any Comments ?</label>
				<textarea name="comment" class="form-control" id="inputBody" rows="8" data-gramm="true"
						  data-txt_gramm_id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06"
						  data-gramm_id="71c8bb8e-8a51-c867-6c4f-5b14b864ac06"
						  spellcheck="false" data-gramm_editor="true"
						  style="z-index: auto; position: relative; line-height: 26.6667px; font-size: 14px; transition: none; overflow: auto; background: transparent !important;">{{ old("comment") }}</textarea>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-md">Generate Payroll</button>
			</div>
		</form>
	</div>
</div>

@endsection

@endsection