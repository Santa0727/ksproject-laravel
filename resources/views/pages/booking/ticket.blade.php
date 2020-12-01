@extends('layout.booking')

@section('content')
<div class="container-fluid">
    <header class="header-page" id="header-section"></header>
    <!-- PROMOTION SECTION -->
    <div class="row">
        <div class="col-12">
            <h2 class="title title--h4 js-lines" id="h1-title">
                Select Ticket
            </h2>
        </div>
    </div>
    <!-- END OF PROMOTION SECTION -->

    <!-- TICKET INFO SECTION -->
    <div class="row">
        <div class="col-12">
            <div class="description js-scroll-show">
                <div class="row">
                    <div class="col-12 col-lg-3 col-xl-4">
                        <table class="table-dark" id="ticket-table">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">Rasa Melaka</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="col1">Show’s Language</td>
                                    <td id="col2">:</td>
                                    <td id="col3">
                                        <span id="detail-txt">Mix of English, Mandarin &amp; Bahasa Malaysia (with subtitle)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Running Time</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">60 minutes</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Show Time</td>
                                    <td>:</td>
                                    <td>
                                        <p id="table-p">
                                            <span id="detail-txt">2019-08-26</span>
                                        </p>
                                        <p>
                                            <span id="detail-txt">3pm</span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table-dark" id="ticket-table" style="margin-top: 1rem;">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">Tickets</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bye 2 Free 1 (RM 100 VIP)</td>
                                    <td>
                                        <select style="padding: 2px 10px;">
                                            <option value="">
                                            <?php for ($i = 1; $i < 13; $i++) { ?>
                                            </option><option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Malaysian</td>
                                    <td>
                                        <select style="padding: 2px 10px;">
                                            <option value="">
                                            <?php for ($i = 1; $i < 13; $i++) { ?>
                                            </option><option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Non-Malaysian</td>
                                    <td>
                                        <select style="padding: 2px 10px;">
                                            <option value="">
                                            <?php for ($i = 1; $i < 13; $i++) { ?>
                                            </option><option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Concession</td>
                                    <td>
                                        <select style="padding: 2px 10px;">
                                            <option value="">
                                            <?php for ($i = 1; $i < 13; $i++) { ?>
                                            </option><option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>VIP</td>
                                    <td>
                                        <select style="padding: 2px 10px;">
                                            <option value="">
                                            <?php for ($i = 1; $i < 13; $i++) { ?>
                                            </option><option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Melaka Citizens</td>
                                    <td>
                                        <select style="padding: 2px 10px;">
                                            <option value="">
                                            <?php for ($i = 1; $i < 13; $i++) { ?>
                                            </option><option value="{{ $i }}">{{ $i }}</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" id="selectedSeats">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="">
                            <p class="">
                                *Concession (Malaccans, Malaysian: Students, Senior 60yrs old and above, OKU)<br>
                                *Children below 100cm will be admitted free (FOC) (by not occupying any seats) under parental or guardian supervision.<br>
                                *Online ticket purchaser must present your CONTACT NUMBER or CONFIRMATION ID and MYKAD(Malaysian only for verification purpose)upon show ticket redemption at the RASAMELAKA Box Office<br>
                                *If you are purchasing STUDENT Ticket, please show us your student card in order to prove you are entitled to this type of ticket.
                            </p>
                        </div>
                        <div id="cta-div" class="text-center">
                            <a href="{{ route('booking-show') }}" class="btn"><i class="fa fa-angle-left"></i> Previous</a>
                            <a href="{{ route('booking-client') }}" class="btn">Next <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9 col-xl-8">
                        <div class="text-center">
                            <div id="seatsmap" style="overflow: auto; position: relative; display: inline-block; width: auto; max-width: 100%;">
                                <img src="{{ asset('img/hall1.jpg') }}" alt="" style="width: auto; max-width: unset;">
                                <?php
                                    $index = 1;
                                    foreach ($seats as $seat) {
                                ?>
                                <span class="seat {{ $seat->status == config('ticketing.available.no') ? 'seat-block' : '' }}" data-id="{{ $seat->id }}" style="left: {{ $seat->left }}px; top: {{ $seat->top }}px; width: {{ $seat->width }}px; height: {{ $seat->height }}px; line-height: {{ $seat->height }}px;">{{ $seat->name }}</span>
                                <?php
                                        $index++;
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="">
                            <p class="text-center">*要取消选择 / 更换座位，请回到步骤2框中点击所选座位类型和编号</br>
                            *To unselect /change seat(s), please click the selected seat(s) type & number at step 2 box.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF TICKET INFO SECTION -->
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
        $('#seatsmap span.seat').on('click', function(){
            if ($(this).hasClass('seat-block')) {
                return;
            }
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
