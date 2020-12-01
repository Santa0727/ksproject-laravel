<form id="editForm" method="post" autocomplete="off" class="form-horizontal">
    @csrf
    <input type="hidden" name="id" value="{{ (empty($package->id)) ? 0 : $package->id }}">
    <div class="card-body">
            <div class="row">
                <label class="col-sm-4 col-form-label">Name</label>
                <div class="col-sm-7">
                    <div class="form-group">
                        <input class="form-control" name="name" type="text" value="{{ empty($package->name) ? '' : $package->name }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Ticket Type</label>
                <div class="col-sm-7">
                    <div class="form-group">
                        <select name="ticket_type" class="custom-select" required>
                            <option value=""></option>
                        <?php
                            foreach (config('ticketing.ticket_type') as $key => $value) {
                        ?>
                            <option value="{{ $key }}" {{ (!empty($package->ticket_type) && $package->ticket_type == $key) ? 'selected' : '' }}>{{ $value }}</option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Tickets</label>
                <div class="col-sm-7">
                    <div class="form-group">
                        <input class="form-control" name="tickets" type="text" value="{{ empty($package->tickets) ? '' : $package->tickets }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Active</label>
                <div class="col-sm-7">
                    <div class="form-group">
                        <div class="togglebutton">
                            <label>
                                <input type="checkbox" name="status" value="{{ config('ticketing.available.yes') }}" {{ (empty($package->status) || $package->status == config('ticketing.available.yes')) ? 'checked' : '' }}>
                                <span class="toggle"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
