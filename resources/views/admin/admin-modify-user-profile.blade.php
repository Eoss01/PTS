@extends('layouts.master')

@section('title')
    User Profile
@endsection

@section('second-index')
    Modify User
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
            <h5 class="title">Edit Profile</h5>
          </div>
          <div class="card-body">
          <form action="/admin-modify-user-profile-update/{{ $users->id }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="row">
                <div class="col-md-1 pr-1">
                  <div class="form-group">
                    <label>User ID:</label>
                    <input type="text" class="form-control" disabled="" placeholder="User ID" value="{{ $users->id }}">
                  </div>
                </div>
                <div class="col-md-5 px-1">
                  <div class="form-group">
                    <label>Username:</label>
                    @error('username')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $users->name }}">
                  </div>
                </div>
                <div class="col-md-5 px-1">
                  <div class="form-group">
                    <label>Phone:</label>
                    @error('phone')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $users->phone }}">
                  </div>
                </div>
                <div class="col-md-1 pl-1">
                  <div class="form-group">
                    <label>User Type:</label>
                    <select name="usertype" class="form-control">
                      <option value="admin"  {{ $users->usertype == "admin" ? 'selected' : '' }}>Admin</option>
                      <option value="doctor" {{ $users->usertype == "doctor" ? 'selected' : '' }}>Doctor</option>
                      <option value="patient" {{ $users->usertype == "patient" ? 'selected' : '' }}>Patient</option>
                    </select>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address:</label>
                    @error('email')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $users->email }}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Password:</label>                    
                    @error('password')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Created At:</label>
                    <input type="text" name="create-at" class="form-control"  disabled="" placeholder="Created At" value="{{ $users->created_at }}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Updated At:</label>
                    <input type="text" name="updated-at" class="form-control"  disabled="" placeholder="Updated At" value="{{ $users->updated_at }}">
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <button type="submit" class="btn btn-sucess">Update</button>
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
