@extends('layout.admin', ['activePage' => 'promotion', 'titlePage' => __('Promotion')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <form id="mainForm" method="post" action="" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h4 class="card-title">Promotion</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills nav-pills-success">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin-promotion-package') }}" id="packageTab">Packages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('admin-promotion-event') }}" id="eventTab">Promotion Event</a>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="dataTables_wrapper">
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <div class="toolbar">
                                                    <a href="#" class="btn btn-success btn-sm btn-edit" data-id="0">Add</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-no-bordered table-hover dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Event Image</th>
                                                            <th>Event Name</th>
                                                            <th>Ticket Type</th>
                                                            <th>Quota</th>
                                                            <th>Date Range</th>
                                                            <th>Weekday/Weekend</th>
                                                            <th>Price</th>
                                                            <th>Limit</th>
                                                            <th>Limit Date</th>
                                                            <th>Available</th>
                                                            <th class="text-right">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($events) == 0)
                                                            <tr>
                                                                <td colspan="9">
                                                                    &nbsp;
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <?php
                                                                $index = 1;
                                                                foreach ($events as $event) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="rounded-circle img-circle">
                                                                        <img src="event/image/{{ $event->event_id }}" alt="" class="event-image">
                                                                    </div>
                                                                </td>
                                                                <td>{{ $event->name }}</td>
                                                                <td>
                                                                    @if (!empty($event->ticket_type))
                                                                        {{ config('ticketing.ticket_type')[$event->ticket_type] }}
                                                                    @elseif (!empty($event->package_id))
                                                                        {{ $event->package_name . '(' . config('ticketing.ticket_type')[$event->package_ticket_type] . ')' }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $event->quota }}</td>
                                                                <td>{{ date_format(date_create($event->from_date), 'Y-m-d') }} ~ {{ date_format(date_create($event->to_date), 'Y-m-d') }}</td>
                                                                <td>{{ config('ticketing.week')[$event->week] }}</td>
                                                                <td>{{ $event->price }}</td>
                                                                <td>
                                                                    @if ($event->limit_status == config('ticketing.available.yes'))
                                                                    <i class="fa fa-check"></i>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($event->limit_status == config('ticketing.available.yes'))
                                                                        {{ date_format(date_create($event->limit_start), 'Y-m-d') }} ~ {{ date_format(date_create($event->limit_end), 'Y-m-d') }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($event->status == config('ticketing.available.yes'))
                                                                    <i class="fa fa-check"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="td-actions text-right">
                                                                    <a href="#" class="btn btn-success btn-edit" data-id="{{ $event->id }}"><i class="fas fa-pencil-alt"></i></a>
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title">Promotion Event</h5>
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
    $(document).ready(function() {
        $('.btn-edit').on('click', function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url: 'event/edit',
                type: 'POST',
                data: {
                    '_token': $('form#mainForm input[name="_token"]').val(),
                    'id': id
                },
                success: function(result) {
                    $('#editModal .modal-body').html(result);
                    $('form#editForm input[name="limit_status"]').on('change', function(){
                        if ($(this).is(':checked')) {
                            $('form#editForm input[name="limit_start"]').removeAttr('disabled').attr('required', 'required');
                            $('form#editForm input[name="limit_end"]').removeAttr('disabled').attr('required', 'required');
                        } else {
                            $('form#editForm input[name="limit_start"]').val('').attr('disabled', 'disabled').removeAttr('required');
                            $('form#editForm input[name="limit_end"]').val('').attr('disabled', 'disabled').removeAttr('required');
                        }
                    });
                    $('#editModal').modal('show');
                }
            });
        });
        $('.btn-save').on('click', function(){
            if ($('form#editForm').valid()) {
                var id = $('form#editForm input[name="id"]').val();
                var name = $('form#editForm input[name="name"]').val();
                var event_id = $('form#editForm select[name="event_id"]').val();
                var ticket_type = '';
                var package_id = '';
                if ($('form#editForm select[name="ticket_type"] option:selected').closest('optgroup').attr('label') == 'Normal') {
                    ticket_type = $('form#editForm select[name="ticket_type"]').val();
                } else {
                    package_id = $('form#editForm select[name="ticket_type"]').val();
                }
                var from_date = $('form#editForm input[name="from_date"]').val();
                var to_date = $('form#editForm input[name="to_date"]').val();
                var quota = $('form#editForm input[name="quota"]').val();
                var week = $('form#editForm select[name="week"]').val();
                var price = $('form#editForm input[name="price"]').val();
                var status = $('form#editForm input[name="status"]').is(':checked') ? '{{ config('ticketing.available.yes') }}' : '{{ config('ticketing.available.no') }}';
                var limit_status = $('form#editForm input[name="limit_status"]').is(':checked') ? '{{ config('ticketing.available.yes') }}' : '{{ config('ticketing.available.no') }}';
                var limit_start = $('form#editForm input[name="limit_start"]').val();
                var limit_end = $('form#editForm input[name="limit_end"]').val();
                $.ajax({
                    url: 'event/save',
                    type: 'POST',
                    data: {
                        '_token': $('form#mainForm input[name="_token"]').val(),
                        'id': id,
                        'name': name,
                        'event_id': event_id,
                        'ticket_type': ticket_type,
                        'package_id': package_id,
                        'from_date': from_date,
                        'to_date': to_date,
                        'quota': quota,
                        'week': week,
                        'price': price,
                        'status': status,
                        'limit_status': limit_status,
                        'limit_start': limit_start,
                        'limit_end': limit_end
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
