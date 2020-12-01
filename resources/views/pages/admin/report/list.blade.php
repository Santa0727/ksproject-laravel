@extends('layout.admin', ['activePage' => 'report', 'titlePage' => __('Report')])

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
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h4 class="card-title">Report</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="#" class="btn btn-success btn-sm">Export</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label label-checkbox">File Type</label>
                                    <div class="col-sm-8 checkbox-radios">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="file_type" value="pdf" checked> PDF
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="file_type" value="csv"> CSV
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Date Range</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control datepicker" name="from_date" type="text" placeholder="from" value="" style="display: inline-block; width: 100px;">
                                            ~
                                            <input class="form-control datepicker" name="to_date" type="text" placeholder="to" value="" style="display: inline-block; width: 100px;">
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
