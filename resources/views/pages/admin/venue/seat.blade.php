@extends('layout.admin', ['activePage' => 'hall', 'titlePage' => __('Halls')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="mainForm" method="post" enctype="multipart/form-data" action="" autocomplete="off" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="venue_id" value="{{ $venue->id }}">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="far fa-life-ring"></i>
                            </div>
                            <h4 class="card-title">{{ $venue->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <span id="pos"></span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="#" class="btn btn-success btn-sm btn-save">Save</a>
                                    <a href="#" class="btn btn-success btn-sm btn-size">Set hotspot size</a>
                                    <a href="{{ route('admin-hall') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-3">
                                    <ul class="nav nav-pills nav-pills-success nav-pills-icons flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#seatsmap-wrapper" role="tablist">
                                                <i class="fas fa-wheelchair"></i> Seats Map
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#sectors" role="tablist">
                                                <i class="fas fa-th-list"></i> Sectors
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="seatsmap-wrapper">
                                            <div id="seatsmap" style="overflow: auto; position: relative; display: inline-block; width: auto; max-width: 100%;">
                                                <img src="map/{{ $venue->id }}" alt="" style="width: auto; height: auto;">
                                                <?php
                                                    $index = 1;
                                                    foreach ($seats as $seat) {
                                                ?>
                                                <span class="seat {{ $seat->status == config('ticketing.available.no') ? 'seat-block' : '' }}" data-id="{{ $seat->id }}" data-floor="{{ $seat->floor }}" style="left: {{ $seat->left }}px; top: {{ $seat->top }}px; width: {{ $seat->width }}px; height: {{ $seat->height }}px; line-height: {{ $seat->height }}px;">{{ $seat->name }}</span>
                                                <?php
                                                        $index++;
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="sectors">
                                            <div class="row">
                                                <div class="col-sm-8 ml-auto mr-auto">
                                                    <table class="table table-striped table-no-bordered table-hover dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Seat Name</th>
                                                                <th>Floor</th>
                                                                <th>Available</th>
                                                                <th class="text-right">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $index = 1;
                                                                foreach ($seats as $seat) {
                                                            ?>
                                                            <tr>
                                                                <td>{{ $index }}</td>
                                                                <td>{{ $seat->name }}</td>
                                                                <td>{{ $seat->floor }}</td>
                                                                <td>
                                                                    @if ($seat->status == config('ticketing.available.yes'))
                                                                        <i class="fa fa-check"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="td-actions text-right">
                                                                    <a href="#" class="btn btn-success btn-seat-edit"><i class="fas fa-pencil-alt"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                    $index++;
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
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
<div class="modal fade" id="seatModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title card-title">Seat Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="seatForm" method="post" autocomplete="off" class="form-horizontal">
                    @csrf

                    <div class="row">
                        <label class="col-sm-5 col-form-label text-right">Name</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="seat_name" type="text" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-5 col-form-label text-right">Floor</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="seat_floor" type="text" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-5 col-form-label text-right">Width</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="seat_width" type="text" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-5 col-form-label text-right">Height</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="seat_height" type="text" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-5 col-form-label text-right">Available</label>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <div class="togglebutton">
                                    <label>
                                        <input type="checkbox" id="seat_status">
                                        <span class="toggle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-seat-delete">Delete</button>
                <button type="button" class="btn btn-success btn-seat-save">Set</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sizeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title card-title">Seat Size</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sizeForm" method="post" autocomplete="off" class="form-horizontal">
                    @csrf

                    <div class="row">
                        <label class="col-sm-5 col-form-label text-right">Width</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="default_width" type="text" value="{{ config('ticketing.seat_size.width') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-5 col-form-label text-right">Height</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="default_height" type="text" value="{{ config('ticketing.seat_size.height') }}" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-size-save">Set</button>
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
    var dragging = false;
    var startingPos = [];
    var drag_seat;
    var delete_id = [];
    function bindSeatEvents(seat) {
        $(seat).on('mousedown', function(e) {
            dragging = false;
            drag_seat = this;
            startingPos = [e.pageX, e.pageY];
            $('#seatsmap').on('mousemove', function(e){
                if (!dragging) {
                    if (!(e.pageX === startingPos[0] && e.pageY === startingPos[1])) {
                        dragging = true;
                    }
                } else {
                    var pos = $(this).offset();
                    var left = parseInt(e.pageX - pos.left + $(this).scrollLeft() - seatW / 2);
                    if (left < 0) left = 0;
                    var top = parseInt(e.pageY - pos.top + $(this).scrollTop() - seatH / 2);
                    if (top < 0) top = 0;

                    $(drag_seat).css('left', left + 'px');
                    $(drag_seat).css('top', top + 'px');
                }
            });
        })
        .on('click', function(e){
            e.stopPropagation();
            if (!dragging) {
                $('.seat.selected').removeClass('selected');
                $(this).addClass('selected');

                var seat_name = $(this).text();
                var seat_width = parseInt($(this).css('width'));
                var seat_height = parseInt($(this).css('height'));
                var seat_floor = parseInt($(this).attr('data-floor'));
                var seat_status = $(this).hasClass('seat-block') ? 0 : 1;

                $('form#seatForm input#seat_name').val(seat_name);
                $('form#seatForm input#seat_width').val(seat_width);
                $('form#seatForm input#seat_height').val(seat_height);
                $('form#seatForm input#seat_floor').val(seat_floor);
                if (seat_status == 1) {
                    $('form#seatForm input#seat_status').prop('checked', true);
                } else {
                    $('form#seatForm input#seat_status').prop('checked', false);
                }
                $('#seatModal').modal('show');
            }
            dragging = false;
        });
    }
    $(document).ready(function() {
        $('#seatsmap span.seat').each(function(){
            bindSeatEvents(this);
        });
        $('#seatsmap').click(function (e) {
            var pos = $(this).offset();
            var left = parseInt(e.pageX - pos.left + $(this).scrollLeft() - seatW / 2);
            var top = parseInt(e.pageY - pos.top + $(this).scrollTop() - seatH / 2);
            var new_seat = $('<span class="seat" data-id="0" data-floor="0" style="left: ' + left + 'px; top: ' + top + 'px; width: ' + seatW + 'px; height: ' + seatH + 'px; line-height: ' + seatH + 'px;">' + seatN + '</span>');
            seatN++;
            $('#seatsmap').append(new_seat);
            bindSeatEvents(new_seat);
        })
        .on('mouseup', function(){
            $(this).off('mousemove');
        })
        $('.btn-size').click(function (){
            $('form#sizeForm input#default_width').val(seatW);
            $('form#sizeForm input#default_height').val(seatH);
            $('#sizeModal').modal('show');
        });
        $('.btn-size-save').click(function (){
            if ($('form#sizeForm').valid()) {
                seatW = parseInt($('form#sizeForm input#default_width').val());
                seatH = parseInt($('form#sizeForm input#default_height').val());
                $('#sizeModal').modal('hide');
            }
        });
        $('.btn-seat-save').click(function (){
            if ($('form#seatForm').valid()) {
                $('.seat.selected').text($('form#seatForm input#seat_name').val());
                $('.seat.selected').css('width', parseInt($('form#seatForm input#seat_width').val()) + 'px');
                $('.seat.selected').css('height', parseInt($('form#seatForm input#seat_height').val()) + 'px');
                $('.seat.selected').css('line-height', parseInt($('form#seatForm input#seat_height').val()) + 'px');
                $('.seat.selected').attr('data-floor', parseInt($('form#seatForm input#seat_floor').val()));
                if (!$('form#seatForm input#seat_status').is(':checked')) {
                    $('.seat.selected').addClass('seat-block');
                }
                $('#seatModal').modal('hide');
            }
        });
        $('.btn-seat-delete').click(function (){
            var id = $('.seat.selected').attr('data-id');
            $('.seat.selected').remove();
            if (id > 0) {
                delete_id.push(id);
            }
            $('#seatModal').modal('hide');
        });
        $('.btn-save').click(function (){
            var venue_id = $('form#mainForm input[name="venue_id"]').val();
            var seat_id = [];
            var seat_name = [];
            var seat_floor = [];
            var seat_top = [];
            var seat_left = [];
            var seat_width = [];
            var seat_height = [];
            var seat_status = [];
            $('#seatsmap span.seat').each(function(){
                seat_id.push($(this).attr('data-id'));
                seat_name.push($(this).text());
                seat_floor.push($(this).attr('data-floor'));
                seat_top.push(parseInt($(this).css('top')));
                seat_left.push(parseInt($(this).css('left')));
                seat_width.push(parseInt($(this).css('width')));
                seat_height.push(parseInt($(this).css('height')));
                if ($(this).hasClass('seat-block')) {
                    seat_status.push(0);
                } else {
                    seat_status.push(1);
                }
            });
            $.ajax({
                url: 'seat/save',
                type: 'POST',
                data: {
                    '_token': $('form#mainForm input[name="_token"]').val(),
                    'venue_id': venue_id,
                    'seat_id': seat_id,
                    'seat_name': seat_name,
                    'seat_floor': seat_floor,
                    'seat_top': seat_top,
                    'seat_left': seat_left,
                    'seat_width': seat_width,
                    'seat_height': seat_height,
                    'seat_status': seat_status,
                    'delete_id' : delete_id
                },
                dataType : 'json',
                success: function(data) {
                    if(data.result == 'success') {
                        $('form#mainForm').submit();
                    }
                }
            });
        });
    });
</script>
@endpush
