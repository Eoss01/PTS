@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('second-index')
    Total Health Index
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

    <div class="col-md-6">
      <div class="card card-chart">
        <div class="card-header">
          <h4 class="card-title">Average Blood Pressure (In Months)</h4>
          <div class="dropdown">
            <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
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
          <h4 class="card-title">Average Blood Pressure (In Days)</h4>
          <div class="dropdown">
            <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
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
            <canvas id="barChartSimpleGradientsNumbers"></canvas>
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

  <div class="row">

    <div class="col-md-6">
      <div class="card card-chart">
        <div class="card-header">
          <h4 class="card-title">Average Blood Sugar (In Months)</h4>
          <div class="dropdown">
            <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
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


    <div class="col-md-6">
      <div class="card card-chart">
        <div class="card-header">
          <h4 class="card-title">Average Blood Sugar (In Days)</h4>
          <div class="dropdown">
            <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
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
            <canvas id="barChartSimpleGradientsNumbers"></canvas>
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

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Patient List</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>
                  Name
                </th>
                <th>
                  Country
                </th>
                <th>
                  City
                </th>
                <th class="text-right">
                  Salary
                </th>
              </thead>
              <tbody>
                <tr>
                  <td>
                    Dakota Rice
                  </td>
                  <td>
                    Niger
                  </td>
                  <td>
                    Oud-Turnhout
                  </td>
                  <td class="text-right">
                    $36,738
                  </td>
                </tr>
                <tr>
                  <td>
                    Minerva Hooper
                  </td>
                  <td>
                    Curaçao
                  </td>
                  <td>
                    Sinaai-Waas
                  </td>
                  <td class="text-right">
                    $23,789
                  </td>
                </tr>
                <tr>
                  <td>
                    Sage Rodriguez
                  </td>
                  <td>
                    Netherlands
                  </td>
                  <td>
                    Baileux
                  </td>
                  <td class="text-right">
                    $56,142
                  </td>
                </tr>
                <tr>
                  <td>
                    Doris Greene
                  </td>
                  <td>
                    Malawi
                  </td>
                  <td>
                    Feldkirchen in Kärnten
                  </td>
                  <td class="text-right">
                    $63,542
                  </td>
                </tr>
                <tr>
                  <td>
                    Mason Porter
                  </td>
                  <td>
                    Chile
                  </td>
                  <td>
                    Gloucester
                  </td>
                  <td class="text-right">
                    $78,615
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Advice List</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>
                  Name
                </th>
                <th>
                  Country
                </th>
                <th>
                  City
                </th>
                <th class="text-right">
                  Salary
                </th>
              </thead>
              <tbody>
                <tr>
                  <td>
                    Dakota Rice
                  </td>
                  <td>
                    Niger
                  </td>
                  <td>
                    Oud-Turnhout
                  </td>
                  <td class="text-right">
                    $36,738
                  </td>
                </tr>
                <tr>
                  <td>
                    Minerva Hooper
                  </td>
                  <td>
                    Curaçao
                  </td>
                  <td>
                    Sinaai-Waas
                  </td>
                  <td class="text-right">
                    $23,789
                  </td>
                </tr>
                <tr>
                  <td>
                    Sage Rodriguez
                  </td>
                  <td>
                    Netherlands
                  </td>
                  <td>
                    Baileux
                  </td>
                  <td class="text-right">
                    $56,142
                  </td>
                </tr>
                <tr>
                  <td>
                    Doris Greene
                  </td>
                  <td>
                    Malawi
                  </td>
                  <td>
                    Feldkirchen in Kärnten
                  </td>
                  <td class="text-right">
                    $63,542
                  </td>
                </tr>
                <tr>
                  <td>
                    Mason Porter
                  </td>
                  <td>
                    Chile
                  </td>
                  <td>
                    Gloucester
                  </td>
                  <td class="text-right">
                    $78,615
                  </td>
                </tr>
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

@endsection