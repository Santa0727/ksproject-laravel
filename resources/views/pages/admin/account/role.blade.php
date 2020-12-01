@extends('layout.admin', ['activePage' => 'account', 'titlePage' => __('Account')])

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
                        <h4 class="card-title">Sub Admin Privileges</h4>
                    </div>
                    <div class="card-body">
                        <form id="mainForm" method="post" action="" class="form-horizontal">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('admin-account') }}" class="btn btn-sm">Back to list</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-no-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Role Name</th>
                                                <th>Description</th>
                                                <th>Privilege</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $index = 1;
                                                foreach ($roles as $role) {
                                            ?>
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->description }}</td>
                                                <td>
                                                    <select class="custom-select role-level" data-role="{{ $role->id }}">
                                                        <option></option>
                                                        <option value="{{ config('ticketing.account_role_level.view') }}" {{ ($role->level == config('ticketing.account_role_level.view')) ? 'selected' : '' }}>View</option>
                                                        <option value="{{ config('ticketing.account_role_level.change') }}" {{ ($role->level == config('ticketing.account_role_level.change')) ? 'selected' : '' }}>Change</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php
                                                    $index++;
                                                }
                                            ?>
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
        $('form#mainForm select.role-level').on('change', function(){
            var role_id = $(this).attr('data-role');
            var level = $(this).val();
            $.ajax({
                url: 'role/save',
                type: 'POST',
                data: {
                    '_token': $('form#mainForm input[name="_token"]').val(),
                    'user_id': $('form#mainForm input[name="user_id"]').val(),
                    'role_id': role_id,
                    'level': level
                },
                dataType: 'json',
                success: function(result) {
                    
                }
            });
        });
    });
</script>
@endpush
