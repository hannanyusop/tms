@extends('frontend.layouts.app')

@section('title', __('Renew Insurance'))


@php
    $links = [
    'Lorry' => route('frontend.user.lorry.index'),
    $lorry->model => route('frontend.user.lorry.view', $lorry->id),
];
@endphp

@section('content')
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">Website Setting</h5>
                </div>

                <x-forms.post :action="route('frontend.user.lorry.insurance.insert', $lorry->id)" class="gy-3">

                    <div class="alert alert-light dark" role="alert">
                        <p>Field with  <i class="text-danger">*</i> symbol are required</p>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="plat_number">{{ __('Plat Number') }}</label>
                                <span class="form-note"></span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control text-uppercase" type="text" name="plat_number" value="{{ $lorry->plat_number }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr><h5>Road Tax Information</h5>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="roadtax_price">{{ __('Road Tax Price ') }}<i class="text-danger">*</i></label>
                                <span class="form-note"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control digits" type="number" step=".01" name="roadtax_price" id="roadtax_price" value="{{ old('roadtax_price') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="roadtax_document">{{ __('Road Tax Upload') }}</label>
                                <span class="form-note"></span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control" type="file" name="roadtax_document" id="roatax_document" value="{{ old('roadtax_document') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr><h5>Insurance Information</h5>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="insurance_price">{{ __('Insurance Price') }}</label>
                                <span class="form-note"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control" type="number" step=".01" name="insurance_price" id="insurance_price" value="{{ old('insurance_price') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="insurance_document">{{ __('Insurance Cover Note Upload') }}</label>
                                <span class="form-note"></span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control" type="file" name="insurance_document" id="insurance_document" value="{{ old('insurance_document') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="expire_date">{{ __('New Expire Date') }}<i class="text-danger">*</i></label>
                                <span class="form-note"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control date-picker"  data-date-format="yyyy-mm-dd" type="text" name="expire_date" id="expire_date" value="{{ old('expire_date')  }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="remark">{{ __('Remark') }}</label>
                                <span class="form-note"></span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <textarea name="remark" id="remark" class="form-control" rows="5">{{ old('remark') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary nextBtn pull-right" type="submit">Submit</button>
                </x-forms.post>

            </div>
        </div><!-- card -->
    </div>

@endsection
