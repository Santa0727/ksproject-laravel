@extends('layout.admin', ['activePage' => 'account', 'titlePage' => __('Account')])

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
                                    <i class="fas fa-user"></i>
                                </div>
                                <h4 class="card-title">Sub Admins</h4>
                            </div>
                            <div class="card-body">
                                <div class="dataTables_wrapper">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_filter">
                                                <label>
                                                    <input type="text" name="keyword" class="form-control form-control-sm" value="{{ empty($params['keyword'])?'':$params['keyword'] }}" placeholder="Search users">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <div class="toolbar">
                                                <a href="#" class="btn btn-success btn-sm btn-edit" data-id="0">Add sub-admin</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Photo</th>
                                                        <th>User ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Active</th>
                                                        <th>Creation date</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if (count($users) == 0)
                                                    <tr>
                                                        <td colspan="9">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                @else
                                                    <?php
                                                        $index = ($params['page'] - 1) * $params['rows'] + 1;
                                                        foreach ($users as $user) {
                                                    ?>
                                                    <tr>
                                                        <td>{{ $index }}</td>
                                                        <td>
                                                            <div class="rounded-circle img-circle">
                                                                <img src="account/photo/{{ $user->id }}" alt="" class="rounded-circle user-photo">
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->uid }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>
                                                            @if ($user->is_active == config('ticketing.account_active.yes'))
                                                            <i class="fa fa-check"></i>
                                                            @endif
                                                        </td>
                                                        <td>{{ date_format(date_create($user->created_time), 'Y-m-d') }}</td>
                                                        <td class="td-actions text-right">
                                                            <a href="#" class="btn btn-info btn-role" data-id="{{ $user->id }}"><i class="fas fa-wrench"></i></a>
                                                            <a href="#" class="btn btn-success btn-edit" data-id="{{ $user->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                            $index++;
                                                        }
                                                    ?>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @include('layout.admin_pagination', ['params' => $params, 'records' => $users])
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
<script src="{{ asset('js/pages/pagination.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.btn-edit').on('click', function(){
            var id = $(this).attr('data-id');
            $('form#mainForm input[name="id"]').val(id);
            $('form#mainForm').attr('action', 'account/edit');
            $('form#mainForm').submit();
        });
        $('form#mainForm input[name="keyword"]').on('change', function() {
            goPage(1);
        });
        $('.btn-role').on('click', function(){
            var id = $(this).attr('data-id');
            $('form#mainForm input[name="id"]').val(id);
            $('form#mainForm').attr('action', 'account/role');
            $('form#mainForm').submit();
        });
    });
</script>
@endpush
