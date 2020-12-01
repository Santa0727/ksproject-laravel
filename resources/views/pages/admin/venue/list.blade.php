@extends('layout.admin', ['activePage' => 'hall', 'titlePage' => __('Halls')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form id="mainForm" method="post" action="" autocomplete="off">
                @csrf
                <input type="hidden" name="id">
                <input type="hidden" name="venue_id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="far fa-life-ring"></i>
                                </div>
                                <h4 class="card-title">Halls</h4>
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
                                                <a href="#" class="btn btn-success btn-sm btn-edit" data-id="0">Add hall</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Seats</th>
                                                        <th>Active</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($venues) == 0)
                                                        <tr>
                                                            <td colspan="6">
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <?php
                                                            $index = 1;
                                                            foreach ($venues as $venue) {
                                                        ?>
                                                        <tr>
                                                            <td>{{ $index }}</td>
                                                            <td>{{ $venue->name }}</td>
                                                            <td>{{ $venue->description }}</td>
                                                            <td>{{ $venue->seats_count }}</td>
                                                            <td>
                                                                @if ($venue->status == config('ticketing.available.yes'))
                                                                    <i class="fa fa-check"></i>
                                                                @endif
                                                            </td>
                                                            <td class="td-actions text-right">
                                                                <a href="#" class="btn btn-info btn-seat" data-id="{{ $venue->id }}"><i class="fas fa-wheelchair"></i></a>
                                                                <a href="#" class="btn btn-success btn-edit" data-id="{{ $venue->id }}"><i class="fas fa-pencil-alt"></i></a>
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
            </form>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.btn-edit').on('click', function(){
            var id = $(this).attr('data-id');
            $('form#mainForm input[name="id"]').val(id);
            $('form#mainForm').attr('action', 'hall/edit');
            $('form#mainForm').submit();
        });
        $('form#mainForm input[name="keyword"]').on('change', function() {
            $('form#mainForm').submit();
        });
        $('.btn-seat').on('click', function(){
            var id = $(this).attr('data-id');
            $('form#mainForm input[name="venue_id"]').val(id);
            $('form#mainForm').attr('action', 'hall/seat');
            $('form#mainForm').submit();
        });
    });
</script>
@endpush
