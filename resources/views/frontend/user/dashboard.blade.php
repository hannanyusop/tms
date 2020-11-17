@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-lg-8">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-3">
                            <div class="card-title">
                                <h6 class="title">Account Overview</h6>
                                <p>In last 15 days overview. <a href="#" class="link link-sm">Detailed Stats</a></p>
                            </div>
                            <div class="card-tools mt-n1 mr-n1">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#" class="active"><span>15 Days</span></a></li>
                                            <li><a href="#"><span>30 Days</span></a></li>
                                            <li><a href="#"><span>3 Months</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-title-group -->
                        <div class="nk-order-ovwg">
                            <div class="row g-4 align-end">
                                <div class="col-xxl-8">
                                    <div class="nk-order-ovwg-ck">
                                        <canvas class="order-overview-chart" id="orderOverview"></canvas>
                                    </div>
                                </div><!-- .col -->
                                <div class="col-xxl-4">
                                    <div class="row g-4">
                                        <div class="col-sm-6 col-xxl-12">
                                            <div class="nk-order-ovwg-data buy">
                                                <div class="amount">{{ displayPrice($cur_month['income']) }}</div>
                                                <div class="title">Income </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xxl-12">
                                            <div class="nk-order-ovwg-data sell">
                                                <div class="amount">{{ displayPrice($cur_month['expenses']) }}</div>
                                                <div class="title">Expenses</div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                            </div>
                        </div><!-- .nk-order-ovwg -->
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-lg-4">
                <div class="card card-bordered h-100">
                    <div class="card-inner-group">
                        <div class="card-inner card-inner-md">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Service Remainder </h6>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                        @foreach($data['upcoming_service'] as $upcoming_service)
                            <div class="card-inner">
                                <div class="nk-wg-action">
                                    <div class="nk-wg-action-content">
                                        <em class="icon ni ni-help-fill"></em>
                                        <div class="title">{{ reformatDateTime($upcoming_service->next_service, 'd M') }}</div>
                                        <h6 class="f-w-600 text-uppercase">{{ $upcoming_service->lorry->plat_number }}</h6>
                                        <p class="mb-0">Next Service Mileage : {{ $upcoming_service->mileage_next_service  }}KM</p>
                                    </div>
                                    <a href="#" class="btn btn-icon btn-trigger mr-n2"><em class="icon ni ni-forward-ios"></em></a>
                                </div>
                            </div><!-- .card-inner -->
                        @endforeach
                    </div><!-- .card-inner-group -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-lg-8">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title"><span class="mr-2">Latest Transaction</span> <a href="#" class="link d-none d-sm-inline">See History</a></h6>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-orders">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span>Desc</span></div>
                                <div class="nk-tb-col tb-col-sm"><span>Date</span></div>
                                <div class="nk-tb-col tb-col-xl"><span>Time</span></div>
                                <div class="nk-tb-col text-right"><span>Debit</span></div>
                                <div class="nk-tb-col text-right"><span>Credit</span></div>
                            </div><!-- .nk-tb-item -->

                            @foreach($data['transactions'] as $transaction)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-lead">{{ $transaction->type }}</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-sm">
                                        <span class="tb-sub">{{ reformatDateTime($transaction->created_at, 'd/m/Y') }}</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-xl">
                                        <span class="tb-sub">{{ reformatDateTime($transaction->created_at, 'h:m A') }}</span>
                                    </div>
                                    <div class="nk-tb-col text-right">
                                        {!! ($transaction->debit > 0)? "<span class='tb-sub tb-amount text-success'>+ ".displayPrice($transaction->debit)."</span>" : "" !!}
                                    </div>
                                    <div class="nk-tb-col text-right">
                                        {!! ($transaction->credit > 0)? "<span class='tb-sub tb-amount text-danger'>- ".displayPrice($transaction->credit)."</span>" : "" !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner-sm border-top text-center d-sm-none">
                        <a href="#" class="btn btn-link btn-block">See History</a>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-lg-4">
                <div class="row g-gs">
                    <div class="col-md-6 col-lg-12">
                        <div class="card card-bordered card-full">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-2">
                                    <div class="card-title">
                                        <h6 class="title">Top Coin in Orders</h6>
                                        <p>In last 15 days buy and sells overview.</p>
                                    </div>
                                    <div class="card-tools mt-n1 mr-n1">
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                    <li><a href="#"><span>3 Months</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card-title-group -->
                                <div class="nk-coin-ovwg">
                                    <div class="nk-coin-ovwg-ck">
                                        <canvas class="coin-overview-chart" id="coinOverview"></canvas>
                                    </div>
                                    <ul class="nk-coin-ovwg-legends">
                                        <li><span class="dot dot-lg sq" data-bg="#f98c45"></span><span>Bitcoin</span></li>
                                        <li><span class="dot dot-lg sq" data-bg="#9cabff"></span><span>Ethereum</span></li>
                                        <li><span class="dot dot-lg sq" data-bg="#8feac5"></span><span>NioCoin</span></li>
                                        <li><span class="dot dot-lg sq" data-bg="#6b79c8"></span><span>Litecoin</span></li>
                                        <li><span class="dot dot-lg sq" data-bg="#79f1dc"></span><span>Bitcoin Cash</span></li>
                                    </ul>
                                </div><!-- .nk-coin-ovwg -->
                            </div><!-- .card-inner -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
@endsection
@push('after-scripts')
    <script type="text/javascript">
        "use strict";

        !function (NioApp, $) {
            "use strict";

            var profileBalance = {
                labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
                dataUnit: 'BTC',
                lineTension: 0.15,
                datasets: [{
                    label: "Total Received",
                    color: "#798bff",
                    background: NioApp.hexRGB('#798bff', .3),
                    data: [111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 75, 90]
                }]
            };

            function lineProfileBalance(selector, set_data) {
                var $selector = selector ? $(selector) : $('.profile-balance-chart');
                $selector.each(function () {
                    var $self = $(this),
                        _self_id = $self.attr('id'),
                        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;

                    var selectCanvas = document.getElementById(_self_id).getContext("2d");
                    var chart_data = [];

                    for (var i = 0; i < _get_data.datasets.length; i++) {
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            tension: _get_data.lineTension,
                            backgroundColor: _get_data.datasets[i].background,
                            borderWidth: 2,
                            borderColor: _get_data.datasets[i].color,
                            pointBorderColor: "transparent",
                            pointBackgroundColor: "transparent",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: _get_data.datasets[i].color,
                            pointBorderWidth: 2,
                            pointHoverRadius: 3,
                            pointHoverBorderWidth: 2,
                            pointRadius: 3,
                            pointHitRadius: 3,
                            data: _get_data.datasets[i].data
                        });
                    }

                    var chart = new Chart(selectCanvas, {
                        type: 'line',
                        data: {
                            labels: _get_data.labels,
                            datasets: chart_data
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            maintainAspectRatio: false,
                            tooltips: {
                                enabled: true,
                                callbacks: {
                                    title: function title(tooltipItem, data) {
                                        return false;
                                    },
                                    label: function label(tooltipItem, data) {
                                        return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                                    }
                                },
                                backgroundColor: '#eff6ff',
                                titleFontSize: 11,
                                titleFontColor: '#6783b8',
                                titleMarginBottom: 4,
                                bodyFontColor: '#9eaecf',
                                bodyFontSize: 10,
                                bodySpacing: 3,
                                yPadding: 8,
                                xPadding: 8,
                                footerMarginTop: 0,
                                displayColors: false
                            },
                            scales: {
                                yAxes: [{
                                    display: false
                                }],
                                xAxes: [{
                                    display: false
                                }]
                            }
                        }
                    });
                });
            } // init chart


            NioApp.coms.docReady.push(function () {
                lineProfileBalance();
            });
            var orderOverview = {
                labels: @json($data['date_15']),
                dataUnit: 'RM',
                datasets: [{
                    label: "Income",
                    color: "#8feac5",
                    data: @json($data['inc_15'])
                }, {
                    label: "Expenses",
                    color: "#9cabff",
                    data: @json($data['exp_15'])
                }]
            };

            function orderOverviewChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.order-overview-chart');
                $selector.each(function () {
                    var $self = $(this),
                        _self_id = $self.attr('id'),
                        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
                        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;

                    var selectCanvas = document.getElementById(_self_id).getContext("2d");
                    var chart_data = [];

                    for (var i = 0; i < _get_data.datasets.length; i++) {
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            data: _get_data.datasets[i].data,
                            // Styles
                            backgroundColor: _get_data.datasets[i].color,
                            borderWidth: 2,
                            borderColor: 'transparent',
                            hoverBorderColor: 'transparent',
                            borderSkipped: 'bottom',
                            barPercentage: .8,
                            categoryPercentage: .6
                        });
                    }

                    var chart = new Chart(selectCanvas, {
                        type: 'bar',
                        data: {
                            labels: _get_data.labels,
                            datasets: chart_data
                        },
                        options: {
                            legend: {
                                display: _get_data.legend ? _get_data.legend : false,
                                labels: {
                                    boxWidth: 30,
                                    padding: 20,
                                    fontColor: '#6783b8'
                                }
                            },
                            maintainAspectRatio: false,
                            tooltips: {
                                enabled: true,
                                callbacks: {
                                    title: function title(tooltipItem, data) {
                                        return data.datasets[tooltipItem[0].datasetIndex].label;
                                    },
                                    label: function label(tooltipItem, data) {
                                        return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                                    }
                                },
                                backgroundColor: '#eff6ff',
                                titleFontSize: 13,
                                titleFontColor: '#6783b8',
                                titleMarginBottom: 6,
                                bodyFontColor: '#9eaecf',
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: false
                            },
                            scales: {
                                yAxes: [{
                                    display: true,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        beginAtZero: true,
                                        fontSize: 11,
                                        fontColor: '#9eaecf',
                                        padding: 10,
                                        callback: function callback(value, index, values) {
                                            return '$ ' + value;
                                        },
                                        stepSize: 10000
                                    },
                                    gridLines: {
                                        color: "#e5ecf8",
                                        tickMarkLength: 0,
                                        zeroLineColor: '#e5ecf8'
                                    }
                                }],
                                xAxes: [{
                                    display: true,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        fontSize: 9,
                                        fontColor: '#9eaecf',
                                        source: 'auto',
                                        padding: 10
                                    },
                                    gridLines: {
                                        color: "transparent",
                                        tickMarkLength: 0,
                                        zeroLineColor: 'transparent'
                                    }
                                }]
                            }
                        }
                    });
                });
            } // init chart


            NioApp.coms.docReady.push(function () {
                orderOverviewChart();
            });
            var userActivity = {
                labels: ["01 Nov", "02 Nov", "03 Nov", "04 Nov", "05 Nov", "06 Nov", "07 Nov", "08 Nov", "09 Nov", "10 Nov", "11 Nov", "12 Nov", "13 Nov", "14 Nov", "15 Nov", "16 Nov", "17 Nov", "18 Nov", "19 Nov", "20 Nov", "21 Nov"],
                dataUnit: 'USD',
                stacked: true,
                datasets: [{
                    label: "Direct Join",
                    color: "#9cabff",
                    data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90]
                }, {
                    label: "Referral Join",
                    color: "#ccd4ff",
                    data: [125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 90]
                }]
            };

            function userActivityChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.usera-activity-chart');
                $selector.each(function () {
                    var $self = $(this),
                        _self_id = $self.attr('id'),
                        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
                        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;

                    var selectCanvas = document.getElementById(_self_id).getContext("2d");
                    var chart_data = [];

                    for (var i = 0; i < _get_data.datasets.length; i++) {
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            data: _get_data.datasets[i].data,
                            // Styles
                            backgroundColor: _get_data.datasets[i].color,
                            borderWidth: 2,
                            borderColor: 'transparent',
                            hoverBorderColor: 'transparent',
                            borderSkipped: 'bottom',
                            barPercentage: .7,
                            categoryPercentage: .7
                        });
                    }

                    var chart = new Chart(selectCanvas, {
                        type: 'bar',
                        data: {
                            labels: _get_data.labels,
                            datasets: chart_data
                        },
                        options: {
                            legend: {
                                display: _get_data.legend ? _get_data.legend : false,
                                labels: {
                                    boxWidth: 30,
                                    padding: 20,
                                    fontColor: '#6783b8'
                                }
                            },
                            maintainAspectRatio: false,
                            tooltips: {
                                enabled: true,
                                callbacks: {
                                    title: function title(tooltipItem, data) {
                                        return data.datasets[tooltipItem[0].datasetIndex].label;
                                    },
                                    label: function label(tooltipItem, data) {
                                        return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                                    }
                                },
                                backgroundColor: '#eff6ff',
                                titleFontSize: 13,
                                titleFontColor: '#6783b8',
                                titleMarginBottom: 6,
                                bodyFontColor: '#9eaecf',
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: false
                            },
                            scales: {
                                yAxes: [{
                                    display: false,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                xAxes: [{
                                    display: false,
                                    stacked: _get_data.stacked ? _get_data.stacked : false
                                }]
                            }
                        }
                    });
                });
            } // init chart


            NioApp.coms.docReady.push(function () {
                userActivityChart();
            });
            var coinOverview = {
                labels: ["Bitcoin", "Ethereum", "NioCoin", "Litecoin", "Bitcoin"],
                stacked: true,
                datasets: [{
                    label: "Buy Orders",
                    color: ["#f98c45", "#9cabff", "#8feac5", "#6b79c8", "#79f1dc"],
                    data: [1740, 2500, 1820, 1200, 1600, 2500]
                }, {
                    label: "Sell Orders",
                    color: [NioApp.hexRGB('#f98c45', .2), NioApp.hexRGB('#9cabff', .4), NioApp.hexRGB('#8feac5', .4), NioApp.hexRGB('#6b79c8', .4), NioApp.hexRGB('#79f1dc', .4)],
                    data: [2420, 1820, 3000, 5000, 2450, 1820]
                }]
            };

            function coinOverviewChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.coin-overview-chart');
                $selector.each(function () {
                    var $self = $(this),
                        _self_id = $self.attr('id'),
                        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
                        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;

                    var selectCanvas = document.getElementById(_self_id).getContext("2d");
                    var chart_data = [];

                    for (var i = 0; i < _get_data.datasets.length; i++) {
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            data: _get_data.datasets[i].data,
                            // Styles
                            backgroundColor: _get_data.datasets[i].color,
                            borderWidth: 2,
                            borderColor: 'transparent',
                            hoverBorderColor: 'transparent',
                            borderSkipped: 'bottom',
                            barThickness: '8',
                            categoryPercentage: 0.5,
                            barPercentage: 1.0
                        });
                    }

                    var chart = new Chart(selectCanvas, {
                        type: 'horizontalBar',
                        data: {
                            labels: _get_data.labels,
                            datasets: chart_data
                        },
                        options: {
                            legend: {
                                display: _get_data.legend ? _get_data.legend : false,
                                labels: {
                                    boxWidth: 30,
                                    padding: 20,
                                    fontColor: '#6783b8'
                                }
                            },
                            maintainAspectRatio: false,
                            tooltips: {
                                enabled: true,
                                callbacks: {
                                    title: function title(tooltipItem, data) {
                                        return data['labels'][tooltipItem[0]['index']];
                                    },
                                    label: function label(tooltipItem, data) {
                                        return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + data.datasets[tooltipItem.datasetIndex]['label'];
                                    }
                                },
                                backgroundColor: '#eff6ff',
                                titleFontSize: 13,
                                titleFontColor: '#6783b8',
                                titleMarginBottom: 6,
                                bodyFontColor: '#9eaecf',
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: false
                            },
                            scales: {
                                yAxes: [{
                                    display: false,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        beginAtZero: true,
                                        padding: 0
                                    },
                                    gridLines: {
                                        color: "#e5ecf8",
                                        tickMarkLength: 0,
                                        zeroLineColor: '#e5ecf8'
                                    }
                                }],
                                xAxes: [{
                                    display: false,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        fontSize: 9,
                                        fontColor: '#9eaecf',
                                        source: 'auto',
                                        padding: 0
                                    },
                                    gridLines: {
                                        color: "transparent",
                                        tickMarkLength: 0,
                                        zeroLineColor: 'transparent'
                                    }
                                }]
                            }
                        }
                    });
                });
            } // init chart


            NioApp.coms.docReady.push(function () {
                coinOverviewChart();
            });
            var salesRevenue = {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                dataUnit: 'USD',
                stacked: true,
                datasets: [{
                    label: "Sales Revenue",
                    color: ["#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#6576ff"],
                    data: [11000, 8000, 12500, 5500, 9500, 14299, 11000, 8000, 12500, 5500, 9500, 14299]
                }]
            };
            var activeSubscription = {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                dataUnit: 'USD',
                stacked: true,
                datasets: [{
                    label: "Active User",
                    color: ["#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#6576ff"],
                    data: [8200, 7800, 9500, 5500, 9200, 9690]
                }]
            };
            var totalSubscription = {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                dataUnit: 'USD',
                stacked: true,
                datasets: [{
                    label: "Active User",
                    color: ["#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#e9ecff", "#aea1ff"],
                    data: [8200, 7800, 9500, 5500, 9200, 9690]
                }]
            };

            function salesBarChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.sales-bar-chart');
                $selector.each(function () {
                    var $self = $(this),
                        _self_id = $self.attr('id'),
                        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
                        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;

                    var selectCanvas = document.getElementById(_self_id).getContext("2d");
                    var chart_data = [];

                    for (var i = 0; i < _get_data.datasets.length; i++) {
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            data: _get_data.datasets[i].data,
                            // Styles
                            backgroundColor: _get_data.datasets[i].color,
                            borderWidth: 2,
                            borderColor: 'transparent',
                            hoverBorderColor: 'transparent',
                            borderSkipped: 'bottom',
                            barPercentage: .7,
                            categoryPercentage: .7
                        });
                    }

                    var chart = new Chart(selectCanvas, {
                        type: 'bar',
                        data: {
                            labels: _get_data.labels,
                            datasets: chart_data
                        },
                        options: {
                            legend: {
                                display: _get_data.legend ? _get_data.legend : false,
                                labels: {
                                    boxWidth: 30,
                                    padding: 20,
                                    fontColor: '#6783b8'
                                }
                            },
                            maintainAspectRatio: false,
                            tooltips: {
                                enabled: true,
                                callbacks: {
                                    title: function title(tooltipItem, data) {
                                        return false;
                                    },
                                    label: function label(tooltipItem, data) {
                                        return data['labels'][tooltipItem['index']] + ' ' + data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']];
                                    }
                                },
                                backgroundColor: '#eff6ff',
                                titleFontSize: 11,
                                titleFontColor: '#6783b8',
                                titleMarginBottom: 4,
                                bodyFontColor: '#9eaecf',
                                bodyFontSize: 10,
                                bodySpacing: 3,
                                yPadding: 8,
                                xPadding: 8,
                                footerMarginTop: 0,
                                displayColors: false
                            },
                            scales: {
                                yAxes: [{
                                    display: false,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                xAxes: [{
                                    display: false,
                                    stacked: _get_data.stacked ? _get_data.stacked : false
                                }]
                            }
                        }
                    });
                });
            } // init chart


            NioApp.coms.docReady.push(function () {
                salesBarChart();
            });
            var salesOverview = {
                labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
                dataUnit: 'BTC',
                lineTension: 0.1,
                datasets: [{
                    label: "Sales Overview",
                    color: "#798bff",
                    background: NioApp.hexRGB('#798bff', .3),
                    data: [8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690]
                }]
            };

            function lineSalesOverview(selector, set_data) {
                var $selector = selector ? $(selector) : $('.sales-overview-chart');
                $selector.each(function () {
                    var $self = $(this),
                        _self_id = $self.attr('id'),
                        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;

                    var selectCanvas = document.getElementById(_self_id).getContext("2d");
                    var chart_data = [];

                    for (var i = 0; i < _get_data.datasets.length; i++) {
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            tension: _get_data.lineTension,
                            backgroundColor: _get_data.datasets[i].background,
                            borderWidth: 2,
                            borderColor: _get_data.datasets[i].color,
                            pointBorderColor: "transparent",
                            pointBackgroundColor: "transparent",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: _get_data.datasets[i].color,
                            pointBorderWidth: 2,
                            pointHoverRadius: 3,
                            pointHoverBorderWidth: 2,
                            pointRadius: 3,
                            pointHitRadius: 3,
                            data: _get_data.datasets[i].data
                        });
                    }

                    var chart = new Chart(selectCanvas, {
                        type: 'line',
                        data: {
                            labels: _get_data.labels,
                            datasets: chart_data
                        },
                        options: {
                            legend: {
                                display: _get_data.legend ? _get_data.legend : false,
                                labels: {
                                    boxWidth: 30,
                                    padding: 20,
                                    fontColor: '#6783b8'
                                }
                            },
                            maintainAspectRatio: false,
                            tooltips: {
                                enabled: true,
                                callbacks: {
                                    title: function title(tooltipItem, data) {
                                        return data['labels'][tooltipItem[0]['index']];
                                    },
                                    label: function label(tooltipItem, data) {
                                        return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                                    }
                                },
                                backgroundColor: '#eff6ff',
                                titleFontSize: 13,
                                titleFontColor: '#6783b8',
                                titleMarginBottom: 6,
                                bodyFontColor: '#9eaecf',
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: false
                            },
                            scales: {
                                yAxes: [{
                                    display: true,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        beginAtZero: true,
                                        fontSize: 11,
                                        fontColor: '#9eaecf',
                                        padding: 10,
                                        callback: function callback(value, index, values) {
                                            return '$ ' + value;
                                        },
                                        min: 100,
                                        stepSize: 3000
                                    },
                                    gridLines: {
                                        color: "#e5ecf8",
                                        tickMarkLength: 0,
                                        zeroLineColor: '#e5ecf8'
                                    }
                                }],
                                xAxes: [{
                                    display: true,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        fontSize: 9,
                                        fontColor: '#9eaecf',
                                        source: 'auto',
                                        padding: 10
                                    },
                                    gridLines: {
                                        color: "transparent",
                                        tickMarkLength: 0,
                                        zeroLineColor: 'transparent'
                                    }
                                }]
                            }
                        }
                    });
                });
            } // init chart


            NioApp.coms.docReady.push(function () {
                lineSalesOverview();
            });
            var supportStatus = {
                labels: ["Bitcoin", "Ethereum", "NioCoin", "Feature Request", "Bug Fix"],
                stacked: true,
                datasets: [{
                    label: "Solved",
                    color: ["#f98c45", "#9cabff", "#8feac5", "#6b79c8", "#79f1dc"],
                    data: [66, 74, 92, 142, 189]
                }, {
                    label: "Open",
                    color: [NioApp.hexRGB('#f98c45', .4), NioApp.hexRGB('#9cabff', .4), NioApp.hexRGB('#8feac5', .4), NioApp.hexRGB('#6b79c8', .4), NioApp.hexRGB('#79f1dc', .4)],
                    data: [66, 74, 92, 32, 26]
                }, {
                    label: "Pending",
                    color: [NioApp.hexRGB('#f98c45', .2), NioApp.hexRGB('#9cabff', .2), NioApp.hexRGB('#8feac5', .2), NioApp.hexRGB('#6b79c8', .2), NioApp.hexRGB('#79f1dc', .2)],
                    data: [66, 74, 92, 21, 9]
                }]
            };

            function supportStatusChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.support-status-chart');
                $selector.each(function () {
                    var $self = $(this),
                        _self_id = $self.attr('id'),
                        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
                        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;

                    var selectCanvas = document.getElementById(_self_id).getContext("2d");
                    var chart_data = [];

                    for (var i = 0; i < _get_data.datasets.length; i++) {
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            data: _get_data.datasets[i].data,
                            // Styles
                            backgroundColor: _get_data.datasets[i].color,
                            borderWidth: 2,
                            borderColor: 'transparent',
                            hoverBorderColor: 'transparent',
                            borderSkipped: 'bottom',
                            barThickness: '8',
                            categoryPercentage: 0.5,
                            barPercentage: 1.0
                        });
                    }

                    var chart = new Chart(selectCanvas, {
                        type: 'horizontalBar',
                        data: {
                            labels: _get_data.labels,
                            datasets: chart_data
                        },
                        options: {
                            legend: {
                                display: _get_data.legend ? _get_data.legend : false,
                                labels: {
                                    boxWidth: 30,
                                    padding: 20,
                                    fontColor: '#6783b8'
                                }
                            },
                            maintainAspectRatio: false,
                            tooltips: {
                                enabled: true,
                                callbacks: {
                                    title: function title(tooltipItem, data) {
                                        return data['labels'][tooltipItem[0]['index']];
                                    },
                                    label: function label(tooltipItem, data) {
                                        return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + data.datasets[tooltipItem.datasetIndex]['label'];
                                    }
                                },
                                backgroundColor: '#eff6ff',
                                titleFontSize: 13,
                                titleFontColor: '#6783b8',
                                titleMarginBottom: 6,
                                bodyFontColor: '#9eaecf',
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: false
                            },
                            scales: {
                                yAxes: [{
                                    display: true,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        beginAtZero: true,
                                        padding: 16,
                                        fontColor: "#8094ae"
                                    },
                                    gridLines: {
                                        color: "transparent",
                                        tickMarkLength: 0,
                                        zeroLineColor: 'transparent'
                                    }
                                }],
                                xAxes: [{
                                    display: false,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        fontSize: 9,
                                        fontColor: '#9eaecf',
                                        source: 'auto',
                                        padding: 0
                                    },
                                    gridLines: {
                                        color: "transparent",
                                        tickMarkLength: 0,
                                        zeroLineColor: 'transparent'
                                    }
                                }]
                            }
                        }
                    });
                });
            } // init chart


            NioApp.coms.docReady.push(function () {
                supportStatusChart();
            });
        }(NioApp, jQuery);
    </script>
@endpush
