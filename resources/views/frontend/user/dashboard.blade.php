@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header project-header">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5>Schedule</h5>
                            </div>
                            <div class="col-sm-4">
                                <div class="select2-drpdwn-project select-options">
                                    <select class="form-control form-control-primary btn-square" name="select">
                                        <option value="opt1">Today</option>
                                        <option value="opt2">Yesterday</option>
                                        <option value="opt3">Tomorrow</option>
                                        <option value="opt4">Monthly</option>
                                        <option value="opt5">Weekly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="schedule">
                            <div class="media">
                                <div class="media-body">
                                    <h6>Group Meeting</h6>
                                    <p>30 minutes</p>
                                </div>
                                <div class="dropdown schedule-dropdown">
                                    <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="" title=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#" data-original-title="" title="">Project</a><a class="dropdown-item" href="#" data-original-title="" title="">Requirements</a><a class="dropdown-item" href="#" data-original-title="" title="">Discussion</a><a class="dropdown-item" href="#" data-original-title="" title="">Planning</a></div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <h6>Public Beta Release</h6>
                                    <p>10:00 PM</p>
                                </div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <h6>Lunch</h6>
                                    <p>12:30 PM</p>
                                </div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <h6>Clients Timing</h6>
                                    <p>2:00 PM to 6:00 PM</p>
                                </div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <h5 class="mb-0">Lorries</h5>
                            </div>
                            <div class="project-widgets text-center">
                                <h1 class="font-primary counter">45</h1>
                                <h6 class="mb-0">Due Tasks</h6>
                            </div>
                        </div>
                        <div class="card-footer project-footer">
                            <h6 class="mb-0">Completed: <span class="counter">14</span></h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <h5 class="mb-0">Features</h5>
                            </div>
                            <div class="project-widgets text-center">
                                <h1 class="font-primary counter">80</h1>
                                <h6 class="mb-0">Proposals</h6>
                            </div>
                        </div>
                        <div class="card-footer project-footer">
                            <h6 class="mb-0">Implemented: <span class="counter">14</span></h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <h5 class="mb-0">Issues</h5>
                            </div>
                            <div class="project-widgets text-center">
                                <h1 class="font-primary counter">34</h1>
                                <h6 class="mb-0">Open</h6>
                            </div>
                        </div>
                        <div class="card-footer project-footer">
                            <h6 class="mb-0">Closed today: <span class="counter">10</span></h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <h5 class="mb-0">Overdue</h5>
                            </div>
                            <div class="project-widgets text-center">
                                <h1 class="font-primary counter">7</h1>
                                <h6 class="mb-0">Tasks</h6>
                            </div>
                        </div>
                        <div class="card-footer project-footer">
                            <h6 class="mb-0">Task Solved: <span class="counter">4</span></h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header project-header">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h5>Task Distribution</h5>
                                </div>
                                <div class="col-sm-4">
                                    <div class="select2-drpdwn-project select-options">
                                        <select class="form-control form-control-primary btn-square" name="select">
                                            <option value="opt1">Today</option>
                                            <option value="opt2">Yesterday</option>
                                            <option value="opt3">Tomorrow</option>
                                            <option value="opt4">Monthly</option>
                                            <option value="opt5">Weekly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body chart-block chart-vertical-center project-charts">
                            <canvas id="myDoughnutGraph" width="657" height="331" style="width: 526px; height: 265px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
