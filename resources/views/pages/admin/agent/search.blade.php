@extends('layout.admin', ['activePage' => 'agent', 'titlePage' => __('Agent')])

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
                                <h4 class="card-title">Agents</h4>
                            </div>
                            <div class="card-body">
                                <div class="dataTables_wrapper">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="dataTables_filter">
                                                <label>
                                                    <input type="text" name="keyword" class="form-control form-control-sm" value="{{ empty($params['keyword'])?'':$params['keyword'] }}" placeholder="Search users">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="dataTables_filter">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="account_type[]" value="{{ config('ticketing.account_type.agent') }}" {{ in_array(config('ticketing.account_type.agent'), $params['account_type']) ? 'checked' : '' }}> Agent(Lv2)
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="account_type[]" value="{{ config('ticketing.account_type.sub_agent_lv3') }}" {{ in_array(config('ticketing.account_type.sub_agent_lv3'), $params['account_type']) ? 'checked' : '' }}> Sub-Agent(Lv3)
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="account_type[]" value="{{ config('ticketing.account_type.sub_agent_lv4') }}" {{ in_array(config('ticketing.account_type.sub_agent_lv4'), $params['account_type']) ? 'checked' : '' }}> Sub-Agent(Lv4)
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <div class="toolbar">
                                                <a href="#" class="btn btn-success btn-sm btn-edit" data-id="0">Add agent</a>
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
                                                        <th>Discount</th>
                                                        <th>Active</th>
                                                        <th>Creation date</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if (count($users) == 0)
                                                    <tr>
                                                        <td colspan="10">
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
                                                                @if ($user->account_type == config('ticketing.account_type.agent'))
                                                                    <img src="agent/photo/{{ $user->id }}" alt="" class="rounded-circle user-photo agent-lv2-photo">
                                                                @elseif ($user->account_type == config('ticketing.account_type.sub_agent_lv3'))
                                                                    <img src="agent/photo/{{ $user->id }}" alt="" class="rounded-circle user-photo agent-lv3-photo">
                                                                @elseif ($user->account_type == config('ticketing.account_type.sub_agent_lv4'))
                                                                    <img src="agent/photo/{{ $user->id }}" alt="" class="rounded-circle user-photo agent-lv4-photo">
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->uid }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ empty($user->discount) ? '' : $user->discount . ' %' }}</td>
                                                        <td>
                                                            @if ($user->is_active == config('ticketing.account_active.yes'))
                                                            <i class="fa fa-check"></i>
                                                            @endif
                                                        </td>
                                                        <td>{{ date_format(date_create($user->created_time), 'Y-m-d') }}</td>
                                                        <td class="td-actions text-right">
                                                            @if ($user->account_type == config('ticketing.account_type.agent'))
                                                                <a href="#" class="btn btn-info btn-paymenttype" data-id="{{ $user->id }}"><i class="fas fa-wrench"></i></a>
                                                                <a href="#" class="btn btn-success btn-edit" data-id="{{ $user->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                            @endif
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
            $('form#mainForm').attr('action', 'agent/edit');
            $('form#mainForm').submit();
        });
        $('form#mainForm input[name="keyword"]').on('change', function() {
            goPage(1);
        });
        $('form#mainForm input[name="account_type[]"]').on('change', function() {
            goPage(1);
        });
        $('.btn-paymenttype').on('click', function(){
            var id = $(this).attr('data-id');
            $('form#mainForm input[name="id"]').val(id);
            $('form#mainForm').attr('action', 'agent/payment_type');
            $('form#mainForm').submit();
        });
    });
</script>
@endpush
