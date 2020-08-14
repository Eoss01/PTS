@extends('layouts.master')

@section('title')
    Edit Patient
@endsection

@section('second-index')
    Edit Patient
@endsection

@section('hidden_chart')
<div class="panel-header panel-header-sm"></div>
@endsection

@section('sidebar')
<div class="sidebar" data-color="blue">
      <div class="logo">
        <a href="/doctor.doctor-dashboard" class="simple-text logo-mini">
          PTS
        </a>
        <a href="/doctor.doctor-dashboard" class="simple-text logo-normal">
          Patient Tracking 
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="{{ "doctor.doctor-dashboard" == request()->path() ? 'active' : '' }}">
            <a href="/doctor.doctor-dashboard">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="{{ 'doctor.doctor-manage-patient' == request()->path() ? 'active' : '' }}">
            <a href="/doctor.doctor-manage-patient">
              <i class="now-ui-icons users_circle-08"></i>
              <p>Manage Patients</p>
            </a>
          </li>


          <li class="{{ 'doctor.doctor-manage-health-index' == request()->path() ? 'active' : '' }}">
            <a href="/doctor.doctor-manage-health-index">
              <i class="now-ui-icons ui-1_calendar-60"></i>
              <p>Manage Health Index</p>
            </a>
          </li>

          <li class="{{ 'doctor-modify-personal-information' == request()->path() ? 'active' : '' }} active-pro">
            <a href="/doctor-modify-personal-information/{{ Auth::id() }}">
                <i class="now-ui-icons users_circle-08"></i>
                <p>Personal Information</p>
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
            <h5 class="title">Edit Patient</h5>
          </div>
          @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
          @endif
          <div class="card-body">
          <form action="/doctor-modify-patient-information-update/{{ $patients->id  }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="username" class="col-form-label">Username:</label>
                    @error('username')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $patients->name }}">
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="form-group">
                    <label for="phone" class="col-form-label">Phone:</label>
                    @error('phone')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $patients->phone  }}">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="email" class="col-form-label">Email address:</label>
                    @error('email')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $patients->email   }}">
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="password" class="col-form-label">Password:</label>                    
                    @error('password')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                </div>    

              </div>

              <input type="hidden" name="usertype" class="form-control" placeholder="usertype" value="patient">
              <input type="hidden" name="created_by" class="form-control" placeholder="created_by" value="{{ Auth::id() }}">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-sucess">Edit</button>
                    <a href="/doctor.doctor-manage-patient" class="btn btn-danger">Back</a>
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
