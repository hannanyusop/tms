@extends('frontend.layouts.app')

@section('title', __('Create'))


@php
    $steps = [
    1 => 'Plat Number',
    2 => 'Lorry Information',
    3 => 'Road Tax & Insurance',
    4 => 'Last Service Record',
    5 => 'Finish'
    ];
@endphp

@section('content')

    <div class="nk-block nk-block-lg col-md-8 offset-md-2">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card card-custom-s1 card-bordered">
                    <div class="row no-gutters">
                        <div class="col-lg-12">
                            <div class="card-inner card-inner-lg h-100">
                                <div class="card-head">
                                    <h5 class="card-title">Lorry Information</h5>
                                </div>
                                <x-forms.post :action="route('frontend.user.lorry.update', $lorry->id)" class="gy-3">
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="plat_number">Registration Number</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="plat_number" name="plat_number" value="{{ old('plat_number')? old('plat_number') : $lorry->plat_number }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="brand">Brand</label>
                                                <span class="form-note">Required | Min:2 | Max:20</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input class="form-control text-uppercase" type="text" name="brand" id="brand" placeholder="SCANIA" value="{{ old('brand')? old('brand') : $lorry->brand  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="model">Model</label>
                                                <span class="form-note">Required | Min:2 | Max:50</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input class="form-control text-uppercase" type="text" name="model" id="model" placeholder="WSI 150 6x2" value="{{ old('model')? old('model') : $lorry->model  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="model">Chassis Number</label>
                                                <span class="form-note">Required | Min:2 | Max:50</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input class="form-control text-uppercase" type="text" name="no_chassis" placeholder="E423JFDG084323" id="no_chassis" value="{{ old('no_chassis')? old('no_chassis') : $lorry->no_chassis  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="no_engine">Engine Number</label>
                                                <span class="form-note">Required | Min:2 | Max:50</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input class="form-control text-uppercase" type="text" name="no_engine" id="no_engine" placeholder="2H2XAHTL43847556" value="{{ old('no_engine')? old('no_engine') : $lorry->no_engine }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="engine_capacity">Engine Capacity (L)</label>
                                                <span class="form-note">Required</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input class="form-control text-uppercase" type="number" name="engine_capacity" id="engine_capacity" placeholder="7" value="{{ old('engine_capacity')? old('engine_capacity') : $lorry->engine_capacity  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="class">Class</label>
                                                <span class="form-note">Required | Max : 20</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input class="form-control text-uppercase" type="text" name="class" id="class" placeholder="1" value="{{ old('class')? old('class') : $lorry->class  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="no_engine">Registration Date</label>
                                                <span class="form-note">Required </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd" name="registration_date" id="registration_date" value="{{ old('registration_date')? old('registration_date') : $lorry->registration_date  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="no_engine">BTM (KG)</label>
                                                <span class="form-note">Required </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input class="form-control" type="number" name="btm" id="btm"  placeholder="1200" value="{{ old('btm')? old('btm') : $lorry->btm  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row g-3">
                                        <div class="col-lg-7 offset-lg-5">
                                            <div class="form-group mt-2">
                                                <a href="{{ route('frontend.user.lorry.index') }}" class="btn btn-lg btn-warning">Back</a>
                                                <button type="submit" class="btn btn-lg btn-primary">Update</button>

                                            </div>
                                        </div>
                                    </div>
                                </x-forms.post>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>

    </div>
@endsection
