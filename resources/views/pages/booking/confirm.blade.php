@extends('layout.booking')

@section('content')
<div class="container">
    <header class="header-page" id="header-section"></header>
    <!-- PROMOTION SECTION -->
    <div class="row">
        <div class="col-12">
            <h2 class="title title--h4 js-lines text-center" id="h1-title">
                Confirmation
            </h2>
        </div>
    </div>
    <!-- END OF PROMOTION SECTION -->

    <!-- TICKET INFO SECTION -->
    <div class="row">
        <div class="col-12">
            <div class="description js-scroll-show">
                <div class="row">
                    <div class="col-md-8 mr-auto ml-auto">
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
                        <table class="table-dark" id="ticket-table" style="margin-top: 1rem;">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">Your details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="col1">Name</td>
                                    <td id="col2">:</td>
                                    <td id="col3">
                                        <span id="detail-txt">John</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">john@mail.com</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">1234567890</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Payment method</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">PayPal</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="cta-div" class="text-center">
                            <a href="{{ route('booking-show') }}" class="btn" id="cta-btn">Cancel</a>
                            <a href="#" class="btn" id="btnConfirm">Confirm Booking <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: rgba(0,0,0,.8);">
                <div class="modal-header">
                    <h5 class="modal-title card-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label class="col-sm-4 col-form-label text-right">Confirmation ID</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <p class="form-control-static">****************</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal" id="btnOK">OK</button>
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
        $('#btnConfirm').on('click', function(){
            $('#confirmModal').modal('show');
        });
        $('#btnOK').on('click', function(){
            $('#confirmModal').modal('hide');
            document.location.href='{{ route('booking-show') }}';
        });
    });
</script>
@endpush
