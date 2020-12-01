@extends('layout.admin', ['activePage' => 'booking', 'titlePage' => __('Booking')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form id="mainForm" method="post" action="" autocomplete="off">
                @csrf
                <input type="hidden" name="id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="far fa-clipboard"></i>
                                </div>
                                <h4 class="card-title">Bookings</h4>
                            </div>
                            <div class="card-body">
                                <div class="dataTables_wrapper">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="dataTables_filter">
                                                <div class="dataTables_filter_item">
                                                    <label>Date</label>
                                                    <input type="text" name="from_date" class="form-control form-control-sm datepicker" value="{{ empty($params['from_date']) ? '' : $params['from_date'] }}" placeholder="from">
                                                    <label> ~ </label>
                                                    <input type="text" name="to_date" class="form-control form-control-sm datepicker" value="{{ empty($params['to_date']) ? '' : $params['to_date'] }}" placeholder="to">
                                                </div>
                                                <div class="dataTables_filter_item">
                                                    <label>Payment Type</label>
                                                    <select name="payment_type" class="custom-select custom-select-sm filter-control">
                                                        <option value=""></option>
                                                    <?php
                                                        foreach (config('ticketing.payment_type') as $key => $value) {
                                                    ?>
                                                        <option value="{{ $value }}" {{ (!empty($params['payment_type']) && $params['payment_type'] == $value) ? 'selected' : '' }}>{{ $key }}</option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="dataTables_filter_item">
                                                    <label>Ticket</label>
                                                    <select name="ticket_type" class="custom-select custom-select-sm filter-control">
                                                        <option value=""></option>
                                                    <?php
                                                        foreach (config('ticketing.ticket_type') as $key => $value) {
                                                    ?>
                                                        <option value="{{ $key }}" {{ (!empty($params['ticket_type']) && $params['ticket_type'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="dataTables_filter_item">
                                                    <label>counter</label>
                                                    <select name="counter" class="custom-select custom-select-sm filter-control">
                                                        <option value=""></option>
                                                    <?php
                                                        foreach ($counters as $counter) {
                                                    ?>
                                                        <option value="{{ $counter->id }}" {{ (!empty($params['counter']) && $params['counter'] == $counter->id) ? 'selected' : '' }}>{{ $counter->uid }}</option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="dataTables_filter_item">
                                                    <label>Agent ID</label>
                                                    <input type="text" name="agent" class="form-control form-control-sm filter-control" value="{{ empty($params['agent']) ? '' : $params['agent'] }}" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <div class="toolbar">
                                                <a href="#" class="btn btn-success btn-sm btn-edit" data-id="0">Add</a>

                                                <div class="dropdown pull-left">
                                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    Export <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                    <li>
                                                        <a href="#action">Excel</a>
                                                    </li>
                                                    <li>
                                                        <a href="#action">PDF</a>
                                                    </li>
                                                </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Tickets</th>
                                                        <th>Event</th>
                                                        <th>Showtime</th>
                                                        <th>Status</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if (count($bookings) == 0)
                                                    <tr>
                                                        <td colspan="7">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                @else
                                                    <?php
                                                        $index = ($params['page'] - 1) * $params['rows'] + 1;
                                                        foreach ($bookings as $booking) {
                                                    ?>
                                                    <tr>
                                                        <td>{{ $index }}</td>
                                                        <td>{{ $booking->client_name }}</td>
                                                        <td></td>
                                                        <td>{{ $booking->event_title }}</td>
                                                        <td>{{ $booking->show_date_time }}</td>
                                                        <td></td>
                                                        <td class="td-actions text-right">
                                                            <a href="#" class="btn btn-info btn-invoice" data-id="{{ $booking->id }}"><i class="fas fa-wrench"></i></a>
                                                            <a href="#" class="btn btn-success btn-edit" data-id="{{ $booking->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                            $index++;
                                                        }
                                                    ?>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @include('layout.admin_pagination', ['params' => $params, 'records' => $bookings])
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
<script src="{{ asset('js/pages/pagination.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.btn-edit').on('click', function(){
            var id = $(this).attr('data-id');
            $('form#mainForm input[name="id"]').val(id);
            $('form#mainForm').attr('action', 'booking/step1');
            $('form#mainForm').submit();
        });
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: "far fa-clock",
                date: "far fa-calendar-alt",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        }).on('dp.change', function(){
            goPage(1);
        });
        $('form#mainForm .filter-control').on('change', function(){
            goPage(1);
        });
    });
</script>
@endpush
