@extends('frontend.layouts.app')

@section('title', __('Lorry'))

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Table head options</h5><span>Similar to tables and dark tables, use the modifier classes <code>.bg-*</code>and  <code>.thead-light</code> to make <code>thead</code> appear light or dark gray.</span>
                </div>
                <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                            <table class="table table-border-vertical">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('Plat Number') }}</th>
                                    <th scope="col">{{ __('Model') }}</th>
                                    <th scope="col">{{ __('Class') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lorries as $key => $lorry)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>{{ $lorry->plat_number }}</td>
                                        <td>{{ $lorry->brand."-".$lorry->model }}</td>
                                        <td>{{ $lorry->class }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
