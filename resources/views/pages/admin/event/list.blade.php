@extends('layout.admin', ['activePage' => 'event', 'titlePage' => __('Shows')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form id="mainForm" method="post" action="" autocomplete="off">
                @csrf
                <input type="hidden" name="id">
                <input type="hidden" name="event_id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="fas fa-film"></i>
                                </div>
                                <h4 class="card-title">Events</h4>
                            </div>
                            <div class="card-body">
                                <div class="dataTables_wrapper">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_filter">
                                                <label>
                                                    <input type="text" name="keyword" class="form-control form-control-sm" value="{{ empty($params['keyword'])?'':$params['keyword'] }}" placeholder="Search">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <div class="toolbar">
                                                <a href="#" class="btn btn-success btn-sm btn-edit" data-id="0">Add event</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Title</th>
                                                        <th>Duration</th>
                                                        <th>Hall</th>
                                                        <th>Period</th>
                                                        <th>Active</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if (count($events) == 0)
                                                    <tr>
                                                        <td colspan="7">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                @else
                                                    <?php
                                                        $index = ($params['page'] - 1) * $params['rows'] + 1;
                                                        foreach ($events as $event) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="rounded-circle img-circle">
                                                                <img src="event/image/{{ $event->id }}" alt="" class="event-image">
                                                            </div>
                                                        </td>
                                                        <td>{{ $event->title }}</td>
                                                        <td>{{ $event->duration }}</td>
                                                        <td>{{ $event->venue_name }}</td>
                                                        <td>{{ $event->from_date . ' ~ ' . $event->to_date }}</td>
                                                        <td>
                                                            @if ($event->status == config('ticketing.available.yes'))
                                                            <i class="fa fa-check"></i>
                                                            @endif
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <a href="#" class="btn btn-info btn-schedule" data-event-id="{{ $event->id }}"><i class="far fa-clock"></i></a>
                                                            <a href="#" class="btn btn-warning btn-price" data-event-id="{{ $event->id }}"><i class="fas fa-dollar-sign"></i></a>
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
                                    @include('layout.admin_pagination', ['params' => $params, 'records' => $events])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script src="{{ asset('js/pages/pagination.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.btn-edit').on('click', function(){
            var id = $(this).attr('data-id');
            $('form#mainForm input[name="id"]').val(id);
            $('form#mainForm').attr('action', 'event/edit');
            $('form#mainForm').submit();
        });
        $('form#mainForm input[name="keyword"]').on('change', function() {
            goPage(1);
        });
        $('.btn-price').on('click', function(){
            var event_id = $(this).attr('data-event-id');
            $('form#mainForm input[name="event_id"]').val(event_id);
            $('form#mainForm').attr('action', 'event/price');
            $('form#mainForm').submit();
        });
        $('.btn-schedule').on('click', function(){
            var event_id = $(this).attr('data-event-id');
            $('form#mainForm input[name="event_id"]').val(event_id);
            $('form#mainForm').attr('action', 'show/schedule');
            $('form#mainForm').submit();
        });
    });
</script>
@endpush
