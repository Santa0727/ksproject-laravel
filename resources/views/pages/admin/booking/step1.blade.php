@extends('layout.admin', ['activePage' => 'booking', 'titlePage' => __('Booking')])

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="mainForm" method="post" action="step2" autocomplete="off" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" value="{{ (empty($booking->id)) ? 0 : $booking->id }}">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="far fa-clipboard"></i>
                            </div>
                            <h4 class="card-title">Booking(Select Show)</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-success btn-sm">Next</button>
                                    <a href="{{ route('admin-booking') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label">Event</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <select name="event_id" class="custom-select" required>
                                                    <option value=""></option>
                                                <?php
                                                    foreach ($events as $event) {
                                                ?>
                                                    <option value="{{ $event->id }}" >{{ $event->title }}</option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label">Showtime</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <select name="show_id" class="custom-select" required>
                                                    <!-- <option value=""></option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="preview">
                                        <div class="preview-image">
                                            <img src="" alt="" id="eventImage">
                                        </div>
                                        <div class="preview-info">
                                            <h4 id="eventTitle"></h4>
                                            <h6 id="eventDuration"></h6>
                                            <h6 id="eventHall"></h6>
                                            <h6 id="eventPeriod"></h6>
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
        $('form#mainForm select[name="event_id"]').on('change', function(){
            var event_id = $(this).val();
            if (event_id == '') {
                $('form#mainForm select[name="show_id"]').html('<option value=""></option>');
                $('#eventImage').attr('src', '');
                $('#eventTitle').text('');
                $('#eventDuration').text('');
                $('#eventHall').text('');
                $('#eventPeriod').text('');
            } else {
                $.ajax({
                    url: 'step1/event',
                    type: 'POST',
                    data: {
                        '_token': $('form#mainForm input[name="_token"]').val(),
                        'event_id': event_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == 'success') {
                            $('#eventImage').attr('src', 'event/image/' + data.event.id);
                            $('#eventTitle').text(data.event.title);
                            $('#eventDuration').text('DURATION: ' + data.event.duration);
                            $('#eventHall').text('HALL: ' + data.event.venue_name);
                            $('#eventPeriod').text('PERIOD: ' + data.event.from_date + ' ~ ' + data.event.to_date);
                            var temp_show_id_text = 'PERIOD: ' + data.event.from_date + ' ~ ' + data.event.to_date;
                            $('form#mainForm select[name="show_id"]').html('<option value="'+event_id+'">'+temp_show_id_text+'</option>');
                            for (i = 0; i < data.shows.length; i++) {
                                var show_date = data.shows[i].date_time.substr(0, 10);
                                var show_time = data.shows[i].date_time.substr(11);
                                if (show_time == '15:00:00') {
                                    show_time = '3:00 pm';
                                } else if (show_time == '20:00:00') {
                                    show_time = '8:00 pm';
                                }
                                $('form#mainForm select[name="show_id"]').append('<option value="' + data.shows[i].id + '">' + show_date + ' ' + show_time + '</option>')
                            }
                        } else {
                            $('form#mainForm select[name="show_id"]').html('<option value="0"></option>');
                            $('#eventImage').attr('src', '');
                            $('#eventTitle').text('');
                            $('#eventDuration').text('');
                            $('#eventHall').text('');
                            $('#eventPeriod').text('');
                        }
                    }
                });
            }
        });
        $('form#mainForm button[type="submit"]').on('click', function(){
            if ($('form#mainForm').valid) {
            }
        });
    });
</script>
@endpush
