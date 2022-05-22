@extends('layouts.app')
@section('addstyle')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endsection
@section('content')
    @include('layouts.flash_message')
    <h1>Company Stock</h1>
    <div class="card">
        <div class="card-header">
            <form class="form-inline" name="company-form" id="company-form" method="get" action="{{ route('get.company.detail') }}">
                @csrf
                <div class="row">
                    <div class="col-md-5 mmr-15 ">
                        <div class="input-group">
                            <select name="company_symbol" class="form-control" id="company_symbol">
                                <option value="">Select Company Symbol</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 mmr-15">
                        <div class="input-group">
                            <input type="text"  name="start_date" id="start_date" class="form-control datepicker"
                                   placeholder="Start Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-2 mmr-15">
                        <div class="input-group">
                            <input type="text" name="end_date" id="end_date" class="form-control datepicker"
                                   placeholder="End Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="row mt-10">
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn btn-primary" id="btn-submit" name="btn-submit" type="submit">Submit</button>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" id="btn-reset" name="btn-reset" type="button">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Open</th>
                    <th>High</th>
                    <th>Low</th>
                    <th>Close</th>
                    <th>Volume</th>
                </tr>
                </thead>
                <tbody id="historical-data">
                <td colspan="6" class="text-center text-bold">No Record found.</td>
                </tbody>
            </table>
            <div id="chart-container" class="w100" style="height: 450px;"></div>
        </div>
    </div>

@endsection
@section('addscript')
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.stock.min.js?SameSite=Non"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"></script>
    <script src="{{ asset("js/general.js")  }}"></script>
    <script src="{{ asset("js/function.js")  }}"></script>
    <script src="{{ asset("js/custom-rule.js")  }}"></script>
@endsection
