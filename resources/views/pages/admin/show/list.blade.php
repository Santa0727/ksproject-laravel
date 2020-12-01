@extends('layout.admin', ['activePage' => 'show', 'titlePage' => __('Shows')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <form id="mainForm" method="post" action="" class="form-horizontal">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
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
                                <div class="col-sm-6 text-right">
                                    AAAAAAAA
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="#" class="btn btn-sm btn-success"><i class="fas fa-angle-left"></i></a>
                                    <a href="#" class="btn btn-sm btn-success"><i class="fas fa-angle-right"></i></a>
                                    <a href="{{ route('admin-event-list') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
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
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="calender">
                                            
                                        </div>
                                        <div class="tab-pane" id="list">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Day</th>
                                                        <th>Showtimes</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $index = 1;
                                                        foreach ($shows as $show) {
                                                            $showtime = date_create_from_format('Y-m-d H:i:s', $show->date_time);
                                                            $showtime = date_format($showtime, 'Y-m-d h:i a');
                                                    ?>
                                                    <tr>
                                                        <td>{{ $index }}</td>
                                                        <td>{{ $showtime }}</td>
                                                        <td></td>
                                                        <td>
                                                            @if ($show->status == config('ticketing.available.yes'))
                                                            <i class="fa fa-check"></i>
                                                            @endif
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <a href="#" class="btn btn-success btn-edit" data-id="{{ $show->id }}"><i class="fas fa-pencil-alt"></i></a>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title card-title">Show</h5>
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
@endsection

@push('js')
<script>
    $(document).ready(function() {
        
        $('.btn-edit').on('click', function(){
            var event_id = $('form#mainForm input[name="event_id"]').val();
            var id = $(this).attr('data-id');
            $.ajax({
                url: 'edit',
                type: 'POST',
                data: {
                    '_token': $('form#mainForm input[name="_token"]').val(),
                    'event_id': event_id,
                    'id': id
                },
                success: function(result) {
                    $('#editModal .modal-body').html(result);
                    $('#editModal').modal('show');
                }
            });
        });
        
        $('.btn-save').on('click', function(){
            if ($('form#editForm input[name="date_time"]').val().trim().length == 0) {
                return;
            }
            var status = 0;
            if ($('form#editForm input[name="status"]').is(':checked')) {
                status = 1;
            }
            $.ajax({
                url: 'save',
                type: 'POST',
                data: {
                    '_token': $('form#editForm input[name="_token"]').val(),
                    'id': $('form#editForm input[name="id"]').val(),
                    'event_id': $('form#editForm input[name="event_id"]').val(),
                    'venue_id': $('form#editForm select[name="venue_id"]').val(),
                    'date_time': $('form#editForm input[name="date_time"]').val(),
                    'status': status
                },
                dataType : 'json',
                success: function(result) {
                    $('#mainForm').submit();
                }
            });
        });
    });
</script>
@endpush
