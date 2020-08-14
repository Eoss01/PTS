@extends('layouts.master')

@section('title')
    Patient List
@endsection

@section('second-index')
    Patient List
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="/doctor.doctor-dashboard" class="btn btn-danger">Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">
                          @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                          @endif
                            <thead style="text-align:center;overflow-x:auto;">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Advice</th>                                
                                <th>Prescription</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Updated At</th>
                                <th>Operation</th>                                 
                            </thead>

                            <tbody style="text-align:center;overflow-x:auto;">
                                @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->patient_id }}</td>
                                    <td>{{ $patient->patient_name  }}</td>
                                    <td>{{ $patient->patient_phone }}</td>
                                    <td>{{ $patient->advice  }}</td>
                                    <td>{{ $patient->prescription  }}</td>
                                    <td>{{ $patient->appointment_date  }}</td>
                                    <td>{{ $patient->appointment_time  }}</td>
                                    <td>{{ $patient->updated_at  }}</td>
                                    <td>
                                        <a href="/doctor-view-patient-health-index/{{ $patient->patient_id }}" class="btn btn-primary">View</a>
                                        <a href="/doctor-modify-advice/{{ $patient->patient_id }}" class="btn btn-sucess">Edit</a>  
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready( function () {
      $('#dataTable').DataTable();
  });
</script>
@endsection

