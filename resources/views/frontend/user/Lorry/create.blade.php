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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Wizard And Validation</h5><span>Validation Step Form Wizard</span>
                </div>
                <div class="card-body">
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            @foreach($steps as $step => $name)
                                <div class="stepwizard-step"><a class="btn-primary btn {{ (request('step') == $step)? 'btn-info' : 'btn-light' }}" href="#step-1" data-original-title="" title="">{{ $step }}</a>
                                    <p>{{ $name }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if(request('step') == 1)
                        <div class="setup-content" id="step-1">
                            <div class="col-md-12">
                                <x-forms.post :action="route('frontend.user.lorry.insert', ['step' => 1])">
                                    <div class="">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{ __('Plat Number') }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control text-uppercase" type="text" name="plat_number" value="{{ old('plat_number') }}">
                                                        @error('plat_number')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="submit" data-original-title="" title="">Next</button>

                                </x-forms.post>
                            </div>
                        </div>
                    @elseif(request('step') == 2)
                        <div class="setup-content" id="step-2" >
                        <div class="col-md-12">
                            <x-forms.post :action="route('frontend.user.lorry.insert', ['step' => 2])">
                                <div class="">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">{{ __('Plat Number') }}</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control text-uppercase" type="text" name="plat_number" value="{{ $lorry->plat_number }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="brand">{{ __('Brand') }}</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control text-uppercase" type="text" name="brand" id="brand" value="{{ old('brand')? old('brand') : $lorry->brand  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="model">{{ __(' Model') }}</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control text-uppercase" type="text" name="model" id="model" value="{{ old('model')? old('model') : $lorry->model  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="no_chassis">{{ __('Chassis Number') }}</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control text-uppercase" type="text" name="no_chassis" id="no_chassis" value="{{ old('no_chassis')? old('no_chassis') : $lorry->no_chassis  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="no_engine">{{ __('Engine Number') }}</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control text-uppercase" type="text" name="no_engine" id="no_engine" value="{{ old('no_engine')? old('no_engine') : $lorry->model  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="class">{{ __('Class') }}</label>
                                                <div class="col-sm-3">
                                                    <input class="form-control text-uppercase" type="text" name="class" id="class" value="{{ old('class')? old('class') : $lorry->model  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="engine_capacity">{{ __('Engine Capacity') }}</label>
                                                <div class="col-sm-3">
                                                    <input class="form-control text-uppercase" type="number" name="engine_capacity" id="engine_capacity" value="{{ old('engine_capacity')? old('engine_capacity') : $lorry->engine_capacity  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="registration_date">{{ __('Registration Date') }}</label>
                                                <div class="col-sm-3">
                                                    <input class="form-control digits" type="date" name="registration_date" id="registration_date" value="{{ old('registration_date')? old('registration_date') : $lorry->registration_date  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="btm">{{ __('BTM (Berat Tanpa Muatan) KG') }}</label>
                                                <div class="col-sm-3">
                                                    <input class="form-control" type="number" name="btm" id="btm" value="{{ old('btm')? old('btm') : $lorry->btm  }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary nextBtn pull-right" type="submit">Next</button>

                            </x-forms.post>
                        </div>
                    </div>
                    @elseif(request('step') == 3)
                        <div class="setup-content" id="step-3">
                            <div class="col-md-12">
                                <x-forms.post :action="route('frontend.user.lorry.insert', ['step' => 3])">
                                    <div class="">
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" for="expire_date">{{ __('Expired Date') }}</label>
                                                            <div class="col-sm-3">
                                                                <input class="form-control digits" type="date" name="expire_date" id="expire_date" value="{{ old('expire_date') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label" for="roadtax_price">{{ __('Road Tax Price') }}</label>
                                                    <div class="col-sm-3">
                                                        <input class="form-control " type="number" step="0.10" name="roadtax_price" id="roadtax_price" value="{{ old('roadtax_price') }}">
                                                        @error('roadtax_price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label" for="insurance_price">{{ __('Insurance Price') }}</label>
                                                    <div class="col-sm-3">
                                                        <input class="form-control " type="number" step="0.10" name="insurance_price" id="insurance_price" value="{{ old('insurance_price') }}">
                                                        @error('insurance_price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label" for="remark">{{ __('Ramark') }}</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="remark" id="remark" rows="5">{{ old('remark') }}</textarea>
                                                        @error('remark')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="submit" data-original-title="" title="">Next</button>

                                </x-forms.post>
                            </div>
                        </div>
                    @elseif(request('step') == 4)
                        <div class="setup-content" id="step-4">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">State</label>
                                        <input class="form-control mt-1" type="text" placeholder="State" required="required" data-original-title="" title="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input class="form-control mt-1" type="text" placeholder="City" required="required" data-original-title="" title="">
                                    </div>
                                    <button class="btn btn-success pull-right" type="submit" data-original-title="" title="">Finish!</button>
                                </div>
                            </div>
                        </div>
                    @elseif(request('step') == 5)
                        <div class="setup-content" id="step-4">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">State</label>
                                        <input class="form-control mt-1" type="text" placeholder="State" required="required" data-original-title="" title="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input class="form-control mt-1" type="text" placeholder="City" required="required" data-original-title="" title="">
                                    </div>
                                    <button class="btn btn-success pull-right" type="submit" data-original-title="" title="">Finish!</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
