@extends('frontend.layouts.app')

@section('title', __('Lorry'))

@section('content')

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="row gy-gs">
                        <div class="col-lg-5">
                            <div class="nk-iv-wg3">
                                <div class="nk-iv-wg3-title text-uppercase">{{ $lorry->model."(".$lorry->brand.")" }}</div>
                                <div class="nk-iv-wg3-group  flex-lg-nowrap gx-4">
                                    <div class="nk-iv-wg3-sub">
                                        <div class="nk-iv-wg3-amount">
                                            <div class="number text-uppercase">{{ $lorry->plat_number }}</div>
                                        </div>
                                        <div class="nk-iv-wg3-subtitle">Available Balance</div>
                                    </div>
                                    <div class="nk-iv-wg3-sub">
                                        <div class="nk-iv-wg3-amount">
                                            <div class="number-sm">{{ $lorry->btm }}</div>
                                        </div>
                                        <div class="nk-iv-wg3-subtitle">BTM <em class="icon ni ni-info-fill" data-toggle="tooltip" data-placement="right" title="" data-original-title="Berat Tanpa Muatan"></em></div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-lg-7">
                            <div class="nk-iv-wg3">
                                <div class="nk-iv-wg3-title"> <em class="icon ni ni-info-fill" data-toggle="tooltip" data-placement="right" title="" data-original-title="Current Month Profit"></em></div>
                                <div class="nk-iv-wg3-group flex-md-nowrap g-4">
                                    <div class="nk-iv-wg3-sub-group gx-4">
                                        <div class="nk-iv-wg3-sub">
                                            <div class="nk-iv-wg3-amount">
                                                <div class="number text-uppercase">{{ $lorry->no_engine }}</div>
                                            </div>
                                            <div class="nk-iv-wg3-subtitle">Engine Number</div>
                                        </div>
                                        <div class="nk-iv-wg3-sub">
                                            <div class="nk-iv-wg3-amount">
                                                <div class="number-sm">{{ $lorry->no_chassis }}</div>
                                            </div>
                                            <div class="nk-iv-wg3-subtitle">Chassis Number</div>
                                        </div>
                                    </div>
                                    <div class="nk-iv-wg3-sub flex-grow-1 ml-md-3">
                                        <div class="nk-iv-wg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                            <canvas class="chart-profit chartjs-render-monitor" id="profitCM" style="display: block; height: 45px; width: 298px;" width="372" height="56"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .card-inner -->
                <div class="card-inner">
                    <ul class="nk-iv-wg3-nav">
                        <li><a href="{{ route('frontend.user.lorry.service.create', $lorry->id) }}"><em class="icon ni ni-notes-alt"></em> <span>Add Service Record</span></a></li>
                        <li><a href="{{ route('frontend.user.lorry.insurance.create', $lorry->id) }}"><em class="icon ni ni-list-check"></em> <span>Renew Insurance</span></a></li>
                        <li><a href="{{ route('frontend.user.lorry.repair.create', $lorry->id) }}"><em class="icon ni ni-account-setting-alt"></em> <span>Add Repair Record</span></a></li>
                    </ul>
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div>

    <div class="nk-block">
        <div class="row gy-gs">
            <div class="col-md-4 col-lg-4">
                <div class="nk-wg-card is-dark card card-bordered">
                    <div class="card-inner">
                        <div class="nk-iv-wg2">
                            <div class="nk-iv-wg2-title">
                                <h6 class="title">Earnings <em class="icon ni ni-info"></em></h6>
                            </div>
                            <div class="nk-iv-wg2-text">
                                <div class="nk-iv-wg2-amount"> {{ displayPrice($lorry->totalDebit()) }} <span class="change up"><span class="sign"></span>3.4%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->

            <div class="col-md-4 col-lg-4">
                <div class="nk-wg-card is-dark card card-bordered">
                    <div class="card-inner">
                        <div class="nk-iv-wg2">
                            <div class="nk-iv-wg2-title">
                                <h6 class="title">Expenses <em class="icon ni ni-info"></em></h6>
                            </div>
                            <div class="nk-iv-wg2-text">
                                <div class="nk-iv-wg2-amount"> {{ displayPrice($lorry->totalCredit()) }} <span class="change up"><span class="sign"></span>0.0%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->

            <div class="col-md-4 col-lg-4">
                <div class="nk-wg-card is-dark card card-bordered">
                    <div class="card-inner">
                        <div class="nk-iv-wg2">
                            <div class="nk-iv-wg2-title">
                                <h6 class="title"> Next Service <em class="icon ni ni-info"></em></h6>
                            </div>
                            <div class="nk-iv-wg2-text">
                                <div class="nk-iv-wg2-amount"> {{ ($lorry->latestServices)? $lorry->latestServices->next_service : "Not Set" }}
                                    <span class="change up">
                                                    {{ ($lorry->latestServices)? $lorry->latestServices->mileage_next_service. " KM" : "Not Set" }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->

            <div class="col-md-4 col-lg-4">
                <div class="nk-wg-card is-dark card card-bordered">
                    <div class="card-inner">
                        <div class="nk-iv-wg2">
                            <div class="nk-iv-wg2-title">
                                <h6 class="title">Insurance Expire <em class="icon ni ni-info"></em></h6>
                            </div>
                            <div class="nk-iv-wg2-text">
                                <div class="nk-iv-wg2-amount"> {{ ($lorry->latestInsurance)? $lorry->latestInsurance->expire_date : "Not Set" }} <span class="change up"><span class="sign"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->

            <div class="col-md-4 col-lg-4">
                <div class="nk-wg-card is-dark card card-bordered">
                    <div class="card-inner">
                        <div class="nk-iv-wg2">
                            <div class="nk-iv-wg2-title">
                                <h6 class="title"> Monthly Installment <em class="icon ni ni-info"></em></h6>
                            </div>
                            <div class="nk-iv-wg2-text">
                                <div class="nk-iv-wg2-amount"> {{ displayPrice(1604.50) }} <span class="change up"> 24 Month Left</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <ul class="nav nav-tabs nav-tabs-s2 mt-n2">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#insurance">Insurance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#service">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#repair">Repair & Mantainance</a>
                    </li>

                </ul>
                <div class="tab-content text-center">
                    <div class="tab-pane active" id="insurance">
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
                                            <button class="delete btn btn-danger btn-sm" data-url="{{ route('frontend.user.lorry.insurance.delete', $insurance->id) }}" data-message="Are you sure want to delete this Insurance record?">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="service">
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
                                            <button class="delete btn btn-danger btn-sm" data-url="{{ route('frontend.user.lorry.service.delete', $service->id) }}" data-message="Are you sure want to delete this Service Record?">Delete</button>

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="repair">
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
                                            <button href="#" class="delete btn btn-danger btn-sm" data-url="{{ route('frontend.user.lorry.repair.delete', $repair->id) }}" data-message="Are you sure want to delete this Repair & Maintenance Record?">Delete</button>

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
@endsection
