<div class="container">
    <div class="row">
        <div class="col-md-3">

            <div class="list-group">

                @if (Auth::user()->is_admin == true)
                    <a href="{{ url('/home') }}" id="dash" class="list-group-item"><i class="fa fa-dashboard"></i>
                        Dashboard</a>
                    <a href="{{ route('new-staff') }}" id="newStaff" class="list-group-item"><i class="fa fa-plus"></i>
                        Add New Staff</a>
                    <a href="{{ route('all-staff-members') }}" id="allStaff" class="list-group-item"><i
                                class="fa fa-users"></i> View Staff Members</a>
                    <a href="{{ route('all-staff-members-payroll') }}" id="allStaff" class="list-group-item"><i
                                class="fa fa-money"></i> View Payrolls</a>
                    <a href="{{ route('all-admins') }}" id="allStaff" class="list-group-item"><i
                                class="fa fa-users"></i> View All Admins</a>

                    <hr>
                    <a href="{{ route('pending-leave') }}" id="allStaff" class="list-group-item"><i
                                class="fa fa-pencil-square"></i> Current Pending Leave</a>
                    <a href="{{ route('approved-leave') }}" id="allStaff" class="list-group-item"><i
                                class="fa fa-paste"></i> Approved Leave</a>
                @endif

                <hr>

                <a href="{{ route('my-leave', Auth::user()) }}" id="pending-leave" class="list-group-item"><i
                            class="fa fa-refresh"></i> Your Leave Situation</a>

            </div>
        </div>
        <div class="col-md-9">
            @yield('body')
        </div>
    </div>
</div>