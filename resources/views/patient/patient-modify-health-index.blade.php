@extends('layouts.master')

@section('title')
Manage Health Index
@endsection

@section('second-index')
Manage Health Index
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
                class="{{ 'patient.patient-view-supplier-information' == request()->path() ? 'active' : '' }}">
                <a href="/patient.patient-view-supplier-information">
                    <i class="now-ui-icons location_map-big"></i>
                    <p>View Supplier</p>
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
                    <h5 class="title">Modify Health Index</h5>
                </div>

                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card-body">
                    <form action="/patient-modify-health-index-update/{{ $health_index_record->index_id }}"
                        method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label>Patient ID:</label>
                                    <input type="text" class="form-control" disabled="" placeholder="User ID"
                                        value="{{ Auth::id() }}">
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Patient name:</label>
                                    <input type="text" class="form-control" disabled="" placeholder="User Name"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Created Date:</label>
                                    <input type="text" class="form-control" disabled=""
                                        value="{{ date('d-m-Y', strtotime($health_index_record->created_at)) }}">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <input type="hidden" name="patient_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="current_date"
                                value="{{ date('d-m-Y', strtotime($health_index_record->created_at)) }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Blood Pressure Systolic (mmg Hg):</label>
                                    @error('blood_pressure_systolic')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="blood_pressure_systolic" class="form-control" maxlength="3"
                                        placeholder="Blood Pressure Systolic"
                                        value="{{ $health_index_record->blood_pressure_systolic }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Blood Pressure Diastolic (mmg Hg):</label>
                                    @error('blood_pressure_diastolic')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="blood_pressure_diastolic" class="form-control"
                                        maxlength="3" placeholder="Blood Pressure Diastolic"
                                        value="{{ $health_index_record->blood_pressure_diastolic }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fasting Blood Sugar (mg/dL):</label>
                                    @error('fasting_blood_sugar')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="fasting_blood_sugar" class="form-control" maxlength="3"
                                        placeholder="Fasting Blood Sugar"
                                        value="{{ $health_index_record->fasting_blood_sugar }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Blood Sugar After Eat (mg/dL):</label>
                                    @error('blood_sugar_after_eat')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="blood_sugar_after_eat" class="form-control" maxlength="3"
                                        placeholder="Blood Sugar After Eat"
                                        value="{{ $health_index_record->blood_sugar_after_eat }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hemoglobin A1C (HbA1c) (%):</label>
                                    @error('HbA1c')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="HbA1c" class="form-control" maxlength="3"
                                        placeholder="Hemoglobin A1C" value="{{ $health_index_record->HbA1c }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Weight (kg):</label><br>
                                    @error('weight')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="weight" class="form-control" maxlength="3"
                                        placeholder="Weight" value="{{ $health_index_record->weight }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Height (cm):</label><br>
                                    @error('height')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="height" class="form-control" maxlength="3"
                                        placeholder="Height" value="{{ $health_index_record->height }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Body Temprature (°C):</label>
                                    @error('body_temprature')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <input type="text" name="body_temprature" class="form-control" maxlength="4"
                                        placeholder="Body Temprature"
                                        value="{{ $health_index_record->body_temprature }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Q&A:</label>
                                    @error('question')
                                        <label class="form-group"
                                            style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                    @enderror
                                    <textarea rows="4" cols="80" class="form-control"
                                        placeholder="Please write down your question, if you have no question, please leave it blank."
                                        name="question">{{ $health_index_record->question }}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sucess">Update</button>
                                    <a href="/patient.patient-manage-health-index" class="btn btn-danger">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-user">
                <div>
                    <img src="../img/Blood pressure chart.jpg">
                    <img src="../img/Blood sugar chart.jpg">
                    <img src="../img/Body temperature chart.jpg">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('scripts')

@endsection
