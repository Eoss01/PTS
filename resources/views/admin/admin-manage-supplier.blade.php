@extends('layouts.master')

@section('title')
Supplier List
@endsection

@section('second-index')
Supplier List
@endsection

@section('hidden_chart')
<div class="panel-header panel-header-sm"></div>
@endsection

@section('sidebar')
<div class="sidebar" data-color="blue">
    <div class="logo">
        <a href="/admin.admin-dashboard" class="simple-text logo-mini">
            PTS
        </a>
        <a href="/admin.admin-dashboard" class="simple-text logo-normal">
            Patient Tracking
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li
                class="{{ 'admin.admin-dashboard' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-dashboard">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li
                class="{{ 'admin.admin-manage-doctor' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-manage-doctor">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>Manage Doctors</p>
                </a>
            </li>

            <li
                class="{{ 'admin.admin-manage-patient' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-manage-patient">
                    <i class="now-ui-icons users_circle-08"></i>
                    <p>Manage Patients</p>
                </a>
            </li>

            <li
                class="{{ 'admin.admin-manage-supplier' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-manage-supplier">
                    <i class="now-ui-icons business_bank"></i>
                    <p>Manage Suppliers</p>
                </a>
            </li>

            <li
                class="{{ 'admin.admin-user-list' == request()->path() ? 'active' : '' }}">
                <a href="/admin.admin-user-list">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>User List</p>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="modal fade" id="acceptmodelpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="accept_model_form" method="POST">
                {{ csrf_field() }}
                {{ method_field('GET') }}

                <div class="modal-body">
                    <input type="hidden" id="accept_supplier_record" />
                    <h6 style="text-align: center;">Are you sure to accept this supplier?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes, accept it</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="declinemodelpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="decline_model_form" method="POST">
                {{ csrf_field() }}
                {{ method_field('GET') }}

                <div class="modal-body">
                    <input type="hidden" id="decline_supplier_record" />
                    <h6 style="text-align: center;">Are you sure to decline this supplier?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes, decline it</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="/admin.admin-dashboard" class="btn btn-danger">Back</a>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Request At</th>
                                <th>Status</th>
                                <th>Operation</th>
                            </thead>

                            <tbody style="text-align:center;overflow-x:auto;">
                                @foreach($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->supplier_id }}</td>
                                        <td>{{ $supplier->supplier_name }}</td>
                                        <td>{{ $supplier->supplier_phone }}</td>
                                        <td>{{ $supplier->supplier_email }}</td>
                                        <td>{{ $supplier->supplier_address }}</td>
                                        <td>{{ $supplier->supplier_description }}</td>
                                        <td>{{ $supplier->created_at }}</td>
                                        <td>{{ $supplier->status }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sucess acceptbtn">Accept</a>
                                            <a href="javascript:void(0)" class="btn btn-danger declinebtn">Decline</a>
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
    $(document).ready(function () {
        $('#dataTable').DataTable();

        $('#dataTable').on('click', '.acceptbtn', function () {

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            $('#accept_supplier_record').val(data[0]);

            $('#accept_model_form').attr('action', '/admin-manage-supplier-status-accept/' + data[0]);

            $('#acceptmodelpop').modal('show');
        });

        $('#dataTable').on('click', '.declinebtn', function () {

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            $('#decline_supplier_record').val(data[0]);

            $('#decline_model_form').attr('action', '/admin-manage-supplier-status-decline/' + data[0]);

            $('#declinemodelpop').modal('show');
        });

    });

</script>
@endsection
