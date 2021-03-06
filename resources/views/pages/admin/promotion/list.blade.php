@extends('layout.admin', ['activePage' => 'promotion', 'titlePage' => __('Promotion')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form id="mainForm" method="post" action="" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="fas fa-gift"></i>
                                </div>
                                <h4 class="card-title">Packages</h4>
                            </div>
                            <div class="card-body">
                                <div class="dataTables_wrapper">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <div class="toolbar">
                                                <a href="{{ route('admin-promotion-edit') }}" class="btn btn-success btn-sm btn-edit" data-id="0">New Package</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Ticket Type</th>
                                                        <th>Tickets</th>
                                                        <th>Active</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>BUY 2 FREE 1</td>
                                                        <td>VIP</td>
                                                        <td>3</td>
                                                        <td>
                                                            <i class="fa fa-check"></i>
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <a href="{{ route('admin-promotion-edit') }}" class="btn btn-success btn-edit" data-id=""><i class="fas fa-pencil-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>BUY 2 FREE 1</td>
                                                        <td>Concession</td>
                                                        <td>3</td>
                                                        <td>
                                                            <i class="fa fa-check"></i>
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <a href="{{ route('admin-promotion-edit') }}" class="btn btn-success btn-edit" data-id=""><i class="fas fa-pencil-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>BUY 3 FREE 1</td>
                                                        <td>VIP</td>
                                                        <td>4</td>
                                                        <td>
                                                            <i class="fa fa-check"></i>
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <a href="{{ route('admin-promotion-edit') }}" class="btn btn-success btn-edit" data-id=""><i class="fas fa-pencil-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>BUY 3 FREE 1</td>
                                                        <td>Concession</td>
                                                        <td>4</td>
                                                        <td>
                                                            <i class="fa fa-check"></i>
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <a href="{{ route('admin-promotion-edit') }}" class="btn btn-success btn-edit" data-id=""><i class="fas fa-pencil-alt"></i></a>
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
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
