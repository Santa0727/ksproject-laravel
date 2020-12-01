@extends('layout.admin', ['activePage' => 'agent', 'titlePage' => __('Agent')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4 class="card-title">Setting Available Payment Type</h4>
                    </div>
                    <div class="card-body">
                        <form id="mainForm" method="post" action="" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('admin-agent') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-no-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Payment Type</th>
                                                <th>Available</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $available = [];
                                                foreach ($user_payment_types as $user_payment_type) {
                                                    $available[] = $user_payment_type->payment_type;
                                                }
                                            ?>
                                            <tr>
                                                <td>1</td>
                                                <td>Cash</td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input payment-type" type="checkbox" value="{{ config('ticketing.payment_type.Cash') }}" {{ in_array(config('ticketing.payment_type.Cash'), $available) ? 'checked' : '' }}>
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>PayPal</td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input payment-type" type="checkbox" value="{{ config('ticketing.payment_type.PayPal') }}" {{ in_array(config('ticketing.payment_type.PayPal'), $available) ? 'checked' : '' }}>
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>iPay88</td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input payment-type" type="checkbox" value="{{ config('ticketing.payment_type.iPay88') }}" {{ in_array(config('ticketing.payment_type.iPay88'), $available) ? 'checked' : '' }}>
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
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
                    <div class="card-avatar">
                        <a href="#">
                            <img class="img" src="photo/{{ $user->id }}" alt="">
                        </a>
                    </div>
                    <div class="card-body">
                        <h6 class="card-category text-gray">{{ $user->email }}</h6>
                        <h4 class="card-title">{{ $user->uid }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('form#mainForm input.payment-type').on('click', function(){
            var payment_type = $(this).val();
            var available = 0;
            if ($(this).is(':checked')) {
                available = 1;
            }
            $.ajax({
                url: 'payment_type/save',
                type: 'POST',
                data: {
                    '_token': $('form#mainForm input[name="_token"]').val(),
                    'user_id': $('form#mainForm input[name="user_id"]').val(),
                    'payment_type': payment_type,
                    'available': available
                },
                dataType: 'json',
                success: function(result) {
                    
                }
            });
        });
    });
</script>
@endpush
