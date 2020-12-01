@extends('layout.admin', ['activePage' => 'event', 'titlePage' => __('Shows')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="mainForm" method="post" enctype="multipart/form-data" action="save" autocomplete="off" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" value="{{ (empty($event->id)) ? 0 : $event->id }}">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-film"></i>
                            </div>
                            <h4 class="card-title">Add Event</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                    <a href="{{ route('admin-event-list') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input class="form-control" name="title" type="text" placeholder="" value="{{ empty($event->title) ? '' : $event->title }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Duration</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input class="form-control" name="duration" type="text" placeholder="" value="{{ empty($event->duration) ? '' : $event->duration }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Descripton</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <textarea class="form-control" name="description" placeholder="" rows="3">{{ empty($event->description) ? '' : $event->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Hall</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                            @if (empty($event))
                                                <select class="custom-select" name="venue_id" required>
                                                    <option value=""></option>
                                                    <?php foreach ($venues as $venue) { ?>
                                                        <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                                    <?php } ?>
                                                </select>
                                            @else
                                                <input type="hidden" name="venue_id" value="{{ $event->venue_id }}">
                                                <input class="form-control-plaintext" readonly type="text" value="{{ $event->venue_name }}">
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Period</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input class="form-control datepicker" name="from_date" type="text" placeholder="" value="{{ empty($event->from_date) ? '' : $event->from_date }}" required style="display: inline-block; width: 100px; padding-left: 10px;">
                                                ~
                                                <input class="form-control datepicker" name="to_date" type="text" placeholder="" value="{{ empty($event->to_date) ? '' : $event->to_date }}" required style="display: inline-block; width: 100px; padding-left: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Active</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <div class="togglebutton">
                                                    <label>
                                                        <input type="checkbox" name="status" value="{{ config('ticketing.available.yes') }}" {{ (empty($event->status) || $event->status == config('ticketing.available.yes')) ? 'checked' : '' }}>
                                                        <span class="toggle"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-7">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="text-left">
                                                    <span class="btn btn-file btn-sm">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="event_image">
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists btn-sm" data-dismiss="fileinput">
                                                        <i class="fa fa-times"></i> Remove
                                                    </a>
                                                </div>
                                                <div class="fileinput-new">
                                                    <img src="image/{{ empty($event->id) ? 0 : $event->id }}" alt="..." style="max-width: 100%;">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists"></div>
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
