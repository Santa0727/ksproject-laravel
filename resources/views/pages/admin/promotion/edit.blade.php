@extends('layout.admin', ['activePage' => 'promotion', 'titlePage' => __('Promotion')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="mainForm" method="post" action="save" autocomplete="off" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h4 class="card-title">New Package</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('admin-promotion') }}" class="btn btn-success btn-sm">Save</a>
                                    <a href="{{ route('admin-promotion') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="Name" type="text" value="BUY 2 FREE 1" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Ticket Type</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select name="ticket_type" class="custom-select" style="width: auto;" required>
                                        <?php
                                            foreach (config('ticketing.ticket_type') as $key => $value) {
                                        ?>
                                            <option value="{{ $value }}">{{ $key }}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Tickets</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="seats" type="text" value="3" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Active</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <div class="togglebutton">
                                            <label>
                                                <input type="checkbox" name="is_active" value="{{ config('ticketing.available.yes') }}" checked>
                                                <span class="toggle"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
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
        });
    });
</script>
@endpush
