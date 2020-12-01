@if (count($records) == 0)
<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_length">
            <label>Show 0 entries</label>
        </div>
        <input type="hidden" name="rows" value="{{ $params['rows'] }}">
        <input type="hidden" name="page" value="{{ $params['page'] }}">
    </div>
</div>
@else
<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_length">
            <label>Total {{ $params['total'] }} entries / Show </label>
            <select name="rows" class="custom-select custom-select-sm form-control form-control-sm">
                <option value="10" {{ ($params['rows'] == 10) ? 'selected' : '' }}>10</option>
                <option value="25" {{ ($params['rows'] == 25) ? 'selected' : '' }}>25</option>
                <option value="50" {{ ($params['rows'] == 50) ? 'selected' : '' }}>50</option>
            </select>
            <label>entries per page</label>
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_full_numbers">
            <input type="hidden" name="page" value="{{ $params['page'] }}">
            <ul class="pagination">
                <li class="paginate_button page-item first {{ ($params['page'] == 1) ? 'disabled' : '' }}">
                    <a href="#" data-page="1" tabindex="0" class="page-link">First</a>
                </li>
                <li class="paginate_button page-item previous {{ ($params['page'] == 1) ? 'disabled' : '' }}">
                    <a href="#" data-page="{{ ($params['page'] == 1) ? 1 : $params['page'] - 1 }}" tabindex="0" class="page-link">Prev</a>
                </li>
                <?php
                    $start = $params['page'] - 2;
                    $end = $params['page'] + 2;
                    $total_pages = $params['total'] / $params['rows'];
                    if ($params['total'] % $params['rows'] > 0) {
                        $total_pages = $total_pages + 1;
                    }
                    if ($start < 1) {
                        $start = 1;
                        $end = ($total_pages > 5) ? 5 : $total_pages;
                    }
                    if ($end > $total_pages) {
                        $end = $total_pages;
                        $start = ($total_pages > 5) ? $total_pages - 4 : 1;
                    }
                    for ($p = $start; $p <= $end; $p++) {
                ?>
                    <li class="paginate_button page-item {{ ($p == $params['page']) ? 'active' : '' }}">
                        <a href="#" data-page="{{ $p }}" tabindex="0" class="page-link">{{ $p }}</a>
                    </li>
                <?php
                    }
                ?>
                <li class="paginate_button page-item next {{ ($params['page'] == $total_pages) ? 'disabled' : '' }}">
                    <a href="#" data-page="{{ ($params['page'] == $total_pages) ? $total_pages : $params['page'] + 1 }}" tabindex="0" class="page-link">Next</a>
                </li>
                <li class="paginate_button page-item last {{ ($params['page'] == $total_pages) ? 'disabled' : '' }}">
                    <a href="#" data-page="{{ $total_pages }}" tabindex="0" class="page-link">Last</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif