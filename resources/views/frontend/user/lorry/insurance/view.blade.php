@extends('frontend.layouts.app')

@section('title', __('View Insurance'))




@section('content')

    <div class="nk-block">
        <div class="invoice">
            <div class="invoice-wrap">
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Lorry Information</span>
                        <div class="invoice-contact-info">
                            <h4 class="title">{{ $insurance->lorry->plat_number }}</h4>
                            <ul class="list-plain">
                                <li><em class="icon ni ni-truck"></em><span>{{ $insurance->lorry->brand }} - {{ $insurance->lorry->model }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="invoice-desc">
                        <h3 class="title">Insurance</h3>
                        <ul class="list-plain">
                            <li class="invoice-id"><span>Insurance ID</span>:<span>{{ $insurance->id }}</span></li>
                            <li class="invoice-date"><span>Date</span>:<span>{{ reformatDateTime($insurance->created_at,'d M, Y') }}</span></li>
                            <li class="invoice-date"><span>Expire Date </span>:<span>{{ reformatDateTime($insurance->expire_date,'d M, Y') }}</span></li>

                        </ul>
                    </div>
                </div><!-- .invoice-head -->
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Description</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Insurance</td>
                                <td>{{ displayPrice($insurance->insurance_price) }}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Road Tax</td>
                                <td>{{ displayPrice($insurance->roadtax_price) }}</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan=""></td>
                                <td colspan=""></td>
                                <td>Grand Total : {{ displayPrice($insurance->amount) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="nk-notes ff-italic fs-12px text-soft"><b>Notes:</b> {{ $insurance->remark }} </div>
                    </div>
                </div><!-- .invoice-bills -->
            </div><!-- .invoice-wrap -->
        </div><!-- .invoice -->
    </div><!-- .nk-block -->

@endsection
@push('after-scripts')
@endpush
