@extends('frontend.layouts.app')

@section('title', __('Lorry'))

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="row product-page-main">
                <div class="col-xl-4">
                    <img src="{{ getLorryImage($lorry->id) }}" class="img-fluid">
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
                                            <h4 class="mb-0">{{ displayPrice($lorry->totalDebit()) }}</h4><i class="icon-bg" data-feather="trending-up"></i>
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
                                            <h4 class="mb-0">{{ displayPrice($lorry->totalCredit()) }}</h4><i class="icon-bg" data-feather="trending-down"></i>
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
                                            <h4 class="mb-0">{{ ($lorry->latestServices)? $lorry->latestServices->next_service : "Not Set" }}</h4>
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
                                            <h4 class="mb-0">{{ ($lorry->latestInsurance)? $lorry->latestInsurance->expire_date : "Not Set" }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="m-t-15">
                        <a class="btn btn-primary m-r-10" href="{{ route('frontend.user.lorry.service.create', $lorry->id) }}">Add Service Record</a>
                        <a class="btn btn-secondary m-r-10" href="{{ route('frontend.user.lorry.insurance.create', $lorry->id) }}">Renew Insurance</a>
                        <a class="btn btn-success" href="{{ route('frontend.user.lorry.repair.create', $lorry->id) }}">Add Repair Record</a>
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
                                        <th>Expired Date</th>
                                        <th>Road Tax Price</th>
                                        <th>Insurance Price</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                    @foreach($lorry->insurances() as $key => $insurance)
                                        <tr>
                                            <th>{{ $key+1 }}</th>
                                            <th>{{ $insurance->created_at }}</th>
                                            <td>{{ $insurance->expire_date }}</td>
                                            <td>{{ displayPrice($insurance->roadtax_price) }}</td>
                                            <td>{{ displayPrice($insurance->insurance_price) }}</td>
                                            <td>{{ displayPrice($insurance->amount) }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('frontend.user.lorry.insurance.edit', $insurance->id) }}">Edit</a>
                                                <a href="#" class="delete btn btn-danger btn-sm" data-url="{{ route('frontend.user.lorry.insurance.delete', $insurance->id) }}" data-message="Are you sure want to delete this Insurance record?">Delete</a>

                                            </td>
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
                                        <th>Amount</th>
                                        <th>Next Service(KM)</th>
                                        <td></td>
                                    </tr>
                                    @foreach($lorry->services() as $key => $service)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <th>{{ $service->created_at }}</th>
                                            <td>{{ displayPrice($service->amount) }}</td>
                                            <td>{{ $service->mileage_next_service }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('frontend.user.lorry.service.edit', $service->id) }}">Edit</a>
                                                <a href="#" class="delete btn btn-danger btn-sm" data-url="{{ route('frontend.user.lorry.service.delete', $service->id) }}" data-message="Are you sure want to delete this Service Record?">Delete</a>

                                            </td>
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
                                        <td></td>
                                    </tr>
                                    @foreach($lorry->repairs() as $key => $repair)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <th>{{ $repair->created_at }}</th>
                                            <td>{{ displayPrice($repair->amount) }}</td>
                                            <td>{{ $repair->remark }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('frontend.user.lorry.repair.edit', $repair->id) }}">Edit</a>
                                                <a href="#" class="delete btn btn-danger btn-sm" data-url="{{ route('frontend.user.lorry.repair.delete', $repair->id) }}" data-message="Are you sure want to delete this Repair & Maintenance Record?">Delete</a>

                                            </td>
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
