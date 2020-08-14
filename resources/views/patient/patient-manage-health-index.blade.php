@extends('layouts.master')


@section('title')
Patient Health
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
                    <a href="/patient.patient-dashboard" class="btn btn-danger">Back</a>
                    <a href="/patient.patient-create-health-index" class="btn btn-primary pull-right">Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">
                            @if(session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            @if(session('wrong_status'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('wrong_status') }}
                                </div>
                            @endif

                            <thead style="text-align:center;overflow-x:auto;">
                                <th>ID</th>
                                <th>BP</th>
                                <th>FBS</th>
                                <th>BSAE</th>
                                <th>HbA1c</th>
                                <th>Created At</th>
                                <th>Operation</th>
                            </thead>

                            <tbody style="text-align:center;overflow-x:auto;">
                                @foreach($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->index_id }}</td>
                                        <td>{{ $patient->blood_pressure_systolic }}/{{ $patient->blood_pressure_diastolic }}
                                            mmg Hg</td>
                                        <td>{{ $patient->fasting_blood_sugar }} mg/dL</td>
                                        <td>{{ $patient->blood_sugar_after_eat }} mg/dL</td>
                                        <td>{{ $patient->HbA1c }}%</td>
                                        <td>{{ date('d-m-Y', strtotime($patient->created_at)) }}
                                        </td>
                                        <td>
                                            <a href="/patient-modify-health-index/{{ $patient->index_id }}"
                                                class="btn btn-sucess">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
