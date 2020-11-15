@extends('frontend.layouts.app')

@section('title', __('New Repair Record'))


@php
    $links = [
    'Lorry' => route('frontend.user.lorry.index'),
    $lorry->model => route('frontend.user.lorry.view', $lorry->id),
];
@endphp

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <x-forms.post :action="route('frontend.user.lorry.repair.insert', $lorry->id)">
                        <div class="">

                            <div class="alert alert-light dark" role="alert">
                                <p>Field with  <i class="text-danger">*</i> symbol are required</p>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">{{ __('Plat Number') }}</label>
                                        <div class="col-sm-5">
                                            <input class="form-control text-uppercase" type="text" name="plat_number" value="{{ $lorry->plat_number }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr><h5>Repair & Maintenance Information</h5>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="payment_method">{{ __('Payment Method') }}<i class="text-danger">*</i></label>
                                        <div class="col-sm-3">
                                            <select name="payment_method" id="payment_method" class="form-control" required>
                                                @foreach(paymentMethod() as $key => $method)
                                                    <option value="{{ $key }}" {{ (old('payment_method') == $key)? "selected" : "" }}>{{ $method }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="payment_reference">{{ __('Receipt Number(Ref. Number)') }}<i class="text-danger">*</i></label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="text" name="payment_reference" id="payment_reference" value="{{ old('payment_reference') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="payment_documents">{{ __('Receipt Upload') }}</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="file" name="payment_documents" id="payment_documents" value="{{ old('payment_documents') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="class">{{ __('Remark') }}</label>
                                        <div class="col-sm-5">
                                            <textarea name="remark" id="remark" class="form-control" rows="5">{{ old('remark') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr><h5>Items</h5>
                            <div class="">
                                <div id="table" class="table-editable">
                                    <button type="button" class="table-add btn btn-success mb-2 float-right"><i class="fa fa-plus"></i> Add Items</button>
                                    <table class="table">
                                        <tr>
                                            <th>Item</th>
                                            <th>Remark</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                            <th data-attr-ignore>Remove</th>
                                        </tr>

                                        @if(old('name'))
                                            @foreach(old('name') as $key => $name)
                                                <tr class="{{ ($key == 0 )? "hide" : "" }}">
                                                    <td><input type="text" class="form-control" value="{{ old('name')[$key] }}" name="name[]" required></td>
                                                    <td><textarea class="form-control"  name="description[]">{{ old('description')[$key]}}</textarea> </td>
                                                    <td><input type="number" class="form-control" name="qty[]" value="{{ old('qty')[$key] }}" required></td>
                                                    <td><input type="number" step="1" class="form-control" value="{{ old('price')[$key] }}" name="price[]"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <i class="table-remove fa fa-times text-danger"></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="hide">
                                                <td><input type="text" class="form-control" name="name[]" required></td>
                                                <td><textarea class="form-control" name="description[]"></textarea> </td>
                                                <td><input type="number" class="form-control" name="qty[]" value="1" required></td>
                                                <td><input type="number" step="1" class="form-control" value="0.00" name="price[]"></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <i class="table-remove fa fa-times text-danger"></i>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary nextBtn pull-right mt-5" type="submit">Submit</button>

                    </x-forms.post>
                </div>
            </div>
        </div>
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
