@extends('layout.admin', ['activePage' => 'event', 'titlePage' => __('Shows')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-film"></i>
                        </div>
                        <h4 class="card-title">Show Price</h4>
                    </div>
                    <div class="card-body">
                        <form id="mainForm" method="post" action="" class="form-horizontal">
                            @csrf

                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="#" class="btn btn-success btn-sm btn-edit" data-id="0">Add</a>
                                    <a href="{{ route('admin-event-list') }}" class="btn btn-sm">Back</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-no-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Ticket Type</th>
                                                <th>Seats</th>
                                                <th>Weekday Price</th>
                                                <th>Weekend Price</th>
                                                <th>Active</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($price_list) == 0)
                                            <tr>
                                                <td colspan="7">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        @else
                                            <?php
                                                $index = 1;
                                                foreach ($price_list as $price) {
                                                    $seats = json_decode($price->seats, true);
                                            ?>
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ config('ticketing.ticket_type')[$price->ticket_type] }}</td>
                                                <td>{{ empty($seats) ? 0 : count($seats) }}</td>
                                                <td>{{ $price->weekday_price }}</td>
                                                <td>{{ $price->weekend_price }}</td>
                                                <td>
                                                    @if ($price->status == config('ticketing.available.yes'))
                                                    <i class="fa fa-check"></i>
                                                    @endif
                                                </td>
                                                <td class="td-actions text-right">
                                                    <a href="#" class="btn btn-success btn-edit" data-id="{{ $price->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                                    $index++;
                                                }
                                            ?>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="card card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title">Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-check-all"><i class="far fa-check-square"></i> Check All</button>
                    <button type="button" class="btn btn-secondary btn-uncheck-all"><i class="far fa-square"></i> Uncheck All</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-price-save">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.btn-edit').on('click', function(){
            var event_id = $('form#mainForm input[name="event_id"]').val();
            var id = $(this).attr('data-id');
            $.ajax({
                url: 'price/edit',
                type: 'POST',
                data: {
                    '_token': $('form#mainForm input[name="_token"]').val(),
                    'event_id' : event_id,
                    'id': id
                },
                success: function(result) {
                    $('#editModal .modal-body').html(result);
                    $('#editModal').modal('show');
                }
            });
        });
        $('.btn-check-all').on('click', function(){
            $('#editModal .table-seats input.seat-check').prop('checked', true);
        });
        $('.btn-uncheck-all').on('click', function(){
            $('#editModal .table-seats input.seat-check').prop('checked', false);
        });
        $('.btn-price-save').on('click', function(){
            if ($('form#editForm').valid()) {
                var event_id = $('form#mainForm input[name="event_id"]').val();
                var id = $('form#editForm input[name="id"]').val();
                var ticket_type = $('form#editForm select[name="ticket_type"]').val();
                var weekday_price = $('form#editForm input[name="weekday_price"]').val();
                var weekend_price = $('form#editForm input[name="weekend_price"]').val();
                var status = $('form#editForm input[name="status"]').is(':checked') ? '{{ config('ticketing.available.yes') }}' : '{{ config('ticketing.available.no') }}';
                var seats = [];
                $('form#editForm input.seat-check:checked').each(function(){
                    seats.push($(this).val());
                });
                $.ajax({
                    url: 'price/save',
                    type: 'POST',
                    data: {
                        '_token': $('form#mainForm input[name="_token"]').val(),
                        'id': id,
                        'event_id': event_id,
                        'ticket_type': ticket_type,
                        'weekday_price': weekday_price,
                        'weekend_price': weekend_price,
                        'seats': seats,
                        'status': status
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('form#mainForm').submit();
                        $('#editModal').modal('hide');
                    }
                });
            }
        });
    });
</script>
@endpush
