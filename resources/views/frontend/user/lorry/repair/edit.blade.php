@extends('frontend.layouts.app')

@section('title', __('Edit Repair Record #').$repair->id)


@php
    $links = [
    'Lorry' => route('frontend.user.lorry.index'),
    $repair->lorry->model => route('frontend.user.lorry.view', $repair->lorry->id),
];
@endphp

@section('content')
    <div class="nk-block nk-block-lg col-md-12">
        <div class="card card-bordered">
            <div class="card-inner">
                <x-forms.post :action="route('frontend.user.lorry.repair.insert', $repair->id)" class="gy-3">
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="plat_number">{{ __('Plat Number') }}</label>
                                <span class="form-note"></span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control text-uppercase" type="text" id="plat_number" name="plat_number" value="{{ $repair->lorry->plat_number }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr><h5>Repair Information</h5>


                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="payment_method">{{ __('Payment Method') }}<i class="text-danger">*</i></label>
                                <span class="form-note">Required</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select name="payment_method" id="payment_method" class="form-select form-control form-control-lg" required>
                                        @foreach(paymentMethod() as $key => $method)
                                            <option value="{{ $key }}" {{ (old('payment_method') == $key)? "selected" : ($repair->payment_method == $key)? "selected" : "" }}>{{ $method }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="payment_reference">{{ __('Receipt Number(Ref. Number)') }}<i class="text-danger">*</i></label>
                                <span class="form-note">Required | Invoice / receipt number</span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control" type="text" name="payment_reference" id="payment_reference" value="{{ old('payment_reference')? old('payment_reference') : $repair->payment_reference }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="site-name">{{ __('Receipt Upload') }}</label>
                                <span class="form-note">Max : 5MB | Document / image format only</span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control" type="file" name="payment_documents" id="payment_documents" value="{{ old('payment_documents') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="remark">{{ __('Remark') }}</label>
                                <span class="form-note">Max : 200 words</span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <textarea name="remark" id="remark" class="form-control" rows="5">{{ old('remark') ? old('remark') : $repair->remark }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary pull-right mt-5" type="submit">Save Repair Information</button>

                </x-forms.post>
            </div>
        </div><!-- card -->

        <div class="card card-bordered">
            <div class="card-inner">
                    <h5>Items</h5>
                    <div class="">
                        <div id="table" class="table-editable">
                            <table class="table">
                                <tr class="text-center">
                                    <th>Item</th>
                                    <th>Remark</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>T. Price</th>
                                    <th data-attr-ignore>Remove</th>
                                </tr>
                                @foreach($repair->items as $item)
                                    <x-forms.post :action="route('frontend.user.lorry.repair.update-item', [$repair->id, $item->id])" class="gy-3">
                                        <tr>
                                            <td><input type="text" class="form-control" name="name" value="{{ $item->name }}" required></td>
                                            <td><input type="text" class="form-control" name="description" value="{{ $item->description }}"></td>
                                            <td><input type="number" class="form-control" name="qty" value="{{ $item->qty }}" required></td>
                                            <td><input type="number" step="1" class="form-control" value="{{ $item->total_price/$item->qty }}" name="price"></td>
                                            <td class="text-center">
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                <a onclick="return confirm('Are you sure want to remove this item from list?')" href="{{ route('frontend.user.lorry.repair.delete-item', [$repair->id, $item->id]) }}" class="btn btn-danger btn-sm">Remove</a>
                                            </td>
                                        </tr>
                                    </x-forms.post>
                                @endforeach
                                <x-forms.post :action="route('frontend.user.lorry.repair.insert-item', $repair->id)" class="gy-3">
                                <tr>
                                        <td><input type="text" class="form-control" name="name" value="{{ old('name') }}" required></td>
                                        <td><input class="form-control" name="description" value="{{ old('description') }}"> </td>
                                        <td><input type="number" class="form-control" name="qty" value="{{ old('qty')? old('qty') : 1  }}" required></td>
                                        <td><input type="number" class="form-control" value="{{ old('price')? old('price') : 0.00  }}" name="price"></td>
                                        <td class="text-center">
                                            <button type="submit" class="btn btn-success">Add</button>
                                        </td>
                                    </tr>
                                </x-forms.post>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                       <h5> {{ displayPrice($repair->amount) }}</h5>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <a href="{{ route('frontend.user.lorry.view', $repair->lorry->id) }}" class="btn btn-warning pull-right mt-5" type="submit">Back</a>
            </div>
        </div><!-- card -->

    </div>
@endsection
@push('after-scripts')
    <script>
        var $TABLE = $('#table');
        var $BTN = $('#export-btn');
        var $EXPORT = $('#export');

        $('.table-add').click(function() {
            var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
            $TABLE.find('table').append($clone);
        });

        $('.table-remove').click(function() {
            $(this).parents('tr').detach();
        });

        $('.table-up').click(function() {
            var $row = $(this).parents('tr');
            if ($row.index() === 1) return; // Don't go above the header
            $row.prev().before($row.get(0));
        });

        $('.table-down').click(function() {
            var $row = $(this).parents('tr');
            $row.next().after($row.get(0));
        });

        // A few jQuery helpers for exporting only
        jQuery.fn.pop = [].pop;
        jQuery.fn.shift = [].shift;

        $BTN.click(function() {
            var $rows = $TABLE.find('tr:not(:hidden)');
            var headers = [];
            var data = [];

            // Get the headers (add special header logic here)
            $($rows.shift()).find('th:not(:empty):not([data-attr-ignore])').each(function() {
                headers.push($(this).text().toLowerCase());
            });

            // Turn all existing rows into a loopable array
            $rows.each(function() {
                var $td = $(this).find('td');
                var h = {};

                // Use the headers from earlier to name our hash keys
                headers.forEach(function(header, i) {
                    h[header] = $td.eq(i).text(); // will adapt for inputs if text is empty
                });

                data.push(h);
            });

            // Output the result
            $EXPORT.text(JSON.stringify(data));
        });
    </script>
@endpush
