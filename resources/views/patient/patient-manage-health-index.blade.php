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
                    <a href="/patient.patient-dashboard" class="btn btn-danger">Back</a>
                    <a href="/patient.patient-create-health-index" class="btn btn-primary pull-right">Add</a>
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
                                @foreach($patients as $patient)

                                    <div class="panel panel-default" id="collapse{{ $patient->index_id }}_container">
                                        <div class="panel-heading" role="tab" id="heading{{ $patient->index_id }}">

                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapse{{ $patient->index_id }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $patient->index_id }}">
                                                    <i class="fa fa-bars fa-fw" aria-hidden="true"></i>
                                                    {{ date('d-m-Y', strtotime($patient->created_at)) }}
                                                </a>
                                            </h4>
                                        </div>
                                        
                                        <div id="collapse{{ $patient->index_id }}" class="panel-collapse collapse in"
                                            role="tabpanel" aria-labelledby="headingOne">
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
                                                                <td>{{ $patient->blood_pressure_systolic }}/{{ $patient->blood_pressure_diastolic }}
                                                                    mmg Hg</td>
                                                                <td>{{ $patient->fasting_blood_sugar }} mg/dL</td>
                                                                <td>{{ $patient->blood_sugar_after_eat }} mg/dL</td>
                                                                <td>{{ $patient->HbA1c }}%</td>
                                                                <td>{{ $patient->weight }}kg</td>
                                                                <td>{{ $patient->height }}cm</td>
                                                                <td>{{ $patient->body_temprature }}°C</td>
                                                                <td>{{ $patient->question }}</td>
                                                                <td>
                                                                    <a href="/patient-modify-health-index/{{ $patient->index_id }}"
                                                                        class="btn btn-sucess">Edit</a>
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
                            <ul class="pagination">{{ $patients->links() }}</ul>
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
