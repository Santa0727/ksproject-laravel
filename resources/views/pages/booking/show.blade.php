@extends('layout.booking')

@section('content')
<div class="container">
    <header class="header-page" id="header-section"></header>
    <!-- PROMOTION SECTION -->
    <div class="row">
        <div class="col-12">
            <h2 class="title title--h4 js-lines" id="h1-title">
                Select Show
            </h2>
            <div class="row">
                <div class="form-group col-sm-6">
                    <input type="text" class="input form-control datepicker" required="required" placeholder="show date" value="2019-08-26">
                </div>
            </div>
        </div>
    </div>
    <!-- END OF PROMOTION SECTION -->

    <!-- TICKET INFO SECTION -->
    <div class="row">
        <div class="col-12">
            <div class="description js-scroll-show">
                <div class="row">
                    <div class="col-12 col-lg-5 col-xl-5">
                        <a class="example-image-link" href="" data-lightbox="ticket-info">
                            <img class="cover lazyload img-shadow example-image" src="{{ asset('img/shows/2.jpg') }}" alt="" />
                        </a>
                    </div>

                    <div class="col-12 col-lg-7 col-xl-7">
                        <table class="table-dark" id="ticket-table">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">Rasa Melaka</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="col1">Show’s Language</td>
                                    <td id="col2">:</td>
                                    <td id="col3">
                                        <span id="detail-txt">Mix of English, Mandarin &amp; Bahasa Malaysia (with subtitle)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Running Time</td>
                                    <td>:</td>
                                    <td>
                                        <span id="detail-txt">60 minutes</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Show Time</td>
                                    <td>:</td>
                                    <td>
                                        <p id="table-p">
                                            <span id="detail-txt">Tuesday / Wednesday / Thursday&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>&nbsp;&nbsp;8pm</span>
                                        </p>
                                        <p>
                                            <span id="detail-txt">Friday / Saturday / Sunday&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>&nbsp;&nbsp;3pm &amp; 8pm</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Select Time</td>
                                    <td>:</td>
                                    <td>
                                        <p id="table-p">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="showtime" id="showtime1" class="custom-control-input" checked>
                                                <label class="custom-control-label" for="showtime1"> 3pm</label>
                                            </div>
                                        </p>
                                        <p>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="showtime" id="showtime2" class="custom-control-input">
                                                <label class="custom-control-label" for="showtime2">8pm</label>
                                            </div>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="cta-div" class="text-right">
                            <a href="{{ route('booking-ticket') }}" class="btn">Next <i class="fa fa-angle-right"></i></a>
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
