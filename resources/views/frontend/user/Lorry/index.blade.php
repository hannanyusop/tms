@extends('frontend.layouts.app')

@section('title', __('Lorry'))

@section('content')
    <div class="card">
        <div class="card-header"><div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <div class="pull-right d-flex buttons-right">
                        <div class="right-header">
                            <a href="{{ route('frontend.user.lorry.create', ['step' => 1]) }}" class="btn btn-info">Add Lorry</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="order-history table-responsive">
                <table class="table table-bordernone display" id="basic-1">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Image') }}</th>
                        <th scope="col">{{ __('Plate Number') }}</th>
                        <th scope="col">{{ __('Model') }}</th>
                        <th scope="col">{{ __('Class') }}</th>
                        <th scope="col"><i class="fa fa-angle-down"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lorries as $key => $lorry)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img class="img-fluid img-60" src="{{ asset('assets/images/product/1.png') }}"></td>
                            <td>{{ $lorry->plat_number }}</td>
                            <td>{{ $lorry->brand."-".$lorry->model }}</td>
                            <td>{{ $lorry->class }}</td>
                            <td>
                                <a href="{{ route('frontend.user.lorry.view', $lorry->id) }}" class="btn btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
