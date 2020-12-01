@extends('layout.booking')

@section('content')
<div class="container">
    <header class="header-page" id="header-section"></header>
    <!-- PROMOTION SECTION -->
    <div class="row">
        <div class="col-12">
            <h2 class="title title--h4 js-lines" id="h1-title">
                Your detail
            </h2>
        </div>
    </div>
    <!-- END OF PROMOTION SECTION -->

    <!-- TICKET INFO SECTION -->
    <div class="row">
        <div class="col-12">
            <div class="description js-scroll-show">
                <div class="row">
                    <div class="col-7">
                        <div class="form-group ">
                            <input type="text" class="input form-control" required="required" placeholder="Name" value="">
                        </div>
                        <div class="form-group ">
                            <input type="text" class="input form-control" required="required" placeholder="Email" value="">
                        </div>
                        <div class="form-group ">
                            <input type="text" class="input form-control" required="required" placeholder="Phone" value="">
                        </div>
                        <div class="form-group ">
                            <input type="text" class="input form-control" required="required" placeholder="Country" value="">
                        </div>
                        <div class="form-group ">
                            <select placeholder="Payment Method">
                                <option disable></option>
                                <option value="">PayPal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-5">
                        <table class="table-dark" id="ticket-table">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">Rasa Melaka</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="col1">Date</td>
                                    <td id="col2">:</td>
                                    <td id="col3">
                                        <span id="detail-txt">2019-08-26</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Time</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">8:00 pm</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Malaysian</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">3 x RM68.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Concession</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">1 x RM48.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Selected seat(s)</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">A1, A2, A3, A4</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table-dark" id="ticket-table" style="margin-top: 1rem;">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">Payment information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="col1">Sub-total</td>
                                    <td id="col2">:</td>
                                    <td id="col3">
                                        <span id="detail-txt">RM252.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tax</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">RM0.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">RM252.00</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="cta-div" class="text-center">
                            <a href="{{ route('booking-ticket') }}" class="btn" id="cta-btn"><i class="fa fa-angle-left"></i> Previous</a>
                            <a href="{{ route('booking-confirm') }}" class="btn" id="cta-btn">Confirm <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF TICKET INFO SECTION -->
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
