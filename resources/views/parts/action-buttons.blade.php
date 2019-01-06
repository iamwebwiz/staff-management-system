@if (Auth::user()->is_admin == true)

    {{--<a href="{{ route('home') }}" class="btn btn-primary btn-md"><i class="fa fa-dashboard"></i> Dashboard</a>--}}
    <a href="{{ route('all-staff-members') }}" class="btn btn-info btn-md"><i class="fa fa-users"></i> View Staff Members</a>
    <a href="{{ route('new-staff') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add New Staff/Admin</a>
    <a href="{{ route('all-admins') }}" class="btn btn-default btn-md"><i class="fa fa-plus"></i> All Admins</a>
    <a href="{{ route('all-staff-members-payroll') }}" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> View Payrolls</a>

@endif

<a href="{{ route('apply.leave') }}" class="btn btn-danger btn-md"><i class="fa fa-plus"></i> Apply for Leave</a>
