@extends('frontend.layouts.app')

@section('title', __('Transaction'))

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block col-md-12">
                    <div class="card card-bordered card-full">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title"><span class="mr-2">Latest Transaction</span></h6>
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

                                @foreach($transactions as $transaction)
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

                               <div class="m-3">
                                   {{ $transactions->links() }}
                               </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
@endsection
