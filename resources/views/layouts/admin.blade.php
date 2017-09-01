<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="list-group">
				<a href="{{ url('/home') }}" id="dash" class="list-group-item"><i class="fa fa-dashboard"></i> Dashboard</a>
				<a href="{{ url('/new-staff') }}" id="newStaff" class="list-group-item"><i class="fa fa-plus"></i> Add New Staff</a>
				<a href="{{ url('/all-staff-members') }}" id="allStaff" class="list-group-item"><i class="fa fa-users"></i> View Staff Members</a>
			</div>
		</div>
		<div class="col-md-9">
			@yield('body')
		</div>
	</div>
</div>