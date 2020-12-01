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
                                    <a class="nav-link active" href="{{ route('admin-promotion-package') }}" id="packageTab">Packages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin-promotion-event') }}" id="eventTab">Promotion Event</a>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="dataTables_wrapper">
                                        <div class="row">
                                            <div class="col-sm-6">
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <div class="toolbar">
                                                    <a href="#" class="btn btn-success btn-sm btn-edit" data-id="0">New Package</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-no-bordered table-hover dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Name</th>
                                                            <th>Ticket Type</th>
                                                            <th>Tickets</th>
                                                            <th>Active</th>
                                                            <th class="text-right">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (count($packages) == 0)
                                                        <tr>
                                                            <td colspan="6">
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <?php
                                                            $index = 1;
                                                            foreach ($packages as $package) {
                                                        ?>
                                                        <tr>
                                                            <td>{{ $index }}</td>
                                                            <td>{{ $package->name }}</td>
                                                            <td>{{ config('ticketing.ticket_type')[$package->ticket_type] }}</td>
                                                            <td>{{ $package->tickets }}</td>
                                                            <td>
                                                                @if ($package->status == config('ticketing.available.yes'))
                                                                <i class="fa fa-check"></i>
                                                                @endif
                                                            </td>
                                                            <td class="td-actions text-right">
                                                                <a href="#" class="btn btn-success btn-edit" data-id="{{ $package->id }}"><i class="fas fa-pencil-alt"></i></a>
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
                    <h5 class="modal-title card-title">Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-save" data-dismiss="modal">Save</button>
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
                url: 'package/edit',
                type: 'POST',
                data: {
                    '_token': $('form#mainForm input[name="_token"]').val(),
                    'id': id
                },
                success: function(result) {
                    $('#editModal .modal-body').html(result);
                    $('#editModal').modal('show');
                }
            });
        });
        $('.btn-save').on('click', function(){
            if ($('form#editForm').valid()) {
                var id = $('form#editForm input[name="id"]').val();
                var name = $('form#editForm input[name="name"]').val();
                var ticket_type = $('form#editForm select[name="ticket_type"]').val();
                var tickets = $('form#editForm input[name="tickets"]').val();
                var status = $('form#editForm input[name="status"]').is(':checked') ? '{{ config('ticketing.available.yes') }}' : '{{ config('ticketing.available.no') }}';
                $.ajax({
                    url: 'package/save',
                    type: 'POST',
                    data: {
                        '_token': $('form#mainForm input[name="_token"]').val(),
                        'id': id,
                        'name': name,
                        'ticket_type': ticket_type,
                        'tickets': tickets,
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
