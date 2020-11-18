@extends('frontend.layouts.app')

@section('title', __('Lorry'))

@section('content')

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="#">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="">Registration Number</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ request('registration_number') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
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
                                @if($lorry->deleted_at  == null)
                                    <span class="badge badge-dot badge-success">Active</span>
                                @else
                                    <span class="badge badge-dot badge-warning">Inactive</span>
                                @endif
                            </span>
                            </td>
                            <td class="tb-odr-action">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a target="_blank" href="{{ route('frontend.user.lorry.view', $lorry->id) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                    <li><a href="{{ route('frontend.user.lorry.edit', $lorry->id) }}"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                    <li><a href="{{ route('frontend.user.lorry.repair.create', $lorry->id) }}"><em class="icon ni ni-setting"></em><span>Repair</span></a></li>
                                                    <li><a href="{{ route('frontend.user.lorry.service.create', $lorry->id) }}"><em class="icon ni ni-done"></em><span>Service</span></a></li>
                                                    <li><a href="{{ route('frontend.user.lorry.service.create', $lorry->id) }}"><em class="icon ni ni-shield-check"></em><span>Renew Insurance</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-repeat"></em><span>Transaction</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
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
        </div><!-- .card-preview -->
    </div>
@endsection
