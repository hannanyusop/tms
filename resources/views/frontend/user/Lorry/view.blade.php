@extends('frontend.layouts.app')

@section('title', __('Lorry'))

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="row product-page-main">
                <div class="col-xl-4">
                    <img src="{{ (!is_null($lorry->image))?asset($lorry->image) : "https://mytruck.my/uf/adata/1000_6265_928e7c14cef3c49a0cb1e635322951fc.jpeg" }}" class="img-fluid">
                </div>
                <div class="col-xl-8">
                    <div class="product-page-details">
                        <h5 class="text-uppercase">{{ $lorry->plat_number }}</h5>
                        <div class="d-flex">
                            <span class="text-uppercase">{{ $lorry->model."(".$lorry->brand.")" }}</span>
                        </div>
                    </div>
                    <hr>

                    <div>
                        <table width="80%">
                            <tbody>
                            <tr>
                                <td>Class</td>
                                <td class="font-weight-bold">:{{ $lorry->class }}</td>
                            </tr>
                            <tr>
                                <td>Chassis Number</td>
                                <td class="font-weight-bold">:{{ $lorry->no_chassis }}</td>
                            </tr>
                            <tr>
                                <td>Engine Number</td>
                                <td class="font-weight-bold">:{{ $lorry->no_engine }}</td>
                            </tr>
                            <tr>
                                <td>BTM</td>
                                <td class="font-weight-bold">:{{ $lorry->btm }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card o-hidden">
                                <div class="bg-success b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="align-self-center text-center"><i data-feather="trending-up"></i></div>
                                        <div class="media-body"><span class="m-0">Earnings</span>
                                            <h4 class="mb-0 counter">{{ displayPrice($lorry->totalDebit()) }}</h4><i class="icon-bg" data-feather="trending-up"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card o-hidden">
                                <div class="bg-secondary b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="align-self-center text-center"><i data-feather="trending-down"></i></div>
                                        <div class="media-body"><span class="m-0">Expenses</span>
                                            <h4 class="mb-0 counter">{{ displayPrice($lorry->totalCredit()) }}</h4><i class="icon-bg" data-feather="trending-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card o-hidden">
                                <div class="bg-warning b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="align-self-center text-center"><i class="fa fa-cogs fa-2x"></i></div>
                                        <div class="media-body"><span class="m-0">Next Service</span>
                                            <h4 class="mb-0 counter">{{ ($lorry->latestServices)? $lorry->latestServices->next_service : "Not Set" }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-6 col-lg-6">
                            <div class="card o-hidden">
                                <div class="bg-danger b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="align-self-center text-center"><i class="fa fa-gears fa-2x"></i></div>
                                        <div class="media-body"><span class="m-0">Insurance Expire</span>
                                            <h4 class="mb-0 counter">{{ ($lorry->latestInsurance)? $lorry->latestInsurance->expire_date : "Not Set" }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="m-t-15">
                        <a class="btn btn-primary m-r-10" href="">Service</a>
                        <a class="btn btn-secondary m-r-10" href="">Renew Insurance</a>
                        <a class="btn btn-success" href="">Repair</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row product-page-main">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-material mb-0" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="false" data-original-title="" title="">Insurance</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false" data-original-title="" title="">Service</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item"><a class="nav-link active show" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="true" data-original-title="" title="">Repair & Mantainance</a>
                            <div class="material-border"></div>
                        </li>
                    </ul>
                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Road Tax Price</th>
                                        <td>Expired Date</td>
                                    </tr>
                                    @foreach($lorry->insurances() as $key => $insurance)
                                        <tr>
                                            <th>{{ $key+1 }}</th>
                                            <th>{{ $insurance->created_at }}</th>
                                            <td>{{ displayPrice($insurance->roadtax_price) }}</td>
                                            <td>{{ $insurance->expire_date }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Road Tax Price</th>
                                        <th>Next Service(KM)</th>
                                    </tr>
                                    @foreach($lorry->services() as $key => $service)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <th>{{ $insurance->created_at }}</th>
                                            <td>{{ displayPrice($service->amount) }}</td>
                                            <td>{{ $service->mileage_next_service }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade active show" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Remark</th>
                                    </tr>
                                    @foreach($lorry->repairs() as $key => $repair)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <th>{{ $repair->created_at }}</th>
                                            <td>{{ displayPrice($repair->amount) }}</td>
                                            <td>{{ $repair->remark }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
