<form id="editForm" method="post" autocomplete="off" class="form-horizontal">
    @csrf
    <input type="hidden" name="id" value="{{ (empty($event->id)) ? 0 : $event->id }}">
    <div class="card-body">
        <div class="row">
            <label class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <input class="form-control" name="name" type="text" value="{{ empty($event->name) ? '' : $event->name }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Show</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <select name="event_id" class="custom-select" required>
                        <option value=""></option>
                        <?php
                            foreach ($shows as $show) {
                        ?>
                            <option value="{{ $show->id }}" {{ (!empty($event->event_id) && $event->event_id == $show->id) ? 'selected' : '' }}>{{ $show->title }}</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Ticket Type</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <select name="ticket_type" class="custom-select" required>
                        <option value=""></option>
                        <optgroup label="Normal">
                        <?php
                            foreach (config('ticketing.ticket_type') as $key => $value) {
                        ?>
                            <option value="{{ $key }}" data-type="normal" {{ (!empty($event->ticket_type) && $event->ticket_type == $key) ? 'selected' : '' }}>{{ $value }}</option>
                        <?php
                            }
                        ?>
                        </optgroup>
                        <optgroup label="Package">
                        <?php
                            foreach ($packages as $package) {
                        ?>
                            <option value="{{ $package->id }}" data-type="package" {{ (!empty($event->package_id) && $event->package_id == $package->id) ? 'selected' : '' }}>{{ $package->name . '(' . config('ticketing.ticket_type')[$package->ticket_type] . ')' }}</option>
                        <?php
                            }
                        ?>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Date Range</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <input class="form-control datepicker" type="text" name="from_date" value="{{ empty($event->from_date) ? '' : $event->from_date }}" required style="display: inline-block; width: 100px;">
                    <label> ~ </label>
                    <input class="form-control datepicker" type="text" name="to_date" value="{{ empty($event->to_date) ? '' : $event->to_date }}" required style="display: inline-block; width: 100px;">
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Quota</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <input class="form-control" name="quota" type="text" value="{{ empty($event->quota) ? '' : $event->quota }}">
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Price</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <input class="form-control" name="price" type="text" value="{{ empty($event->price) ? '' : $event->price }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Weekday/Weekend</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <select name="week" class="custom-select" required>
                        <option value=""></option>
                        <?php
                            foreach (config('ticketing.week') as $key => $value) {
                        ?>
                            <option value="{{ $key }}" {{ (!empty($event->week) && $event->week == $key) ? 'selected' : '' }}>{{ $value }}</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Active</label>
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
            <label class="col-sm-4 col-form-label">Limit</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <div class="togglebutton">
                        <label>
                            <input type="checkbox" name="limit_status" value="{{ config('ticketing.available.yes') }}" {{ (!empty($event->limit_status) && $event->limit_status == config('ticketing.available.yes')) ? 'checked' : '' }}>
                            <span class="toggle"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Limit Date</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <input class="form-control datepicker" type="text" name="limit_start" value="{{ empty($event->limit_start) ? '' : $event->limit_start }}" {{ (!empty($event->limit_status) && $event->limit_status == config('ticketing.available.yes')) ? 'required' : 'disabled' }} style="display: inline-block; width: 100px;">
                    <label> ~ </label>
                    <input class="form-control datepicker" type="text" name="limit_end" value="{{ empty($event->limit_end) ? '' : $event->limit_end }}" {{ (!empty($event->limit_status) && $event->limit_status == config('ticketing.available.yes')) ? 'required' : 'disabled' }} style="display: inline-block; width: 100px;">
                </div>
            </div>
        </div>
    </div>
</form>
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
