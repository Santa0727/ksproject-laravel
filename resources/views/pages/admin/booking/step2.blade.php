@extends('layout.admin', ['activePage' => 'booking', 'titlePage' => __('Booking')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="mainForm" method="post" action="step3" autocomplete="off" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="show_id" value="{{ $show->id }}">
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <input type="hidden" name="seats">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="far fa-clipboard"></i>
                            </div>
                            <h4 class="card-title">Booking(Select Seats)</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('admin-booking-step1') }}" class="btn btn-sm">Previous</a>
                                    <a href="#" class="btn btn-success btn-sm btn-step3">Next</a>
                                    <a href="{{ route('admin-booking') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="preview">
                                                <div class="preview-image">
                                                    <img src="event/image/{{ $event->id }}" alt="" id="eventImage">
                                                </div>
                                                <div class="preview-info">
                                                    <h4 id="eventTitle">{{ $event->title }}</h4>
                                                    <h6 id="eventDuration">DURATION: {{ $event->duration }}</h6>
                                                    <?php
                                                        $showtime = date_create_from_format('Y-m-d H:i:s', $show->date_time);
                                                        $showtime = date_format($showtime, 'Y-m-d h:i a');
                                                    ?>
                                                    <h6 id="showtime">SHOWTIME: {{ $showtime }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label label-checkbox">Package</label>
                                        <div class="col-sm-8 checkbox-radios">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="ticket_type" value="B2F1" checked> Bye 2 Free 1 (RM 120 VIP)
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <?php
                                                foreach (config('ticketing.ticket_type') as $key => $value) {
                                            ?>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="ticket_type" value="{{ $value }}"> {{ $key }} 
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label label-checkbox">Seats</label>
                                        <div class="col-sm-8">
                                            <label id="selectedSeats">

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="seatsmap" style="overflow: auto; position: relative; display: inline-block; width: auto; max-width: 100%;">
                                        <img src="hall/map/{{ $venue->id }}" alt="" style="width: auto; height: auto;">
                                        <?php
                                            $index = 1;
                                            foreach ($seats as $seat) {
                                        ?>
                                        <span class="seat" data-id="{{ $seat->id }}" style="left: {{ $seat->left }}px; top: {{ $seat->top }}px; width: {{ $seat->width }}px; height: {{ $seat->height }}px; line-height: {{ $seat->height }}px;">{{ $seat->name }}</span>
                                        <?php
                                                $index++;
                                            }
                                        ?>
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
    var seatW = {{ config('ticketing.seat_size.width') }};
    var seatH = {{ config('ticketing.seat_size.height') }};
    var seatN = {{ count($seats) + 1 }};
    var dragged = false;
    var drag_seat;
    var delete_id = [];
    $(document).ready(function() {
        $('#seatsmap span.seat').on('click', function(){
            $(this).toggleClass('pending');
            if ($(this).hasClass('pending')) {
                var width = $(this).css('width');
                var height = $(this).css('height');
                var seat_id = $(this).attr('data-id');
                var seat_name = $(this).text();
                var seat = $('<span class="selected-seat pending" data-id="' + seat_id + '" style="width: ' + width + '; height: ' + height + '; line-height: ' + height + ';">' + seat_name + '</span>');
                $('#selectedSeats').append(seat);
            } else {
                var seat_id = $(this).attr('data-id');
                $('#selectedSeats .selected-seat[data-id="' + seat_id + '"]').remove();
            }
            /*
            var status = $(this).attr('data-status');

            if (status == '{{ config('ticketing.ticket_status.available') }}') {
                $(this).toggleClass('pending');
            } else if (status == '{{ config('ticketing.ticket_status.pending') }}') {
                $(this).toggleClass('pending');
            } else if (status == '{{ config('ticketing.ticket_status.purchased') }}') {

            } else if (status == '{{ config('ticketing.ticket_status.locked') }}') {

            }
            */
        });
        
        $('.btn-step3').click(function (){
            var seats = [];
            $('#selectedSeats .selected-seat').each(function(){
                seats.push($(this).attr('data-id'));
            });
            if (seats.length == 0) {
                alert('select seats');
                return;
            }
            $('form#mainForm input[name="seats"]').val(seats);
            $('form#mainForm').submit();
        });
    });
</script>
@endpush
