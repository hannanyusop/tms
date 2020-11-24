@extends('frontend.layouts.app')

@section('title', __('Create Installment Record '. date('M, Y')))




@section('content')

    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">

                <x-forms.post :action="route('frontend.user.lorry.installment.insert')" class="gy-3">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Lorry Reg. Number</th>
                            <th scope="col">Loan Balance</th>
                            <th scope="col">Monthly Installment</th>
                            <td>Remark</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lorries as $key => $lorry)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $lorry->plat_number }}</td>
                                <td>{{ displayPrice($lorry->loan_balance) }}</td>
                                <td><input type="number" class="form-control" name="amount[{{ $lorry->id }}]" value="{{ old("amount[$lorry->id]")? old("amount[$lorry->id]") : $lorry->installment_amount }}"></td>
                                <td><input type="text" class="form-control" name="remark[{{ $lorry->id }}]" value="{{ old("remark[$lorry->id]")? old("remark[$lorry->id]") : "" }}"></td>

                            </tr>
                        @endforeach($lorries)
                        @empty($lorries)
                            <tr>
                                <td  colspan="4" class="text-center bg-dark-dim">No lorries found!</td>
                            </tr>
                        @endempty
                        </tbody>
                    </table>

                    <div class="mt-3 float-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </x-forms.post>

            </div>
        </div><!-- card -->
    </div>
@endsection
@push('after-scripts')
@endpush
