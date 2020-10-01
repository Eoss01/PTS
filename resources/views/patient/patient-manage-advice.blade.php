@extends('layouts.master')


@section('title')
Manage Advice
@endsection

@section('second-index')
Manage Advice
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
    @foreach($patients as $patient)
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="/patient.patient-dashboard" class="btn btn-danger">Back</a>
                        <h5 class="title">Manage Advice - Updated at {{ date('d-m-Y', strtotime($patient->updated_at)) }}</h5>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Advice:</label>
                                    <textarea rows="4" cols="80" class="form-control"
                                        placeholder="Please insert your medical history"
                                        name="medical_history">{{ $patient->advice }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Prescription:</label>
                                    <textarea rows="4" cols="80" class="form-control"
                                        placeholder="Please insert your medical history"
                                        name="medical_history">{{ $patient->prescription }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Appointment Date:</label>
                                    <input type="text" name="create-at" class="form-control" placeholder="Created At"
                                        value="{{ $patient->appointment_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Appointment Time:</label>
                                    <input type="text" name="updated-at" class="form-control" placeholder="Updated At"
                                        value="{{ $patient->appointment_time }}">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
    @endforeach
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
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();

        $('#dataTable').on('click', '.deletebtn', function () {

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            $('#delete_user_record').val(data[0]);

            $('#delete_model_form').attr('action', '/user-delete/' + data[0]);

            $('#deletemodelpop').modal('show');
        });

    });

</script>
@endsection
