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
                                    <a href="#" class="btn btn-success btn-sm btn-save">Save</a>
                                    <a href="{{ route('admin-event-list') }}" class="btn btn-sm">Back</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                        $arr_price = [];
                                        foreach ($price_list as $price_ticket) {
                                            $arr_price[$price_ticket->ticket_type] = $price_ticket;
                                        }
                                        $index = 1;
                                        foreach (config('ticketing.ticket_type') as $key => $value) {
                                    ?>
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label">{{ $key }}</label>
                                        @if (array_key_exists($value, $arr_price))
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="hidden" name="ticket_type[]" value="{{ $value }}">
                                                <input class="form-control" name="price[]" type="text" placeholder="" value="{{ $arr_price[$value]->price }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="hidden" name="status[]" value="">
                                                    <input class="form-check-input ticket-type-status" type="checkbox" {{ ($arr_price[$value]->status == config('ticketing.available.yes')) ? 'checked' : '' }}>
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="hidden" name="ticket_type[]" value="{{ $value }}">
                                                <input class="form-control" name="price[]" type="text" placeholder="" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="hidden" name="status[]" value="">
                                                    <input class="form-check-input ticket-type-status" type="checkbox">
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <?php
                                            $index++;
                                        }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- 
                <div class="card">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h4 class="card-title">Promotion Price</h4>
                    </div>
                    <div class="card-body">
                        <form id="promotionForm" method="post" action="" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <div class="dataTables_wrapper">
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <div class="toolbar">
                                            <a href="#" class="btn btn-success btn-sm btn-new-promotion" data-id="0">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-no-bordered table-hover dataTable">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Package Name</th>
                                                    <th>Ticket Type</th>
                                                    <th>Date Range</th>
                                                    <th>Quota</th>
                                                    <th>Price</th>
                                                    <th>Active</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>BUY 2 FREE 1</td>
                                                    <td>VIP</td>
                                                    <td>2019-08-01 ~ 2019-08-10</td>
                                                    <td>100</td>
                                                    <td>80</td>
                                                    <td>
                                                        <i class="fas fa-check"></i>
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <a href="#" class="btn btn-success btn-promotion-edit" data-id=""><i class="fas fa-pencil-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>BUY 2 FREE 1</td>
                                                    <td>Concession</td>
                                                    <td>2019-08-01 ~ 2019-08-10</td>
                                                    <td>10</td>
                                                    <td>90</td>
                                                    <td>
                                                        <i class="fas fa-check"></i>
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <a href="#" class="btn btn-success btn-promotion-edit" data-id=""><i class="fas fa-pencil-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>BUY 3 FREE 1</td>
                                                    <td>VIP</td>
                                                    <td>2019-08-01 ~ 2019-08-10</td>
                                                    <td>100</td>
                                                    <td>70</td>
                                                    <td>
                                                        <i class="fas fa-check"></i>
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <a href="#" class="btn btn-success btn-promotion-edit" data-id=""><i class="fas fa-pencil-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>BUY 3 FREE 1</td>
                                                    <td>Concession</td>
                                                    <td>2019-08-01 ~ 2019-08-10</td>
                                                    <td>100</td>
                                                    <td>70</td>
                                                    <td>
                                                        <i class="fas fa-check"></i>
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <a href="#" class="btn btn-success btn-promotion-edit" data-id=""><i class="fas fa-pencil-alt"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                 -->
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-header">
                        <img class="img" src="image/{{ $event->id }}" alt="" style="max-width: 250px;">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $event->title }}</h4>
                        <h6 class="card-category text-gray">Duration: {{ $event->duration }}</h6>
                        <h6 class="card-category text-gray">Period: {{ $event->from_date . ' ~ ' . $event->to_date }}</h6>
                        <h6 class="card-category text-gray">Show Time: {{ $event->time }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="promotionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title card-title">Promotion Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" autocomplete="off" class="form-horizontal">
                    @csrf
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Package Name</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <p class="form-control-static">BUY 2 FREE 1</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Ticket Type</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <p class="form-control-static">VIP</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Date Range</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control datepicker" type="text" value="2019-08-01" required style="display: inline-block; width: 100px;">
                                <label> ~ </label>
                                <input class="form-control datepicker" type="text" value="2019-08-10" required style="display: inline-block; width: 100px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Quota</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" value="100" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Price</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" value="80" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Active</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <div class="togglebutton">
                                    <label>
                                        <input type="checkbox" name="status" value="{{ config('ticketing.available.yes') }}" checked>
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
                <button type="button" class="btn btn-success btn-promotion-save" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newPromotionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title card-title">New Promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" autocomplete="off" class="form-horizontal">
                    @csrf
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Package Name</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Ticket Type</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <select name="ticket_type" class="custom-select" style="width: auto;" required>
                                <?php
                                    foreach (config('ticketing.ticket_type') as $key => $value) {
                                ?>
                                    <option value="{{ $value }}">{{ $key }}</option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Tickets</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Date Range</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control datepicker" type="text" value="" required style="display: inline-block; width: 100px;">
                                <label> ~ </label>
                                <input class="form-control datepicker" type="text" value="" required style="display: inline-block; width: 100px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Quota</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Price</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Active</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <div class="togglebutton">
                                    <label>
                                        <input type="checkbox" name="status" value="{{ config('ticketing.available.yes') }}" checked>
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
                <button type="button" class="btn btn-success btn-promotion-save" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.btn-save').on('click', function(){
            $('input.ticket-type-status').each(function(){
                var input_status = $(this).parent().find('input[name="status[]"]')
                if ($(this).is(':checked')) {
                    $(input_status).val(1);
                } else {
                    $(input_status).val(0);
                }
            });
            $('form#mainForm').submit();
        });
        $('.btn-promotion-edit').on('click', function(){
            $('#promotionModal').modal('show');
        });
        $('.btn-new-promotion').on('click', function(){
            $('#newPromotionModal').modal('show');
        });
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
    });
</script>
@endpush
