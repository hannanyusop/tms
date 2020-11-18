@extends('frontend.layouts.app')

@section('title', __('View Service'))




@section('content')

    <div class="nk-block">
        <div class="invoice">
            <div class="invoice-wrap">
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Lorry Information</span>
                        <div class="invoice-contact-info">
                            <h4 class="title">{{ $service->lorry->plat_number }}</h4>
                            <ul class="list-plain">
                                <li><em class="icon ni ni-truck"></em><span>{{ $service->lorry->brand }} - {{ $service->lorry->model }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="invoice-desc">
                        <h3 class="title">Service</h3>
                        <ul class="list-plain">
                            <li class="invoice-id"><span>Serice ID</span>:<span>{{ $service->id }}</span></li>
                            <li class="invoice-date"><span>Date</span>:<span>{{ reformatDateTime($service->created_at,'d M, Y') }}</span></li>
                            <li class="invoice-date"><span>Current ODO</span>:<span>{{ $service->mileage }} KM</span></li>
                            <li class="invoice-date"><span>Next Service </span>:<span>{{ reformatDateTime($service->next_service,'d M, Y') }}</span></li>
                            <li class="invoice-date"><span>Next Service ODO</span>:<span>{{ $service->mileage_next_service }} KM</span></li>

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
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($service->items as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ displayPrice($item->total_price/$item->qty) }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ displayPrice($item->total_price) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Grand Total</td>
                                <td>{{ displayPrice($service->amount) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="nk-notes ff-italic fs-12px text-soft"><b>Notes:</b> {{ $service->remark }} </div>
                    </div>
                </div><!-- .invoice-bills -->
            </div><!-- .invoice-wrap -->
        </div><!-- .invoice -->
    </div><!-- .nk-block -->

@endsection
@push('after-scripts')
@endpush
