@extends('frontend.layouts.app')

@section('title', __('Lorry'))

@section('content')

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <table class="table table-orders">
                <thead class="tb-odr-head">
                <tr class="tb-odr-item">
                    <th class="tb-odr-info">
                        <span class="tb-odr-id">Plat Number</span>
                        <span class="tb-odr-date d-none d-md-inline-block">Model</span>
                    </th>
                    <th class="tb-odr-amount">
                        <span class="tb-odr-total">Class</span>
                        <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                    </th>
                    <th class="tb-odr-action">&nbsp;</th>
                </tr>
                </thead>
                <tbody class="tb-odr-body">
                @foreach($lorries as $key => $lorry)
                    <tr class="tb-odr-item">
                    <td class="tb-odr-info text-uppercase">
                        <span class="tb-odr-id"><a href="#">{{ $lorry->plat_number }}</a></span>
                        <span class="tb-odr-date">{{ $lorry->brand."-".$lorry->model }}</span>
                    </td>
                    <td class="tb-odr-amount">
                        <span class="tb-odr-total">
                            <span class="amount">{{ $lorry->class }}</span>
                        </span>
                        <span class="tb-odr-status">
                            <span class="badge badge-dot badge-warning">Pending</span>
                        </span>
                    </td>
                    <td class="tb-odr-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li><a href="{{ route('frontend.user.lorry.view', $lorry->id) }}" class="text-primary">View</a></li>
                                    <li><a href="{{ route('frontend.user.lorry.view', $lorry->id) }}" class="text-primary">Edit</a></li>
                                    <li><a href="#" class="text-danger">Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- .card-preview -->
    </div>
@endsection
