
<?php
    if (empty($params['showdate'])) {
        $showdate = '';
    } else {
        $showdate = date_create_from_format('Y-m-d', $params['showdate']);
        $showdate = date_format($showdate, 'Y-m-d');
    }
    $showtimes = [];
    if (!empty($shows)) {
        foreach ($shows as $show) {
            $showtime = date_create_from_format('Y-m-d H:i:s', $show->date_time);
            $showtimes[date_format($showtime, 'H:i')] = $show;
        }
    }
?>
<form id="editForm" method="post" autocomplete="off" class="form-horizontal">
    @csrf
    <div class="card-body">
        <div class="row">
            <label class="col-sm-4 col-form-label">Date</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <input class="form-control-plaintext" name="showdate" type="text" readonly value="{{ $showdate }}">
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Times</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="showtime3" value="3:00 pm" {{ array_key_exists('15:00', $showtimes) ? 'checked' : '' }}> 3 pm
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="togglebutton">
                        <label>
                            <input type="checkbox" id="status3" value="{{ config('ticketing.available.yes') }}" {{ (array_key_exists('15:00', $showtimes) && $showtimes['15:00']->status == config('ticketing.available.yes')) ? 'checked' : '' }}>
                            <span class="toggle"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="showtime8" value="8:00 pm" {{ array_key_exists('20:00', $showtimes) ? 'checked' : '' }}> 8 pm
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="togglebutton">
                        <label>
                            <input type="checkbox" id="status8" value="{{ config('ticketing.available.yes') }}" {{ (array_key_exists('20:00', $showtimes) && $showtimes['20:00']->status == config('ticketing.available.yes')) ? 'checked' : '' }}>
                            <span class="toggle"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
