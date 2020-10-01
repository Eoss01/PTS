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
                    <div class="input-group">
                        <input type="search" id="accordion_search_bar" class="form-control"
                            placeholder="Typing in the date of the record that you want to search.">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="now-ui-icons ui-1_zoom-bold"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @foreach($health_index_records as $health_index_record)

                                    <div class="panel panel-default"
                                        id="collapse{{ $health_index_record->index_id }}_container">
                                        <div class="panel-heading" role="tab"
                                            id="heading{{ $health_index_record->index_id }}">

                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapse{{ $health_index_record->index_id }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapse{{ $health_index_record->index_id }}">
                                                    <i class="fa fa-bars fa-fw" aria-hidden="true"></i>
                                                    {{ date('d-m-Y', strtotime($health_index_record->created_at)) }}
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse{{ $health_index_record->index_id }}"
                                            class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingOne">
                                            <div class="panel-body">

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="text-primary"
                                                            style="text-align:center;overflow-x:auto;">
                                                            <th>B.Pressure</th>
                                                            <th>Fasting</th>
                                                            <th>After Eat</th>
                                                            <th>HbA1c</th>
                                                            <th>Weight</th>
                                                            <th>Height</th>
                                                            <th>Temprature</th>
                                                            <th>Question</th>
                                                            <th>Operation</th>
                                                        </thead>

                                                        <tbody style="text-align:center;overflow-x:auto;">
                                                            <tr>
                                                                <td>{{ $health_index_record->blood_pressure_systolic }}/{{ $health_index_record->blood_pressure_diastolic }}
                                                                    mmg Hg</td>
                                                                <td>{{ $health_index_record->fasting_blood_sugar }}
                                                                    mg/dL</td>
                                                                <td>{{ $health_index_record->blood_sugar_after_eat }}
                                                                    mg/dL</td>
                                                                <td>{{ $health_index_record->HbA1c }}%</td>
                                                                <td>{{ $health_index_record->weight }}kg</td>
                                                                <td>{{ $health_index_record->height }}cm</td>
                                                                <td>{{ $health_index_record->body_temprature }}°C</td>
                                                                <td>{{ $health_index_record->question }}</td>
                                                                <td>
                                                                    <a href="/doctor-modify-advice/{{ $health_index_record->patient_id }}"
                                                                        class="btn btn-sucess">Add advice</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>



                                            </div>

                                        </div>

                                    </div>

                                @endforeach
                            </div>
                            <ul class="pagination">{{ $health_index_records->links() }}</ul>
                        </div>
                    </div>
                    <!-- Row -->
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
    // This section makes the search work.
    (function () {
        var searchTerm, panelContainerId;
        $('#accordion_search_bar').on('change keyup', function () {
            searchTerm = $(this).val();
            $('#accordion > .panel').each(function () {
                panelContainerId = '#' + $(this).attr('id');

                // Makes search to be case insesitive 
                $.extend($.expr[':'], {
                    'contains': function (elem, i, match, array) {
                        return (elem.textContent || elem.innerText || '').toLowerCase()
                            .indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });

                // END Makes search to be case insesitive

                // Show and Hide Triggers
                $(panelContainerId + ':not(:contains(' + searchTerm + '))')
                    .hide(); //Hide the rows that done contain the search query.
                $(panelContainerId + ':contains(' + searchTerm + ')')
                    .show(); //Show the rows that do!

            });
        });
    }());
    // End Show and Hide Triggers

    // END This section makes the search work.

</script>
@endsection
