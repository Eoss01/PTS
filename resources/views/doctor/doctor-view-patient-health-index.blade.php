@extends('layouts.master')

@section('title')
Patient List
@endsection

@section('second-index')
Total Health Index Record
@endsection

@section('chart')
<div class="panel-header panel-header-lg">
    <canvas id="bigDashboardChart"></canvas>
</div>
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


<div class="row">
    <div class="col-md-6">
        <div class="card card-chart">
            <div class="card-header">
                <h4 class="card-title">Average Blood Pressure (In Months)</h4>
                <div class="dropdown">
                    <button type="button"
                        class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                        data-toggle="dropdown">
                        <i class="now-ui-icons loader_gear"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <a class="dropdown-item text-danger" href="#">Remove Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="lineChartExample"></canvas>
                </div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="card card-chart">
            <div class="card-header">
                <h4 class="card-title">Average Blood Sugar (In Months)</h4>
                <div class="dropdown">
                    <button type="button"
                        class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                        data-toggle="dropdown">
                        <i class="now-ui-icons loader_gear"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <a class="dropdown-item text-danger" href="#">Remove Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="lineChartExampleWithNumbersAndGrid"></canvas>
                </div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
            </div>
        </div>
    </div>
</div>



<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="/doctor.doctor-manage-health-index" class="btn btn-danger">Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">
                            @if(session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <thead style="text-align:center;overflow-x:auto;">
                                <th>BP</th>
                                <th>FBS</th>
                                <th>BSAE</th>
                                <th>HbA1c</th>
                                <th>Weight</th>
                                <th>Height</th>
                                <th>Temprature</th>
                                <th>Question</th>
                                <th>Created At</th>
                                <th>Operation</th>
                            </thead>

                            <tbody style="text-align:center;overflow-x:auto;">
                                @foreach($health_index_records as $health_index_record)
                                    <tr>
                                        <td>{{ $health_index_record->blood_pressure_systolic }}/{{ $health_index_record->blood_pressure_diastolic }}
                                            mmg Hg</td>
                                        <td>{{ $health_index_record->fasting_blood_sugar }} mg/dL</td>
                                        <td>{{ $health_index_record->blood_sugar_after_eat }} mg/dL</td>
                                        <td>{{ $health_index_record->HbA1c }}%</td>
                                        <td>{{ $health_index_record->weight }}kg</td>
                                        <td>{{ $health_index_record->height }}cm</td>
                                        <td>{{ $health_index_record->body_temprature }}°C</td>
                                        <td>{{ $health_index_record->question }}</td>
                                        <td>{{ date('d-m-Y', strtotime($health_index_record->created_at)) }}
                                        </td>
                                        <td> <a href="/doctor-modify-advice/{{ $health_index_record->patient_id }}"
                                                class="btn btn-sucess">Add advice</a>
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
    });

</script>
@endsection
