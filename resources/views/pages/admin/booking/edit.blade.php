@extends('layout.admin', ['activePage' => 'booking', 'titlePage' => __('Booking')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form id="mainForm" method="post" action="" autocomplete="off">
                @csrf
                <input type="hidden" name="id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Booking</h4>
                            </div>
                            <div class="card-body">
                                <div class="wizard-container">
                                    <div class="card card-wizard active" data-color="rose" id="wizardProfile">
                                        <div class="wizard-navigation">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#show" data-toggle="tab" role="tab">
                                                        SELECT SHOW DATE & TIME
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#ticket" data-toggle="tab" role="tab">
                                                        SELECT TICKET
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#confirm" data-toggle="tab" role="tab">
                                                        YOUR INFORMATION
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="show">
                                                    
                                                </div>
                                                <div class="tab-pane" id="ticket">
                                                </div>
                                                <div class="tab-pane" id="confirm">
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
@endsection

@push('js')
    <script>
            
    </script>
@endpush
