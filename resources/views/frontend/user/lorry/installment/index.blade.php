@extends('frontend.layouts.app')

@section('title', __('Installment Record'))




@section('content')

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <div class=" float-right mb-2">
                    <a href="{{ route('frontend.user.lorry.installment.create') }}" class="btn btn-success">Create Installment for {{ date('M Y') }}</a>
                </div>

            </div>
        </div><!-- card -->
        <div class="card card-bordered">
            <div class="card-inner">
                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                        <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Date</span></th>
                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Total Record</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Amount</span></th>
                            <th class="nk-tb-col nk-tb-col-tools text-right">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as  $key => $installment)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col tb-col-lg">
                                    <span>{{ reformatDateTime($key, 'M Y') }}</span>

                                    @php
                                        $collect = collect($installment);
                                    @endphp
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount">{{ $collect->count() }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount">{{ displayPrice($collect->sum('amount')) }}</span>
                                </td>
                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="{{ route('frontend.user.lorry.installment.view', $key) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
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
