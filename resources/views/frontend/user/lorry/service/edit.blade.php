@extends('frontend.layouts.app')

@section('title', __('Edit Service Record #').$service->id)


@php
    $links = [
    'Lorry' => route('frontend.user.lorry.index'),
    $service->lorry->model => route('frontend.user.lorry.view', $service->lorry->id),
];
@endphp

@section('content')
    <div class="nk-block nk-block-lg col-md-8 offset-md-2">
        <div class="card card-bordered">
            <div class="card-inner">
                <x-forms.post :action="route('frontend.user.lorry.service.insert', $service->id)" class="gy-3">
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
                                    <input class="form-control text-uppercase" type="text" id="plat_number" name="plat_number" value="{{ $service->lorry->plat_number }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr><h5>Service Information</h5>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="next_service">{{ __('Next Service') }}<i class="text-danger">*</i></label>
                                <span class="form-note">Required</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" data-language="en" aria-describedby="basic-addon2" name="next_service" id="next_service" value="{{ old('next_service')? old('next_service') : $service->next_service }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="mileage">{{ __('Current Mileage') }} (ODO Meter)<i class="text-danger">*</i></label>
                                <span class="form-note">Required | Use "0" for broken ODO meter</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control digits" type="number" name="mileage" id="mileage" value="{{ old('mileage')? old('mileage') : $service->mileage  }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="mileage_next_service">{{ __('Next Service Mileage') }} (ODO Meter)<i class="text-danger">*</i></label>
                                <span class="form-note">Required | Use "0" for broken ODO meter</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control digits" type="number" name="mileage_next_service" id="mileage_next_service" value="{{ old('mileage_next_service')? old('mileage_next_service') : $service->mileage_next_service }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <option value="{{ $key }}" {{ (old('payment_method') == $key)? "selected" : ($service->payment_method == $key)? "selected" : "" }}>{{ $method }}</option>
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
                                    <input class="form-control" type="text" name="payment_reference" id="payment_reference" value="{{ old('payment_reference')? old('payment_reference') : $service->payment_reference }}">
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
                                    <textarea name="remark" id="remark" class="form-control" rows="5">{{ old('remark') ? old('remark') : $service->remark }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr><h5>Items</h5>
                    <div class="">
                        <div id="table" class="table-editable">
                            <button type="button" class="table-add btn btn-success mb-2 float-right"><em class="icon ni ni-plus-medi"></em> Add Items</button>
                            <table class="table">
                                <tr>
                                    <th>Item</th>
                                    <th>Remark</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th data-attr-ignore>Remove</th>
                                </tr>

                                @if(old('name'))
                                    @foreach(old('name') as $key => $name)
                                        <tr class="{{ ($key == 0 )? "hide" : "" }}">
                                            <td><input type="text" class="form-control" value="{{ old('name')[$key] }}" name="name[]" required></td>
                                            <td><textarea class="form-control"  name="description[]">{{ old('description')[$key]}}</textarea> </td>
                                            <td><input type="number" class="form-control" name="qty[]" value="{{ old('qty')[$key] }}" required></td>
                                            <td><input type="number" step="1" class="form-control" value="{{ old('price')[$key] }}" name="price[]"></td>
                                            <td class="text-center">
                                                <em class="table-remove icon ni ni-cross text-danger font-weight-bold"></em>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="hide">
                                        <td><input type="text" class="form-control" name="name[]" required></td>
                                        <td><textarea class="form-control" name="description[]"></textarea> </td>
                                        <td><input type="number" class="form-control" name="qty[]" value="1" required></td>
                                        <td><input type="number" step="1" class="form-control" value="0.00" name="price[]"></td>
                                        <td class="text-center">
                                            <em class="table-remove icon ni ni-cross text-danger font-weight-bold"></em>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <a href="{{ route('frontend.user.lorry.view', $service->lorry->id) }}" class="btn btn-warning pull-right mt-5" type="submit">Back</a>
                    <button class="btn btn-primary pull-right mt-5" type="submit">Submit</button>

                </x-forms.post>
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
