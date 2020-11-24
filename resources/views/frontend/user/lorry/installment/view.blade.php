@extends('frontend.layouts.app')

@section('title', __('Installment Record for '. reformatDateTime($date, 'M Y')))




@section('content')

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                        <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Date</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Lorry</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Amount</span></th>
                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Loan Balance</span></th>
                            <th class="nk-tb-col nk-tb-col-tools text-right">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($installments as $installment)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col tb-col-lg">
                                    <span>{{ reformatDateTime($installment->date, 'M Y') }}</span>
                                </td>
                                <td class="nk-tb-col">
                                    <div class="user-card">
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $installment->lorry->plat_number }}<span class="dot dot-success d-md-none ml-1"></span></span>
                                            <span>{{ $installment->lorry->brand." ".$installment->lorry->model }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount">{{ displayPrice($installment->amount) }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ displayPrice($installment->loan_balance) }}</span>
                                </td>
                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        @if(reformatDateTime($installment->date, 'Y-m-1') == date('Y-m-1'))
                                                            <a href="#" data-url="{{ route('frontend.user.lorry.installment.delete', $installment->id) }}" data-message="Are you sure want to delete this Installment Record?"><em class="icon ni ni-trash"></em><span>Delete</span></a>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div><!-- card -->
    </div>
@endsection
@push('after-scripts')
@endpush
