
<form id="seatsForm" method="post" autocomplete="off" class="form-horizontal">
    @csrf
    <input type="hidden" name="price_id" value="{{ empty($price->id) ? 0 : $price->id }}">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <input type="text" class="form-control-plaintext" readonly value="{{ config('ticketing.ticket_type')[$price->ticket_type] }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <div class="" style="max-height: 300px; overflow: auto;">
                <table class="table table-striped table-hover table-sm">
                    <tbody>
                        <?php foreach ($seats as $seat) { ?>
                        <tr>
                            <td class="text-right">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="" checked>
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                {{ $seat->name }}
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
