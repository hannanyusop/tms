@extends('frontend.layouts.app')

@section('title', __('FAQ'))

@section('content')
    <div class="nk-block">
        <h5 class="title text-primary">General Question</h5>
        <p>You can find general answer here.</p>
        <div id="faq-gq" class="accordion">
            <div class="accordion-item">
                <a href="#" class="accordion-head" data-toggle="collapse" data-target="#faq-gq-1" aria-expanded="true">
                    <h6 class="title">What is {{ env('APP_NAME') }}?</h6>
                    <span class="accordion-icon"></span>
                </a>
                <div class="accordion-body collapse show" id="faq-gq-1" data-parent="#faq-gq" style="">
                    <div class="accordion-inner">
                        <p>
                            Lorry Management System(LMS) is a web based system to monitor every lorry income and expenses.
                        </p>
                    </div>
                </div>
            </div><!-- .accordion-item -->
            <div class="accordion-item">
                <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#faq-gq-2">
                    <h6 class="title">How to register lorry?</h6>
                    <span class="accordion-icon"></span>
                </a>
                <div class="accordion-body collapse" id="faq-gq-2" data-parent="#faq-gq">
                    <div class="accordion-inner">
                        <p>
                            To register lorry user need to know the lorry information such as :
                        </p>
                        <ul class="list list-checked ml-5">
                            <li>Registration Number/ Plat Number </li>
                            <li>Model</li>
                            <li>Brand</li>
                            <li>Chassis Number</li>
                            <li>Engine Number</li>
                            <li>Etc . . .</li>

                        </ul>
                        <p>
                            All the above information can be found on lorry's green card. User need to provide correct data to
                            ensure the system's function runs smoothly.
                        </p>
                    </div>
                </div>
            </div><!-- .accordion-item -->
            <div class="accordion-item">
                <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#faq-gq-3">
                    <h6 class="title">Service & Maintenance module</h6>
                    <span class="accordion-icon"></span>
                </a>
                <div class="accordion-body collapse" id="faq-gq-3" data-parent="#faq-gq">
                    <div class="accordion-inner">
                        <p>
                            Service & maintenance is routine proses to make sure the lorry runs in a good condition.
                        </p>
                        <p>
                            When inserting Service & Maintenance record, please make sure user inserting the correct "Next Service Date".
                            All Service & maintenance  will be recorded as a <b>Lorry Expenses</b>
                        </p>
                    </div>
                </div>
            </div><!-- .accordion-item -->
            <div class="accordion-item">
                <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#faq-gq-5">
                    <h6 class="title">Repair Module</h6>
                    <span class="accordion-icon"></span>
                </a>
                <div class="accordion-body collapse" id="faq-gq-5" data-parent="#faq-gq">
                    <div class="accordion-inner">
                        <p>
                            User need to record every time the lorry is repaired.
                        </p>

                        <p>All repair record will be inserted as lorry's expenses </p>
                    </div>
                </div>
            </div><!-- .accordion-item -->
            <div class="accordion-item">
                <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#faq-gq-6">
                    <h6 class="title">Monthly Installment Module</h6>
                    <span class="accordion-icon"></span>
                </a>
                <div class="accordion-body collapse" id="faq-gq-6" data-parent="#faq-gq">
                    <div class="accordion-inner">
                        <p>
                            When registering the lorry, user need to insert the "Loan Balance (RM)" & "Monthly Installment Amount (RM)" with correct data.<br>
                            If the lorry is fully paid/cash you need to insert the above value as "0". So the lorry will not listed on monthly installment.
                        </p>

                        <p>
                            User need to generate/create this record monthly.
                        </p>

                        <p>You still can adjust the amount og installment before you submit the Installment record.</p>

                        <p class="font-weight-bold text-danger">
                            The previous month record can't be deleted!
                        </p>

                        <p class="">
                            All installment record will be inserted as lorry's expenses.
                        </p>

                    </div>
                </div>
            </div><!-- .accordion-item -->
        </div><!-- .accordion -->
    </div>
@endsection
@push('after-scripts')
@endpush
