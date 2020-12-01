@extends('layout.admin', ['activePage' => 'options', 'titlePage' => __('Options')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <h4 class="card-title">Options</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="#" class="btn btn-success btn-sm">Save</a>
                                </div>
                            </div>
                            <ul class="nav nav-pills nav-pills-success" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#general" role="tablist">General</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#booking" role="tablist">Booking</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#aaa" role="tablist">Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#backup" role="tablist">Backup</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#invoice" role="tablist">Invoice</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-space">
                                <div class="tab-pane active show" id="general">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Option</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Date format</td>
                                                        <td>
                                                            <select class="custom-select" style="width: auto;">
                                                                <option value="">Y-m-d (2019-08-31)</option>
                                                                <option value="">Y.m.d (2019.08.31)</option>
                                                                <option value="">m/d/Y (08/31/2019)</option>
                                                                <option value="">m.d.Y (08.31.2019</option>
                                                                <option value="">d/m/Y (31/08/2019)</option>
                                                                <option value="">d.m.Y (31.08.2019)</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Time format</td>
                                                        <td>
                                                            <select class="custom-select" style="width: auto;">
                                                                <option value="H:i|G:i|h:i|h:i a|h:i A|g:i|g:i a|g:i A::H:i">H:i (09:45)</option>
                                                                <option value="H:i|G:i|h:i|h:i a|h:i A|g:i|g:i a|g:i A::G:i">G:i (9:45)</option>
                                                                <option value="H:i|G:i|h:i|h:i a|h:i A|g:i|g:i a|g:i A::h:i">h:i (09:45)</option>
                                                                <option value="H:i|G:i|h:i|h:i a|h:i A|g:i|g:i a|g:i A::h:i a">h:i a (09:45 am)</option>
                                                                <option value="H:i|G:i|h:i|h:i a|h:i A|g:i|g:i a|g:i A::h:i A">h:i A (09:45 AM)</option>
                                                                <option value="H:i|G:i|h:i|h:i a|h:i A|g:i|g:i a|g:i A::g:i">g:i (9:45)</option>
                                                                <option value="H:i|G:i|h:i|h:i a|h:i A|g:i|g:i a|g:i A::g:i a" selected="selected">g:i a (9:45 am)</option>
                                                                <option value="H:i|G:i|h:i|h:i a|h:i A|g:i|g:i a|g:i A::g:i A">g:i A (9:45 AM)</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Send email</td>
                                                        <td>
                                                            <select class="custom-select" style="width: auto;">
                                                                <option value="mail|smtp::mail" selected="selected">PHP mail()</option>
                                                                <option value="mail|smtp::smtp">SMTP</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="booking">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Option</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Currency</td>
                                                        <td>
                                                            <select class="custom-select" style="width: auto">
                                                                <option>MYR</option>
                                                                <option>USD</option>
                                                                <option>EUR</option>
                                                                <option>CNY</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tax</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" value="0.00">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="aaa">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Option</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>New booking received email</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="togglebutton">
                                                                    <label>
                                                                        <input type="checkbox" name="is_active" checked>
                                                                        <span class="toggle"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>New booking confirmation subject</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="Your booking has been received">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="backup">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Option</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Backup database</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="togglebutton">
                                                                    <label>
                                                                        <input type="checkbox" name="is_active" checked>
                                                                        <span class="toggle"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Backup files</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="togglebutton">
                                                                    <label>
                                                                        <input type="checkbox" name="is_active" checked>
                                                                        <span class="toggle"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br><br><br>

                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Date/Time</th>
                                                        <th>Type</th>
                                                        <th>Size</th>
                                                        <th>File</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="6">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="invoice">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Option</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Company name</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="Rasa Melaka">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="Manager">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Street address</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="20, Jalan Munshi Abdullah, Kampung Jawa">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="Malaysia">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="Melaka">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="Melaka">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Zip</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="75100">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="+606 2811 666">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="info@rasamelaka.com">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Website</td>
                                                        <td>
                                                            <input class="form-control" type="text" value="http://www.rasamelaka.com/">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        });
    </script>
@endpush
