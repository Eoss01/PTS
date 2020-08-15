@extends('layouts.master')

@section('title')
Create User
@endsection

@section('second-index')
Create User
@endsection

@section('hidden_chart')
<div class="panel-header panel-header-sm"></div>
@endsection

@section('sidebar')
<div class="sidebar" data-color="blue">
    <div class="logo">
        <a href="/admin.admin-dashboard" class="simple-text logo-mini">
            PTS
        </a>
        <a href="/admin.admin-dashboard" class="simple-text logo-normal">
            Patient Tracking
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li
                class="{{ 'admin.admin-dashboard' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-dashboard">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li
                class="{{ 'admin.admin-manage-doctor' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-manage-doctor">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>Manage Doctors</p>
                </a>
            </li>

            <li
                class="{{ 'admin.admin-manage-patient' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-manage-patient">
                    <i class="now-ui-icons users_circle-08"></i>
                    <p>Manage Patients</p>
                </a>
            </li>

            <li
                class="{{ 'admin.admin-manage-supplier' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-manage-supplier">
                    <i class="now-ui-icons business_bank"></i>
                    <p>Manage Suppliers</p>
                </a>
            </li>

            <li
                class="{{ 'admin.admin-user-list' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-user-list">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>User List</p>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection


@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Create User</h5>
                </div>
                <div class="card-body">
                    <form action="/user-create" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label for="username" class="col-form-label">Username:</label>
                                    @error('username')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="username" class="form-control" placeholder="Username"
                                        value="{{ old('username') }}">
                                </div>
                            </div>


                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label for="phone" class="col-form-label">Phone:</label>
                                    @error('phone')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="phone" class="form-control" placeholder="Phone"
                                        value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label for="usertype" class="col-form-label">User Type:</label>
                                    @error('usertype')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <select name="usertype" class="form-control">
                                        <option></option>
                                        <option value="admin">Admin</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="patient">Patient</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email address:</label>
                                    @error('email')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password:</label>
                                    @error('password')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sucess">Create</button>
                                    <a href="/admin.admin-user-list" class="btn btn-danger">Back</a>
                                </div>
                            </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
