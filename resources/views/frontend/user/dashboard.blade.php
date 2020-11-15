@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="row">
        <div class="col-xl-6 xl-100">
            <div class="card" data-intro="This is University Earning Chart">
                <div class="card-header university-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Company Earning</h5>
                        </div>
                        <div class="col-sm-6">
                            <div class="pull-right d-flex buttons-right">
                                <div class="right-header">
                                    <div class="onhover-dropdown">
                                        <button class="btn btn-primary" type="button">Monthly <span class="pr-0"><i class="fa fa-angle-down"></i></span></button>
                                        <div class="onhover-show-div right-header-dropdown"><a class="d-block" href="#">Average</a><a class="d-block" href="#">Maximum</a><a class="d-block" href="#">Minimum</a></div>
                                    </div>
                                </div>
                                <div class="right-header">
                                    <div class="onhover-dropdown">
                                        <button class="btn btn-light" type="button">yearly <span class="pr-0"><i class="fa fa-angle-down"></i></span></button>
                                        <div class="onhover-show-div right-header-dropdown"><a class="d-block" href="#">Average</a><a class="d-block" href="#">Maximum</a><a class="d-block" href="#">Minimum</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body height-curves">
                    <div class="curves-2">
                        <div class="animate-curve ct-golden-section"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 xl-100">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media feather-main">
                                <div class="feather-icon-block"><i data-feather="command"></i></div>
                                <div class="media-body align-self-center">
                                    <h6>Total Lorry</h6>
                                    <p class="counter">{{ $data['total_lorry'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media feather-main">
                                <div class="feather-icon-block"><i data-feather="navigation"></i></div>
                                <div class="media-body align-self-center">
                                    <h6>Active Lorry</h6>
                                    <p class="counter">{{ $data['active_lorry'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media chart-university">
                                <div class="media-body">
                                    <h3 class="mb-0">RM<span class="counter">{{ number_format($cur_month['income'],2) }}</span></h3>
                                    <p>Income ({{ date('M') }})</p>
                                </div>
                                <div class="small-bar">
                                    <div class="ct-small-left flot-chart-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media chart-university">
                                <div class="media-body">
                                    <h3 class="mb-0">RM<span class="counter">{{ number_format($cur_month['expenses'],2) }}</span></h3>
                                    <p>Expenses ({{ date('M') }})</p>
                                </div>
                                <div class="small-bar">
                                    <div class="ct-small-right flot-chart-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Math Professors</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive professor-table">
                                <table class="table table-bordernone">
                                    <tbody>
                                    <tr>
                                        <td><img class="img-radius img-35 align-top m-r-15 rounded-circle" src="../assets/images/university/math-1.jpg" alt="">
                                            <div class="professor-block d-inline-block">luson keter
                                                <p>Math Professors</p>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="pull-right mb-0" for="edo-ani">
                                                <input class="radio_animated" id="edo-ani" type="radio" name="rdo-ani">
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img class="img-radius img-25 align-top m-r-15 rounded-circle" src="../assets/images/university/math-2.jpg" alt="">
                                            <div class="professor-block d-inline-block">Elan hormas
                                                <p>Bio Professors</p>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="pull-right mb-0" for="edo-ani1">
                                                <input class="radio_animated" id="edo-ani1" type="radio" name="rdo-ani1" checked="">
                                            </label>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Bio Professors</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive professor-table">
                                <table class="table table-bordernone">
                                    <tbody>
                                    <tr>
                                        <td><img class="img-radius img-25 align-top m-r-15 rounded-circle" src="../assets/images/university/bio-1.jpg" alt="">
                                            <div class="professor-block d-inline-block">Erana siddy
                                                <p>Director</p>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="pull-right mb-0" for="edo-ani2">
                                                <input class="radio_animated" id="edo-ani2" type="radio" name="rdo-ani2" checked="">
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img class="img-radius img-35 align-top m-r-15 rounded-circle" src="../assets/images/university/bio-2.jpg" alt="">
                                            <div class="professor-block d-inline-block">Tom kerrly
                                                <p>Director</p>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="pull-right mb-0" for="edo-ani3">
                                                <input class="radio_animated" id="edo-ani3" type="radio" name="rdo-ani3">
                                            </label>
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
        <div class="col-xl-4 xl-50">
            <div class="card height-equal">
                <div class="card-header">
                    <h6>Upcoming Lorry Service</h6>
                </div>
                <div class="card-body">
                    <div class="upcoming-event">
                        @foreach($data['upcoming_service'] as $upcoming_service)
                            <div class="upcoming-innner media">
                                <div class="bg-primary left m-r-20"><i data-feather="truck"></i></div>
                                <div class="media-body">
                                    <p class="mb-0"> <span class="pull-right">{{ reformatDateTime($upcoming_service->next_service, 'd M') }}</span></p>
                                    <h6 class="f-w-600 text-uppercase">{{ $upcoming_service->lorry->plat_number }}</h6>
                                    <p class="mb-0">Next Service Mileage : {{ $upcoming_service->mileage_next_service  }}KM</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 xl-50">
            <div class="card height-equal" data-intro="This is Ranker Ratio">
                <div class="card-header">
                    <h5>Ranker Ratio</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="icofont icofont-simple-left"></i></li>
                            <li><i class="view-html fa fa-code"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                            <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="ranker text-center">
                        <h6>Student</h6>
                        <h5 class="mb-0">New Ranker 2018</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 xl-100">
            <div class="card height-equal">
                <div class="card-header">
                    <h6>Recent Repair & Maintenance Record</h6>
                </div>
                <div class="card-body">
                    <div class="notifiaction-media">
                        <div class="media">
                            <div class="media-body">
                                <div class="circle-left"></div>
                                <h6>You are confirmation visit..<span class="pull-right f-12">1 Day Ago</span></h6>
                            </div>
                        </div>
                        @foreach($data['recent_repair'] as $recent_repair)
                            <div class="media">
                                <div class="media-body">
                                    <div class="circle-left"></div>
                                    <h6>Lorem Ipsum has been the..<span class="pull-right f-12">5 Day Ago</span></h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer btn-more text-center"><a href="#">MORE...</a></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Statistics</h5>
                            <button class="btn btn-primary btn-sm header-btn btn-pill">2017</button>
                        </div>
                        <div class="col-sm-6">
                            <div class="pull-right statistics">
                                <h5 class="counter">85</h5>
                                <p class="f-12 mb-0">Statistics 2017</p>
                                <div class="font-primary font-weight-bold d-flex f-11 pull-right"><i class="fa fa-sort-up mr-2"></i><span class="number"><span class="counter">100</span>%</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="curves-2">
                        <div class="animate-curve2 ct-golden-section"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Last 5 Year Board</h5>
                            <p class="f-12 header-small mb-0">18 september, 2018</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="pull-right statistics">
                                <h5 class="counter">50</h5>
                                <p class="f-12 mb-0">Board 2018</p>
                                <div class="font-primary font-weight-bold d-flex f-11 pull-right"><i class="fa fa-sort-up mr-2"></i><span class="number"><span class="counter">78</span>%</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="board-chart ct-golden-section"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 xl-50">
            <div class="card" data-intro="Driver List(Example)">
                <div class="card-header">
                    <h5>Driver On Job(Example)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive topper-lists">
                        <table class="table table-bordernone">
                            <tbody>
                                <tr>
                                <td>
                                    <div class="d-inline-block align-self-center">
                                        <div class="form-group d-inline-block">
                                            <div class="checkbox">
                                                <input id="checkbox2" type="checkbox" checked="">
                                                <label for="checkbox2"></label>
                                            </div>
                                        </div><img class="img-radius img-40 align-top m-r-15 rounded-circle" src="assets/images/user/1.jpg" alt="">
                                        <div class="check-dot d-inline-block"></div>
                                        <div class="d-inline-block">
                                            <span class="f-w-600">Venter Loren</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-inline-block text-center"><span class="f-w-600">+60 10 5960586</span>
                                        <p>Phone Number</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-inline-block text-center"><span class="f-w-600">BLQ 233445</span>
                                        <p>Lorry</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-inline-block text-center"><span class="f-w-600">Pulau Pinang - Perak</span>
                                        <p>Destination</p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 xl-50">
            <div class="card card-gradient">
                <div class="card-body text-center o-hidden">
                    <div class="knob-header">
                        <h5>Total Student</h5>
                        <div class="d-inline-block pull-right f-16">120 / <span>130</span></div>
                    </div>
                    <div class="knob-block text-center knob-center">
                        <input class="knob" data-width="180" data-height="180" data-thickness=".1" data-angleoffset="90" data-fgcolor="#fff" data-bgcolor="#256dd4" data-linecap="round" value="85">
                    </div><img class="round-image" src="../assets/images/university/round.png" alt="">
                </div>
            </div>
        </div>
        <div class="col-xl-4 xl-50">
            <div class="card" data-intro="This is Date picker">
                <div class="datepicker-here date-picker-university" data-language="en"></div>
            </div>
        </div>
        <div class="col-xl-8 xl-50">
            <div class="card">
                <div class="card-header">
                    <h5>Admission Ratio</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="icofont icofont-simple-left"></i></li>
                            <li><i class="view-html fa fa-code"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                            <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
