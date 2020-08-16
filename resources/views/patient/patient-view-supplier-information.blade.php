@extends('layouts.master')


@section('title')
Supplier Location
@endsection

@section('second-index')
Supplier Location
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
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                Supplier Location
              </div>
              <div class="card-body ">
                <div><iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d13415.21768298415!2d103.62997507510143!3d1.5448783791358776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1smedical%20equipment%20supplier!5e0!3m2!1szh-CN!2smy!4v1597584527329!5m2!1szh-CN!2smy" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection


@section('scripts')

@endsection
