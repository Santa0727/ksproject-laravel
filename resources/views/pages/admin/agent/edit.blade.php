@extends('layout.admin', ['activePage' => 'agent', 'titlePage' => __('Agent')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="mainForm" method="post" enctype="multipart/form-data" action="save" autocomplete="off" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" value="{{ (empty($user->id)) ? 0 : $user->id }}">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <h4 class="card-title">Add Agent</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="#" class="btn btn-success btn-sm btn-save">Save</a>
                                    <a href="{{ route('admin-agent') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Photo</label>
                                <div class="col-sm-7">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-circle">
                                            <img src="photo/{{ empty($user->id) ? 0 : $user->id }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                        <div>
                                            <span class="btn btn-file btn-sm">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="photo" id = "input-picture">
                                            </span>
                                            <a href="#pablo" class="btn btn-danger fileinput-exists btn-sm" data-dismiss="fileinput">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (empty($user->id))
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Agent Type</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select name="agent_type" class="custom-select" style="width: auto;">
                                            <?php foreach (config('ticketing.agent_type') as $name => $value) { ?>
                                            <option value="{{$value}}">{{$name}}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <label class="col-sm-2 col-form-label">User ID</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control-plaintext" name="uid" type="text" readonly value="{{ $user->uid }}">
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="name" type="text" placeholder="" value="{{ empty($user->name) ? '' : $user->name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="email" type="email" placeholder="" value="{{ empty($user->email) ? '' : $user->email }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="phone" type="text" placeholder="" value="{{ empty($user->phone) ? '' : $user->phone }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Discount</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="discount" type="text" placeholder="" value="{{ empty($user->discount) ? '' : $user->discount }}">
                                    </div>
                                </div>
                            </div>
                            @if (empty($user->id))
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="password" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Active</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <div class="togglebutton">
                                            <label>
                                                <input type="checkbox" name="is_active" value="{{ config('ticketing.account_active.yes') }}" {{ (empty($user->is_active) || $user->is_active == config('ticketing.account_active.yes')) ? 'checked' : '' }}>
                                                <span class="toggle"></span>
                                            </label>
                                        </div>
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
        $('.btn-save').on('click', function(){
            if ($('form#mainForm').valid()) {

            @if (empty($user->id))
                var pwd = $('form#mainForm input[name="password"]').val().trim();
                var pwd_confirm = $('form#mainForm input[name="password_confirmation"]').val().trim();
                if (pwd != pwd_confirm) {
                    alert('The password confirmation does not match.');
                    return;
                }
            @endif

                $('form#mainForm').submit();
            }
        });
    });
</script>
@endpush
