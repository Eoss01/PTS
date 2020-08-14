@extends('layouts.master')

@section('title')
Modify Advice
@endsection

@section('second-index')
Modify Advice
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
            <li
                class="{{ "doctor.doctor-dashboard" == request()->path() ? 'active' : '' }}">
                <a href="/doctor.doctor-dashboard">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li
                class="{{ 'doctor.doctor-manage-patient' == request()->path() ? 'active' : '' }}">
                <a href="/doctor.doctor-manage-patient">
                    <i class="now-ui-icons users_circle-08"></i>
                    <p>Manage Patients</p>
                </a>
            </li>


            <li
                class="{{ 'doctor.doctor-manage-health-index' == request()->path() ? 'active' : '' }}">
                <a href="/doctor.doctor-manage-health-index">
                    <i class="now-ui-icons ui-1_calendar-60"></i>
                    <p>Manage Health Index</p>
                </a>
            </li>

            <li
                class="{{ 'doctor-modify-personal-information' == request()->path() ? 'active' : '' }} active-pro">
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
                    <h5 class="title">Modify Advice</h5>
                </div>

                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card-body">
                    @foreach($advice_records as $advice_record)
                        <form action="/doctor-modify-advice-update/{{ $advice_record->advice_id  }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Advice:</label>
                                        @error('advice')
                                            <label class="form-group"
                                                style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                        @enderror
                                        <textarea rows="4" cols="80" class="form-control"
                                            placeholder="Please insert your advice" value="{{ $advice_record->advice }}"
                                            name="advice">{{ $advice_record->advice }}</textarea>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Prescription:</label>
                                        @error('prescription')
                                            <label class="form-group"
                                                style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                        @enderror
                                        <textarea rows="4" cols="80" class="form-control"
                                            placeholder="Please insert your prescription" value="{{ $advice_record->prescription }}"
                                            name="prescription">{{ $advice_record->prescription }}</textarea>
                                    </div>
                                </div>



                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Appointment Date:</label>
                                        @error('appointment_date')
                                            <label class="form-group"
                                                style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                        @enderror
                                        <input type="date" name="appointment_date" class="form-control"
                                            placeholder="Appointment Date"
                                            value="{{ $advice_record->appointment_date }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Appointment Time:</label>
                                        @error('appointment_time')
                                            <label class="form-group"
                                                style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                        @enderror
                                        <input type="time" name="appointment_time" class="form-control"
                                            placeholder="Appointment Time"
                                            value="{{ $advice_record->appointment_time }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Created At:</label>
                                        <input type="text" name="create-at" class="form-control" disabled=""
                                            placeholder="Created At" value="{{ $advice_record->created_at }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Updated At:</label>
                                        <input type="text" name="updated-at" class="form-control" disabled=""
                                            placeholder="Updated At" value="{{ $advice_record->updated_at }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sucess">Update</button>
                                        <a href="/doctor.doctor-manage-health-index" class="btn btn-danger">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
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
