@extends('layout.admin', ['activePage' => 'booking', 'titlePage' => __('Booking')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="mainForm" method="post" action="save" autocomplete="off" class="form-horizontal">
                    <input type="hidden" name="event_id" value="{{ $event_id }}">
                    <input type="hidden" name="show_id" value="{{ $show_id }}">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="far fa-clipboard"></i>
                            </div>
                            <h4 class="card-title">Booking(Client Details)</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="#" class="btn btn-success btn-sm btn-save">Save</a>
                                    <a href="{{ route('admin-booking') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="client_name" type="text" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="client_email" type="email" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="client_phone" type="text" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Payment Type</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="custom-select" id="selectPaymentType" style="width: auto;">
                                        <?php
                                            foreach (config('ticketing.payment_type') as $key => $value) {
                                        ?>
                                        <option value="{{ $value }}">{{ $key }}</option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row payment-card">
                                <label class="col-sm-2 col-form-label">Card Type</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="custom-select" style="width: auto;">
                                            <option value="">MasterCard</option>
                                            <option value="">Visa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row payment-card">
                                <label class="col-sm-2 col-form-label">Card Number</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row payment-card">
                                <label class="col-sm-2 col-form-label">Card Expiration</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                    </div>
                                </div>
                            </div>
                            <div class="row payment-card">
                                <label class="col-sm-2 col-form-label">Card Code</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="" value="">
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
    $(document).ready(function() {
        $('.payment-card').hide();
        $('.btn-save').click(function (){
            if ($('form#mainForm').valid()) {
                $('form#mainForm').submit();
                // document.location.href="{{ route('admin-booking') }}";
            }
        });
        $('#selectPaymentType').on('change', function (){
            if ($(this).val() == 'CARD') {
                $('.payment-card').show();
            } else {
                $('.payment-card').hide();
            }
        });
    });
</script>
@endpush
