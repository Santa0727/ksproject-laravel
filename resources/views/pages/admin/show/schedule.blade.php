@extends('layout.admin', ['activePage' => 'show', 'titlePage' => __('Shows')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <form id="mainForm" method="post" action="" class="form-horizontal">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <input type="hidden" name="year" value="{{ $params['year'] }}">
            <input type="hidden" name="month" value="{{ $params['month'] }}">

            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-film"></i>
                            </div>
                            <h4 class="card-title">{{ __('Showtimes') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <ul class="nav nav-pills nav-pills-success nav-pills-icons flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#calender" role="tablist">
                                                <i class="far fa-calendar-alt"></i> Calender
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#list" role="tablist">
                                                <i class="fas fa-th-list"></i> List
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 class="schedule-title"></h4>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <a href="#" class="btn btn-sm btn-success btn-prev"><i class="fas fa-angle-left"></i></a>
                                            <a href="#" class="btn btn-sm btn-success btn-next"><i class="fas fa-angle-right"></i></a>
                                            <a href="{{ route('admin-event-list') }}" class="btn btn-sm">Back to list</a>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="calender">
                                            <div class="calender-wrapper">
                                                <table class="table table-bordered table-hover table-calendar dataTable" id="calendarTable">
                                                    <colgroup>
                                                        <col width="14.2857%">
                                                        <col width="14.2857%">
                                                        <col width="14.2857%">
                                                        <col width="14.2857%">
                                                        <col width="14.2857%">
                                                        <col width="14.2857%">
                                                        <col width="14.2857%">
                                                    </colgroup>
                                                    <thead>
                                                        <tr>
                                                            <th>Sun</th>
                                                            <th>Mon</th>
                                                            <th>Tue</th>
                                                            <th>Wen</th>
                                                            <th>Thu</th>
                                                            <th>Fri</th>
                                                            <th>Sat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $weekdays = ['Sun', 'Mon', 'Tue', 'Wen', 'Thu', 'Fri', 'Sat'];
                                                            $first_date = mktime(0, 0, 0, $params['month'], 1, $params['year']);

                                                            $weekday = date('w', $first_date);
                                                            $last_day = date('t', $first_date);
                                                            
                                                            if ($weekday > 0) {
                                                        ?>
                                                        <tr>
                                                        <?php
                                                                for ($i = 0; $i < $weekday; $i++) {
                                                        ?>
                                                            <td></td>
                                                        <?php
                                                                }
                                                            }
                                                            for ($day = 1; $day <= $last_day; $day++) {
                                                                if ($weekday == 0) {
                                                        ?>
                                                        <tr>
                                                        <?php
                                                                }
                                                        ?>
                                                            <td>
                                                                <span class="">{{ $day }}</span>
                                                                <span class=""></span>
                                                            </td>
                                                        <?php
                                                                if ($weekday == 6) {
                                                        ?>
                                                        </tr>
                                                        <?php
                                                                }
                                                                $weekday = ($weekday + 1) % 7;
                                                            }
                                                            if ($weekday > 0) {
                                                                for ($i = $weekday; $i <= 6; $i++) {
                                                        ?>
                                                            <td></td>
                                                        <?php
                                                                }
                                                        ?>
                                                        </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="list">
                                            <table class="table table-no-bordered table-hover dataTable" id="listTable">
                                                <thead>
                                                    <tr>
                                                        <th>Day</th>
                                                        <th>Day of Week</th>
                                                        <th>Showtimes</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-profile">
                        <div class="card-header">
                            <img class="img" src="image/{{ $event->id }}" alt="" style="max-width: 250px;">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ $event->title }}</h4>
                            <h6 class="card-category text-gray">Duration: {{ $event->duration }}</h6>
                            <h6 class="card-category text-gray">Hall: {{ $event->venue_name }}</h6>
                            <h6 class="card-category text-gray">Period: {{ $event->from_date . ' ~ ' . $event->to_date }}</h6>
                            <h6 class="card-category text-gray">Show Time: {{ $event->time }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="card card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title">Showtimes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-save">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var weekdays = ['Sun', 'Mon', 'Tue', 'Wen', 'Thu', 'Fri', 'Sat'];
    var getShowtimes = function(year, month) {
        $.ajax({
            url: 'list',
            type: 'POST',
            data: {
                '_token': $('form#mainForm input[name="_token"]').val(),
                'event_id': $('form#mainForm input[name="event_id"]').val(),
                'year': year,
                'month': month
            },
            dataType: 'json',
            success: function(data) {
                if (data.result != 'success') {
                    return;
                }
                $('form#mainForm input[name="year"]').val(year);
                $('form#mainForm input[name="month"]').val(month);
                $('.schedule-title').text(months[month - 1] + ' ' + year);

                var list_content = '';
                var first_date = new Date(year, month - 1, 1);
                var last_day = new Date(year, month, 0).getDate();
                var weekday = first_date.getDay();
                for (day = 1; day <= last_day; day++) {
                    list_content += '<tr class="' + weekdays[weekday].toLowerCase() + '">' + 
                                    '<td><span class="">' + day + '</span></td>' + 
                                    '<td><span class="">' + weekdays[weekday] + '</span></td>' + 
                                    '<td data-day="' + day + '"></td>' + 
                                    '<td class="td-actions text-right"><a href="#" class="btn btn-success btn-edit" data-day="' + day + '"><i class="fas fa-pencil-alt"></i></a></td>' + 
                                    '</tr>';
                    weekday = (weekday + 1) % 7;
                }
                $('#listTable tbody').html(list_content);

                var calendar_content = '';
                weekday = first_date.getDay();
                if (weekday > 0) {
                    calendar_content += '<tr>';
                    for (i = 0; i < weekday; i++) {
                        calendar_content += '<td></td>';
                    }
                }
                for (day = 1; day <= last_day; day++) {
                    if (weekday == 0) {
                        calendar_content += '<tr>';
                    }
                    calendar_content += '<td data-day="' + day + '"><div class="showdate">' + 
                                        '<span class="day">' + day + '</span>' + 
                                        '</div></td>';
                    if (weekday == 6) {
                        calendar_content += '</tr>';
                    }
                    weekday = (weekday + 1) % 7;
                }
                if (weekday > 0) {
                    for (i = weekday; i <= 6; i++) {
                        calendar_content += '<td></td>';
                    }
                    calendar_content += '</tr>';
                }
                $('#calendarTable tbody').html(calendar_content);

                if (data.shows.length > 0) {
                    for (i = 0; i < data.shows.length; i++) {
                        show = data.shows[i];
                        show_day = parseInt(show.date_time.substr(8, 2));
                        show_hour = parseInt(show.date_time.substr(11, 2));
                        show_minute = show.date_time.substr(14, 2);
                        if (show_hour > 12)
                            show_time = '' + (show_hour - 12) + ':' + show_minute + ' pm';
                        else
                            show_time = '' + show_hour + ':' + show_minute + ' am';
                        show_status = (show.status == '{{ config('ticketing.available.yes') }}') ? 'active' : 'inactive';
                        calendar_day_content = '<span class="showtime showtime-' + show_status + '">' + show_time + '</span>';
                        $('#calendarTable tbody td[data-day="' + show_day + '"] .showdate').append(calendar_day_content);
                        $('#listTable tbody td[data-day="' + show_day + '"]').append(calendar_day_content);
                    }
                }
                $('#calendarTable tbody td').on('click', function(){
                    var day = $(this).attr('data-day');
                    if (day == undefined) {
                        return;
                    }
                    openEditModal(day);
                });
                $('#listTable tbody td .btn-edit').on('click', function(){
                    var day = $(this).attr('data-day');
                    openEditModal(day);
                });
            }
        });
    };
    var openEditModal = function(day) {
        var showdate = $('form#mainForm input[name="year"]').val() + '-' + $('form#mainForm input[name="month"]').val() + '-' + day;
        $.ajax({
            url: 'edit',
            type: 'POST',
            data: {
                '_token': $('form#mainForm input[name="_token"]').val(),
                'event_id': $('form#mainForm input[name="event_id"]').val(),
                'showdate': showdate
            },
            success: function(result) {
                $('#editModal .modal-body').html(result);
                $('#editModal').modal('show');
            }
        });
    };
    $(document).ready(function() {
        $('.btn-prev').on('click', function(){
            var year = parseInt($('form#mainForm input[name="year"]').val());
            var month = parseInt($('form#mainForm input[name="month"]').val());
            month = month - 1;
            if (month < 1) {
                year = year - 1;
                month = 12;
            }
            getShowtimes(year, month);
        });
        $('.btn-next').on('click', function(){
            var year = parseInt($('form#mainForm input[name="year"]').val());
            var month = parseInt($('form#mainForm input[name="month"]').val());
            month = month + 1;
            if (month > 12) {
                year = year + 1;
                month = 1;
            }
            getShowtimes(year, month);
        });
        $('.btn-save').on('click', function(){
            var showdate = $('form#editForm input[name="showdate"]').val();
            var showtime = [];
            var status = [];
            if ($('form#editForm input#showtime3').is(':checked')) {
                showtime.push($('form#editForm input#showtime3').val());
                if ($('form#editForm input#status3').is(':checked')) {
                    status.push('{{config('ticketing.available.yes')}}');
                } else {
                    status.push('{{config('ticketing.available.no')}}');
                }
            }
            if ($('form#editForm input#showtime8').is(':checked')) {
                showtime.push($('form#editForm input#showtime8').val());
                if ($('form#editForm input#status8').is(':checked')) {
                    status.push('{{config('ticketing.available.yes')}}');
                } else {
                    status.push('{{config('ticketing.available.no')}}');
                }
            }
            $.ajax({
                url: 'save',
                type: 'POST',
                data: {
                    '_token': $('form#mainForm input[name="_token"]').val(),
                    'event_id': $('form#mainForm input[name="event_id"]').val(),
                    'showdate': showdate,
                    'showtime': showtime,
                    'status': status
                },
                dataType: 'json',
                success: function(data) {
                    if (data.result == 'success') {
                        show_day = parseInt(showdate.substr(8, 2));

                        $('#calendarTable tbody td[data-day="' + show_day + '"] .showdate').html('<span class="day">' + show_day + '</span>');
                        $('#listTable tbody td[data-day="' + show_day + '"]').html('');
                        
                        calendar_day_content = '';
                        for (i = 0; i < showtime.length; i++) {
                            show_status = (status[i] == '{{ config('ticketing.available.yes') }}') ? 'active' : 'inactive';
                            calendar_day_content += '<span class="showtime showtime-' + show_status + '">' + showtime[i] + '</span>';
                        }
                        $('#calendarTable tbody td[data-day="' + show_day + '"] .showdate').append(calendar_day_content);
                        $('#listTable tbody td[data-day="' + show_day + '"]').append(calendar_day_content);
                        $('#editModal').modal('hide');
                    }
                }
            });
        });

        getShowtimes({{ $params['year'] }}, {{ $params['month'] }});
    });
</script>
@endpush
