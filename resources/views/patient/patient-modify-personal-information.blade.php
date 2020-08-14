@extends('layouts.master')

@section('title')
Patient Profile
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
        <a href="/patient.patient-dashboard" class="simple-text logo-mini">
            PTS
        </a>
        <a href="/patient.patient-dashboard" class="simple-text logo-normal">
            Patient Tracking
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li
                class="{{ 'patient.patient-dashboard' == request()->path() ? 'active' : '' }}">
                <a href="/patient.patient-dashboard">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li
                class="{{ 'patient.patient-manage-health-index' == request()->path() ? 'active' : '' }}">
                <a href="/patient.patient-manage-health-index">
                    <i class="now-ui-icons ui-1_calendar-60"></i>
                    <p>Manage Health Index</p>
                </a>
            </li>

            <li
                class="{{ 'patient.patient-manage-advice' == request()->path() ? 'active' : '' }}">
                <a href="/patient.patient-manage-advice">
                    <i class="now-ui-icons ui-1_bell-53"></i>
                    <p>View Advice</p>
                </a>
            </li>
            <li
                class="{{ 'patient-modify-personal-information' == request()->path() ? 'active' : '' }} active-pro">
                <a href="/patient-modify-personal-information/{{ Auth::id() }}">
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

                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card-body">
                    <form action="/patient-modify-personal-information-update/{{ Auth::id() }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-1 ">
                                <div class="form-group">
                                    <label>User ID:</label>
                                    <input type="text" class="form-control" disabled="" placeholder="User ID"
                                        value="{{ Auth::id() }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username:</label>
                                    @error('username')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="username" class="form-control" placeholder="Username"
                                        value="{{ $patients->patient_name }}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Phone:</label>
                                    @error('phone')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="phone" class="form-control" placeholder="Phone"
                                        value="{{ $patients->patient_phone }}">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address:</label>
                                    @error('email')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        value="{{ $patients->patient_email }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password:</label>
                                    @error('password')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender:</label>
                                    @error('gender')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <select name="gender" class="form-control">
                                        <option value=""></option>
                                        <option value="male"
                                            {{ $patients->patient_gender == "male" ? 'selected' : '' }}>
                                            Male</option>
                                        <option value="female"
                                            {{ $patients->patient_gender == "female" ? 'selected' : '' }}>
                                            Female</option>
                                        <option value="other"
                                            {{ $patients->patient_gender == "other" ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Patient Address:</label>
                                    @error('address')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="address" class="form-control" placeholder="Clinic Address"
                                        value="{{ $patients->patient_address }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Admission Date:</label>
                                    @error('admission_date')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="date" name="admission_date" class="form-control"
                                        value="{{ $patients->patient_admission_date }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Birth Date:</label>
                                    @error('birth_date')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="date" name="birth_date" class="form-control"
                                        value="{{ $patients->patient_birth_date }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Chronic Type:</label><br>
                                    @error('gender')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <select name="chronic_type" class="form-control">
                                        <option value=""></option>
                                        <option value="Cancers"
                                            {{ $patients->patient_chronic_type == "Cancers" ? 'selected' : '' }}>
                                            Cancers</option>
                                        <option value="Cardiovascular Diseases"
                                            {{ $patients->patient_chronic_type == "Cardiovascular Diseases" ? 'selected' : '' }}>
                                            Cardiovascular Diseases</option>
                                        <option value="Diabetes Mellitus "
                                            {{ $patients->patient_chronic_type == "Diabetes Mellitus" ? 'selected' : '' }}>
                                            Diabetes Mellitus </option>
                                        <option value="Respiratory Diseases"
                                            {{ $patients->patient_chronic_type == "Respiratory Diseases" ? 'selected' : '' }}>
                                            Respiratory Diseases</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Blood Type:</label>
                                    @error('blood_type')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <select name="blood_type" class="form-control">
                                        <option value=""></option>
                                        <option value="A Type"
                                            {{ $patients->patient_blood_type == "A Type" ? 'selected' : '' }}>
                                            A Type</option>
                                        <option value="AB Type"
                                            {{ $patients->patient_blood_type == "AB Type" ? 'selected' : '' }}>
                                            AB Type</option>
                                        <option value="B Type"
                                            {{ $patients->patient_blood_type == "B Type" ? 'selected' : '' }}>
                                            B Type</option>
                                        <option value="O Type"
                                            {{ $patients->patient_blood_type == "O Type" ? 'selected' : '' }}>
                                            O Type</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Patient Medical History:</label>
                                    @error('medical_history')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <textarea rows="4" cols="80" class="form-control"
                                        placeholder="Please insert your medical history"
                                        name="medical_history">{{ $patients->patient_medical_history }}</textarea>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Created At:</label>
                                    <input type="text" name="create-at" class="form-control" disabled=""
                                        placeholder="Created At" value="{{ $patients->created_at }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Updated At:</label>
                                    <input type="text" name="updated-at" class="form-control" disabled=""
                                        placeholder="Updated At" value="{{ $patients->updated_at }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sucess">Update</button>
                                    <a href="/patient.patient-dashboard" class="btn btn-danger">Back</a>
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
                        <h5 class="title">{{ $patients->patient_name }}</h5>
                        <p class="phone">
                            {{ $patients->patient_phone }}
                        </p>
                        <p class="email">
                            {{ $patients->patient_email }}
                        </p>
                        <p class="address">
                            {{ $patients->patient_address }}
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
