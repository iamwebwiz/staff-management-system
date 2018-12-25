@extends('layouts.app')
@extends('layouts.admin')

@section('content')
@section('body')

    <div class="panel panel-default">
        <div class="panel-body">
            <h2>Showing {{ $staff->name }}&rsquo;s Profile</h2>
            <hr>
            <a href="{{ url('/home') }}" class="btn btn-primary btn-md"><i class="fa fa-dashboard"></i> Dashboard</a>
            <a href="{{ url('/new-staff') }}" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Add new
                staff</a>
            <a href="{{ url('/all-staff-members') }}" class="btn btn-primary btn-md"><i class="fa fa-users"></i> View
                staff members</a>
            <hr>
            @include('parts.message-block')
            {{--<img width="300" src="{{ asset('/storage/staff/'.$staff->image) }}" class="thumbnail"--}}
            {{--alt="{{ $staff->name }}">--}}
            <br>


            <div class="row">
                <div class="col-md-3 col-lg-3 " align="center">
                    <img src="{{ asset('/storage/staff/'.$staff->image) }}" class="thumbnail"
                         alt="{{ $staff->name }}">
                </div>

                <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                        <tbody>
                        <tr>
                            <td>Name:</td>
                            <td>{{ $staff->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a></td>
                        </tr>
                        <tr>
                            <td>Age:</td>
                            <td>{{ $staff->age }}</td>
                        </tr>

                        <tr>
                            <td>Phone Number:</td>
                            <td>{{ $staff->phone }}</td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td>{{ $staff->address }}</td>
                        </tr>

                        <tr>
                        <tr>
                            <td>City:</td>
                            <td>{{ $staff->city }}</td>
                        </tr>
                        <tr>
                            <td>State:</td>
                            <td>{{ $staff->state }}</td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>{{ $staff->country }}</td>
                        </tr>
                        <tr>
                            <td>Level:</td>
                            <td>{{ $staff->level }}</td>
                        </tr>

                        </tr>

                        </tbody>
                    </table>

                    <a href="{{ route("all-staff-members-payroll") }}" class="btn btn-danger">PaySlips</a>
                    <a href="#" class="btn btn-primary">Leave Status</a>
                </div>
            </div>

            <div class="panel-footer">
                <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button"
                   class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button"
                               class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button"
                               class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i>
                            </a>
                </span>
            </div>

        </div>


        <link rel="stylesheet" href="{{ URL::asset('css/staff-profile.css') }}">

@endsection
@endsection