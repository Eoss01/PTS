@extends('layouts.master')

@section('title')
    Doctor Profile
@endsection

@section('second-index')
    Modify Personal Information
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
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Edit Personal Information</h5>
          </div>
          
          @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
          @endif

          <div class="card-body">
            <form action="/doctor-modify-personal-information-update/{{ Auth::id()  }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="row">
                <div class="col-md-1 pr-1">
                  <div class="form-group">
                    <label>User ID:</label>
                    <input type="text" class="form-control" disabled="" placeholder="User ID" value="{{ Auth::id()  }}">
                  </div>
                </div>
                <div class="col-md-6 px-1">
                  <div class="form-group">
                    <label>Username:</label>
                    @error('username')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $doctors->doctor_name  }}">
                  </div>
                </div>
                <div class="col-md-5 pl-1">
                  <div class="form-group">
                    <label>Phone:</label>
                    @error('phone')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $doctors->doctor_phone }}">
                  </div>
                </div>
              </div>


              
              <div class="row">
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address:</label>
                    @error('email')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $doctors->doctor_email  }}">
                  </div>
                </div>
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password:</label>
                    @error('password')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                </div>
                <div class="col-md-2 pl-1">
                  <div class="form-group">
                    <label>Gender:</label>
                    @error('gender')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <select name="gender" class="form-control">
                      <option value=""></option>
                      <option value="male"  {{ $doctors->doctor_gender == "male" ? 'selected' : '' }}>Male</option>
                      <option value="female" {{ $doctors->doctor_gender == "female" ? 'selected' : '' }}>Female</option>
                      <option value="other" {{ $doctors->doctor_gender == "other" ? 'selected' : '' }}>Other</option>
                    </select>   
                  </div>
                </div>
              </div>

              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Clinic Address</label>
                    @error('address')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="address" class="form-control" placeholder="Clinic Address" value="{{ $doctors->doctor_clinic_address  }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Created At:</label>
                    <input type="text" name="create-at" class="form-control"  disabled="" placeholder="Created At" value="{{ $doctors->created_at }}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Updated At:</label>
                    <input type="text" name="updated-at" class="form-control"  disabled="" placeholder="Updated At" value="{{ $doctors->updated_at }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <button type="submit" class="btn btn-sucess">Update</button>
                    <a href="/doctor.doctor-dashboard" class="btn btn-danger">Back</a>
                  </div>
                </div>
              </div>  
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-user">
          <div class="image">
            <img src="../img/bg5.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
                <img class="avatar border-gray" src="../img/mike.jpg" alt="...">
                <h5 class="title">{{ $doctors->doctor_name }}</h5>
              <p class="phone">
                {{ $doctors->doctor_phone  }}
              </p>
              <p class="email">
                {{ $doctors->doctor_email }}
              </p>
              <p class="address">
                {{ $doctors->doctor_clinic_address  }}
              </p>
            </div>
          </div>
          <hr>
        </div>
      </div>
    </div>

  </div>
  
@endsection

@section('scripts')

@endsection
