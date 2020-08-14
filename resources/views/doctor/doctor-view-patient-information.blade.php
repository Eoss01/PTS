@extends('layouts.master')

@section('title')
    Create Patient
@endsection

@section('second-index')
    Create Patient
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
            <h5 class="title">View Personal Information</h5>
          </div>
        
          <div class="card-body">
              <div class="row">
                <div class="col-md-2 ">
                  <div class="form-group">
                    <label>Patient ID:</label>
                    <input type="text" class="form-control" placeholder="User ID" value="{{ Auth::id() }}">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Patient Username:</label>
                    @error('username')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $patient->patient_name   }}">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Patient Phone:</label>
                    @error('phone')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $patient->patient_phone }}">
                  </div>
                </div>
              </div>


              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Patient Email address:</label>
                    @error('email')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $patient->patient_email   }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Patient Gender:</label>
                    @error('gender')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <select name="gender" class="form-control">
                      <option value=""></option>
                      <option value="male"  {{ $patient->patient_gender == "male" ? 'selected' : '' }}>Male</option>
                      <option value="female" {{ $patient->patient_gender == "female" ? 'selected' : '' }}>Female</option>
                      <option value="other" {{ $patient->patient_gender == "other" ? 'selected' : '' }}>Other</option>
                    </select>   
                  </div>
                </div>
              </div>

              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Patient Address:</label>
                    @error('address')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="text" name="address" class="form-control" placeholder="Clinic Address" value="{{ $patient->patient_address }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Patient Admission Date:</label>
                    @error('admission_date')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="date" name="admission_date" class="form-control" value="{{ $patient->patient_admission_date  }}">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Patient Birth Date:</label>
                    @error('birth_date')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <input type="date" name="birth_date" class="form-control" value="{{ $patient->patient_birth_date  }}">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Patient Chronic Type:</label><br>
                    @error('gender')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <select name="chronic_type" class="form-control">
                        <option value=""></option>
                        <option value="Cancers"  {{ $patient->patient_chronic_type == "Cancers" ? 'selected' : '' }}>Cancers</option>
                        <option value="Cardiovascular Diseases" {{ $patient->patient_chronic_type == "Cardiovascular Diseases" ? 'selected' : '' }}>Cardiovascular Diseases</option>
                        <option value="Diabetes Mellitus "  {{ $patient->patient_chronic_type == "Diabetes Mellitus" ? 'selected' : '' }}>Diabetes Mellitus </option>
                        <option value="Respiratory Diseases" {{ $patient->patient_chronic_type == "Respiratory Diseases" ? 'selected' : '' }}>Respiratory Diseases</option>
                      </select>   

                  </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Patient Blood Type:</label>
                        @error('blood_type')
                        <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                        @enderror
                        <select name="blood_type" class="form-control">
                          <option value=""></option>
                          <option value="A Type"  {{ $patient->patient_blood_type == "A Type" ? 'selected' : '' }}>A Type</option>
                          <option value="AB Type" {{ $patient->patient_blood_type == "AB Type" ? 'selected' : '' }}>AB Type</option>
                          <option value="B Type" {{ $patient->patient_blood_type == "B Type" ? 'selected' : '' }}>B Type</option>
                          <option value="O Type" {{ $patient->patient_blood_type == "O Type" ? 'selected' : '' }}>O Type</option>
                        </select>   
                    </div>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Patient Medical History:</label>
                    @error('medical_history')
                    <label class="form-group" style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                    @enderror
                    <textarea rows="4" cols="80" class="form-control" placeholder="No medical history" name="medical_history">{{ $patient->patient_medical_history  }}</textarea>
                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Created At:</label>
                    <input type="text" name="create-at" class="form-control" placeholder="Created At" value="{{ $patient->created_at }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Updated At:</label>
                    <input type="text" name="updated-at" class="form-control" placeholder="Updated At" value="{{ $patient->updated_at }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <a href="/doctor.doctor-manage-patient" class="btn btn-danger">Back</a>
                  </div>
                </div>
              </div>  
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
                <h5 class="title">{{ $patient->patient_name  }}</h5>
              <p class="phone">
                {{ $patient->patient_phone  }}
              </p>
              <p class="email">
                {{ $patient->patient_email  }}
              </p>
              <p class="address">
                {{ $patient->patient_address  }}
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
