@extends('frontend.layouts.app')

@section('title', __('Service Record'))


@php
    $links = [
    'Lorry' => route('frontend.user.lorry.index'),
    $lorry->model => route('frontend.user.lorry.view', $lorry->id),
];
@endphp

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <x-forms.post :action="route('frontend.user.lorry.service.insert', $lorry->id)">
                        <div class="">

                            <div class="alert alert-light dark" role="alert">
                                <p>Field with  <i class="text-danger">*</i> symbol are required</p>
                            </div>
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
                            <hr><h5>Road Tax Information</h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="roadtax_price">{{ __('Road Tax Price ') }}<i class="text-danger">*</i></label>
                                        <div class="col-sm-3">
                                            <input class="form-control digits" type="number" step=".01" name="roadtax_price" id="roadtax_price" value="{{ old('roadtax_price') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="roadtax_document">{{ __('Road Tax Upload') }}</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="file" name="roadtax_document" id="roatax_document" value="{{ old('roadtax_document') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr><h5>Insurance Information</h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="insurance_price">{{ __('Insurance Price') }}<i class="text-danger">*</i></label>
                                        <div class="col-sm-3">
                                            <input class="form-control digits" type="number" step=".01" name="insurance_price" id="insurance_price" value="{{ old('insurance_price') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="insurance_document">{{ __('Insurance Cover Note Upload') }}</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="file" name="insurance_document" id="insurance_document" value="{{ old('insurance_document') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="expire_date">{{ __('New Expire Date') }}<i class="text-danger">*</i></label>
                                        <div class="col-sm-3">
                                            <input class="form-control digits" type="date" name="expire_date" id="expire_date" value="{{ old('expire_date')  }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="class">{{ __('Remark') }}</label>
                                        <div class="col-sm-5">
                                            <textarea name="remark" id="remark" class="form-control" rows="5">{{ old('remark') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary nextBtn pull-right" type="submit">Submit</button>

                    </x-forms.post>
                </div>
            </div>
        </div>
    </div>
@endsection
