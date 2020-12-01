@extends('layout.admin', ['activePage' => 'notification', 'titlePage' => __('Notifications')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form id="mainForm" method="post" action="" autocomplete="off">
                @csrf
                <input type="hidden" name="id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <h4 class="card-title">Notifications</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success alert-with-icon" data-notify="container">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                    <span data-notify="message">Notification1 .....</span>
                                </div>
                                <div class="alert alert-success alert-with-icon" data-notify="container">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                    <span data-notify="message">Notification2 .....</span>
                                </div>
                                <div class="alert alert-success alert-with-icon" data-notify="container">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                    <span data-notify="message">Notification3 .....</span>
                                </div>
                                <div class="alert alert-success alert-with-icon" data-notify="container">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                    <span data-notify="message">Notification4 .....</span>
                                </div>
                                <div class="alert alert-success alert-with-icon" data-notify="container">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                    <span data-notify="message">Notification5 .....</span>
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
@endpush
