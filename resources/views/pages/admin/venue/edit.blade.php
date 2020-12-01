@extends('layout.admin', ['activePage' => 'hall', 'titlePage' => __('Halls')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="mainForm" method="post" enctype="multipart/form-data" action="save" autocomplete="off" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" value="{{ (empty($venue->id)) ? 0 : $venue->id }}">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="far fa-life-ring"></i>
                            </div>
                            <h4 class="card-title">Add new hall</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                    <a href="{{ route('admin-hall') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="name" type="text" placeholder="Name" value="{{ empty($venue->name) ? '' : $venue->name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Descripton</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <textarea class="form-control" name="description" placeholder="" rows="3">{{ empty($venue->description) ? '' : $venue->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Active</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <div class="togglebutton">
                                            <label>
                                                <input type="checkbox" name="status" value="{{ config('ticketing.available.yes') }}" {{ (empty($venue->status) || $venue->status == config('ticketing.available.yes')) ? 'checked' : '' }}>
                                                <span class="toggle"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Seats Map</label>
                                <div class="col-sm-7">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="text-left">
                                            <span class="btn btn-file btn-sm">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="seats_map">
                                            </span>
                                            <a href="#" class="btn btn-danger fileinput-exists btn-sm" data-dismiss="fileinput">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </div>
                                        <div class="fileinput-new">
                                            <img src="map/{{ empty($venue->id) ? 0 : $venue->id }}" alt="..." style="max-width: 100%;">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists"></div>
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
            
        });
    </script>
@endpush
