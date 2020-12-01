<form id="editForm" method="post" autocomplete="off" class="form-horizontal">
    @csrf
    <input type="hidden" name="id" value="{{ empty($price->id) ? 0 : $price->id }}">
    <div class="card-body">
        <div class="row">
            <label class="col-sm-4 col-form-label">Ticket Type</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <select class="custom-select" name="ticket_type" required>
                        <option value=""></option>
                        <?php
                            foreach (config('ticketing.ticket_type') as $key => $value) {
                        ?>
                        <option value="{{ $key }}" {{ (!empty($price) && $price->ticket_type == $key) ? 'selected' : '' }}>{{ $value }}</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Weekday Price</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <input type="text" class="form-control" name="weekday_price" value="{{ empty($price->weekday_price) ? '' : $price->weekday_price }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Weekend Price</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <input type="text" class="form-control" name="weekend_price" value="{{ empty($price->weekend_price) ? '' : $price->weekend_price }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Active</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <div class="togglebutton">
                        <label>
                            <input type="checkbox" name="status" value="{{ config('ticketing.available.yes') }}" {{ (empty($price) || $price->status == config('ticketing.available.yes')) ? 'checked' : '' }}>
                            <span class="toggle"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label">Seats</label>
            <div class="col-sm-7">
                <div class="form-group">
                    <div class="price-seats">
                        <table class="table table-seats">
                            <tbody>
                                <?php
                                    $price_seats = [];
                                    if (!empty($price->seats)) {
                                        $price_seats = json_decode($price->seats, true);
                                    }
                                    foreach ($seats as $seat) {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input seat-check" type="checkbox" value="{{ $seat->id }}" {{ (in_array($seat->id, $price_seats)) ? 'checked' : '' }}> {{ $seat->name }}
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
