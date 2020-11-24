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

    <div class="nk-block nk-block-lg">

        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card card-custom-s1 card-bordered">
                    <div class="row no-gutters">
                        <div class="col-lg-3">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <h5>Lorry Registration</h5>
                                </div>
                                <div class="card-inner">
                                    <ul class="list list-step">
                                        <li class="{{ (request('step') > 1)? "list-step-done" : "" }}">Registration Number Checking</li>
                                        <li class="{{ (request('step') > 2)? "list-step-done" : "" }}">Lorry Information</li>
                                        <li class="{{ (request('step') > 3)? "list-step-done" : "" }}">Road Tax & Insurance</li>
                                        <li class="{{ (request('step') > 4)? "list-step-done" : "" }}">Service Record</li>
                                        <li class="{{ (request('step') == 5)? "list-step-done" : "" }}">Finish</li>

                                    </ul>
                                </div>
                                <div class="card-inner">
                                    <div class="align-center gx-3">
                                        <div class="flex-item">
                                            <div class="progress progress-sm progress-pill w-80px">
                                                <div class="progress-bar" data-progress="{{ (request('step')-1)/4*100 }}" style="width: 1%;"></div>
                                            </div>
                                        </div>
                                        <div class="flex-item">
                                            <span class="sub-text sub-text-sm text-soft">{{ (request('step') <= 4)? request('step')-1 : 4 }}/4 Completed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-lg-9">
                            @if(request('step') == 1)
                                <div class="card-inner card-inner-lg h-100">
                                        <x-forms.post :action="route('frontend.user.lorry.insert', ['step' => 1])" class="gy-3">
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="plat_number">Registration Number</label>
                                                        <span class="form-note">To ensure the lorry is not registered yet.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control text-uppercase" type="text" name="plat_number" id="plat_number" placeholder="Ex: PNG1234" value="{{ old('plat_number') }}" required>
                                                            @error('plat_number')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-lg-7 offset-lg-5">
                                                    <div class="form-group mt-2">
                                                        <button type="submit" class="btn btn-lg btn-primary">Check</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </x-forms.post>
                                    </div>
                            @elseif(request('step') == 2)
                                <div class="card-inner card-inner-lg h-100">
                                        <div class="card-head">
                                            <h5 class="card-title">Lorry Information</h5>
                                        </div>
                                        <x-forms.post :action="route('frontend.user.lorry.insert', ['step' => 2])" class="gy-3">
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-name">Registration Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="site-name" value="{{ $lorry->plat_number }}" readonly>
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
                                                            <input class="form-control text-uppercase" type="text" name="no_engine" id="no_engine" placeholder="2H2XAHTL43847556" value="{{ old('no_engine')? old('no_engine') : $lorry->model  }}" required>
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
                                                        <label class="form-label" for="market_price">Market Price  (RM)</label>
                                                        <span class="form-note">Required | Min : 0</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="number" name="market_price" id="market_price" value="{{ old('market_price')? old('market_price') : 0 }}" required>
                                                            @error('market_price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="loan_balance">Loan Balance (RM)</label>
                                                        <span class="form-note">Required | Min : 0 | Or insert 0</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="number" name="loan_balance" id="loan_balance" value="{{ old('loan_balance')? old('loan_balance') : 0 }}" required>
                                                            @error('loan_balance')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="installment_amount">Monthly Installment Amount (RM)</label>
                                                        <span class="form-note">Required | Min : 0</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="number" name="installment_amount" id="installment_amount" value="{{ old('installment_amount')? old('installment_amount') : 0 }}" required>
                                                            @error('installment_amount')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
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
                                                        <button type="submit" class="btn btn-lg btn-primary">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </x-forms.post>
                                    </div>
                            @elseif(request('step') == 3)
                                <div class="card-inner card-inner-lg h-100">
                                        <div class="card-head">
                                            <h5 class="card-title">Road Tax & Insurance</h5>
                                        </div>
                                        <x-forms.post :action="route('frontend.user.lorry.insert', ['step' => 3])" class="gy-3">
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-name">Expired Date</label>
                                                        <span class="form-note">Required</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control date-picker" data-date-format="yyyy/mm/dd" type="text" name="expire_date" id="expire_date" value="{{ old('expire_date') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="roadtax_price">Road Tax Price (RM)</label>
                                                        <span class="form-note">Required | Min : 0</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="number" step="0.10" name="roadtax_price" id="roadtax_price" placeholder="100.00" value="{{ old('roadtax_price') }}" required>
                                                            @error('roadtax_price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label">Road Tax Document</label>
                                                        <span class="form-note">5 MB | Document/Image Format Only</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input type="file"  class="form-control" id="test">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label">Insurance Price(RM)</label>
                                                        <span class="form-note">Required | Min : 0</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="number" step="0.10" name="insurance_price" id="insurance_price" placeholder="2000.00" value="{{ old('insurance_price') }}" required>
                                                            @error('insurance_price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label">Insurance Cover Note</label>
                                                        <span class="form-note">5 MB | Document/Image Format Only</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input type="file"  class="form-control" id="test">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="payment_reference">Payment Reference</label>
                                                        <span class="form-note">Required | Service Invoice/Receipt Number</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="text" name="payment_reference" id="payment_reference" placeholder="SR1321/201112-032" value="{{ old('payment_reference') }}" required>
                                                            @error('payment_reference')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="remark">Remark</label>
                                                        <span class="form-note">Max : 200 Words</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control" rows="3" name="remark" id="remark">{{ old('remark') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-lg-7 offset-lg-5">
                                                    <div class="form-group mt-2">
                                                        <button type="submit" class="btn btn-lg btn-primary">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </x-forms.post>
                                    </div>
                            @elseif(request('step') == 4)
                                <div class="card-inner card-inner-lg h-100">
                                        <div class="card-head">
                                            <h5 class="card-title">Service Record</h5>
                                        </div>
                                        <x-forms.post :action="route('frontend.user.lorry.insert', ['step' => 4])" class="gy-3">
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="next_service">Next Service</label>
                                                        <span class="form-note">Required</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control date-picker" data-date-format="yyyy/mm/dd" type="text" name="next_service" id="next_service" value="{{ old('next_service')? old('next_service') : date('Y/m/d') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="mileage">Current Mileage (ODO Meter)</label>
                                                        <span class="form-note">Required | "0" for broken ODO meter</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="number" step="1" name="mileage" placeholder="120000" id="mileage" value="{{ old('mileage')? old('mileage') : 0 }}" required>
                                                            @error('mileage')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="mileage_next_service">Next Mileage Service (ODO Meter)</label>
                                                        <span class="form-note">Required | "0" for broken ODO meter</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="number" step="1" name="mileage_next_service" placeholder="150000" id="mileage_next_service" value="{{ old('mileage_next_service')? old('mileage_next_service') : 0 }}" required>
                                                            @error('mileage_next_service')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="amount">Amount (RM)</label>
                                                        <span class="form-note">Required | Min : 0</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="number" step="0.10" name="amount" id="amount" value="{{ old('amount')? old('amount') : 0 }}" required>
                                                            @error('amount')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="payment_method">Payment Method</label>
                                                        <span class="form-note">Required</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select name="payment_method" id="payment_method" class="form-select form-control form-control-lg" required>
                                                                @foreach(paymentMethod() as $p_id => $method)
                                                                    <option value="{{ $p_id }}" {{ (old('payment_method') == $p_id)? "selected" : "" }}>{{ $method }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('payment_method')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="payment_reference">Payment Reference</label>
                                                        <span class="form-note">Required | Service Invoice/Receipt Number</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input class="form-control " type="text" name="payment_reference" id="payment_reference" placeholder="SR1321/201112-032" value="{{ old('payment_reference') }}" required>
                                                            @error('payment_reference')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="payment_documents">Upload Receipt</label>
                                                        <span class="form-note">Max : 5MB | Document/Image format Only</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input type="file" name="payment_documents" id="payment_documents" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="remark">Remark</label>
                                                        <span class="form-note">Max : 200 Words</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control" rows="3" name="remark" id="remark">{{ old('remark') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-lg-7 offset-lg-5">
                                                    <div class="form-group mt-2">
                                                        <button type="submit" class="btn btn-lg btn-primary">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </x-forms.post>
                                    </div>
                            @elseif(request('step') == 5)
                                <div class="card-inner card-inner-lg h-100">
                                    <div class="align-center flex-wrap flex-md-nowrap g-3 h-100">
                                        <div class="nk-block-content">
                                            <div class="nk-block-head-content text-center">
                                                <h2 class="nk-block-title fw-normal text-primary">Nice, New lorry registered!</h2>
                                                <div class="nk-block-des">
                                                    <p>Congratulations! <strong class="text-success front-weight-bold">{{ $lorry->plat_number }}</strong> was successfully registered into the system. Please make sure
                                                        all Service, Repair , Renewing Insurance and etc. recorded to this system to help us to calculate & estimate the
                                                        truck profit & expenses.</p>
                                                    <a href="{{ route('frontend.user.lorry.index') }}" class="btn btn-lg btn-primary mt-2">Continue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>

    </div>
@endsection
