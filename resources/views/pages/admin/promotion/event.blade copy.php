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
                                <h4 class="card-title">Promotion Events</h4>
                            </div>
                            <div class="card-body">
                                <div class="dataTables_wrapper">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <div class="toolbar">
                                                <a href="#" class="btn btn-success btn-sm btn-edit" data-id="0">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Event</th>
                                                        <th></th>
                                                        <th>Date Range</th>
                                                        <th>Quota</th>
                                                        <th>Price</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>BUY 2 FREE 1</td>
                                                        <td>3</td>
                                                        <td>VIP</td>
                                                        <td>100</td>
                                                        <td>2019-08-01 ~ 2019-08-31</td>
                                                        <td>150</td>
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
                                                        <td>3</td>
                                                        <td>Concession</td>
                                                        <td>100</td>
                                                        <td>2019-08-01 ~ 2019-08-31</td>
                                                        <td>150</td>
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
                                                        <td>4</td>
                                                        <td>VIP</td>
                                                        <td>100</td>
                                                        <td>2019-08-01 ~ 2019-08-31</td>
                                                        <td>180</td>
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
                                                        <td>3</td>
                                                        <td>Concession</td>
                                                        <td>100</td>
                                                        <td>2019-08-01 ~ 2019-08-31</td>
                                                        <td>180</td>
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
