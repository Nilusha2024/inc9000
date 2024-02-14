@extends('layouts.app')

@section('content')
{{-- header section --}}
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="text-black-50">Manage jobs</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Jobs</li>
                    <li class="breadcrumb-item active">Job details</li>
                </ol>
            </div>
        </div>
    </div>
</section>

{{-- content section --}}
<section class="content">
    <div class="container-fluid">
        {{-- job view table card --}}
        <div class="card shadow-lg mb-3" style="border-radius: 25px; ">
            <div class="card-header m-3 mb-0" style="background-color: transparent;">
                <div class="d-flex justify-content-between">
                    <h5>Details for job : {{ $job->job_title }}</h5>

                    <div class="w-auto">
                        <!-- <a style="text-decoration: none" href="{{ route('job_details_report', ['job' => $job]) }}" class="btn-primary btn-sm btn-flat" style="width: 100%">DOWNLOAD AS PDF</a>        -->
                        <input type="button" href="{{ route('job_details_report', ['job' => $job]) }}" value="print"
                            class="btn btn-lg btn-primary  print-window" onclick="printpdfd()">
                    </div>

                </div>
            </div>
            <div class="card-body ps-4 pe-4 pb-4">

                {{-- elements go here : --}}

                <div class="col-sm-12">

                    {{-- 1st row --}}
                    <div class="row mb-4">

                        {{-- left : image holder --}}
                        <div class="col-sm-4">

                            <div class="card border-0 shadow-none" style="height: 100%;">
                                <div class="card-header" style="background-color: transparent;">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5>Design images</h5>
                                        </div>
                                        <div>
                                            <button class="btn btn-dark btn-sm text-bold"
                                                onclick="showFirstDesignImage()">1</button>
                                            <button class="btn btn-dark btn-sm text-bold"
                                                onclick="showSecondDesignImage()">2</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="d-flex" style="height: 100%;">
                                        <div class="border justify-content-center align-items-center"
                                            style="width: 100%; border-radius: 20px;">

                                            @if ($job->job_design_image_1 != null)
                                            <img id="job_design_image_view" class="popup" src={{ asset('uploads/jobs/' .
                                                $job->job_design_image_1) }}
                                            style="border-radius: 20px;width: 100%; height:auto; vertical-align :top "
                                            alt="design image">
                                            @else
                                            <img id="job_design_image_view" class="popup" src={{
                                                asset('image/design-empty-placeholder.png') }}
                                                style="border-radius: 20px; width: 100%;height:auto; vertical-align :top"
                                                alt="design image">
                                            @endif

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        {{-- right : info holder --}}
                        <div class="col-sm-8 ps-5">

                            {{-- core info card --}}
                            <div class="card border-0 shadow-none">
                                <div class="card-header" style="background-color: transparent;">
                                    <h5>Info</h5>
                                </div>
                                <div class="card-body">

                                    {{-- core info table --}}
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Status :</td>
                                                <td>
                                                    @if ($job->job_status == 0)
                                                    <span class="badge badge-info">PENDING</span>
                                                    @elseif ($job->job_status == 1)
                                                    <span class="badge badge-success">COMPLETE</span>
                                                    @elseif ($job->job_status == 2)
                                                    <span class="badge badge-warning">ONGOING</span>
                                                    @elseif ($job->job_status == 3)
                                                    <span class="badge badge-secondary">HOLD</span>
                                                    @elseif ($job->job_status == 4)
                                                    <span class="badge badge-danger">NOT READY</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Job no :</td>
                                                <td>{{ $job->job_no }}</td>
                                            </tr>
                                            <tr>
                                                <td>For client :</td>
                                                <td>{{ $job['client']['first_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Client reference no :</td>
                                                <td>{{ $job->client_reference_no }}</td>
                                            </tr>
                                            <tr>
                                                <td>Material option :</td>
                                                <td>{{ $job->material_option }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sleeve details :</td>
                                                <td>{{ $job->sleeve_details }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sleeve remarks :</td>
                                                <td>{{ $job->sleeve_remarks }}</td>
                                            </tr>
                                            <tr>
                                                <td>Order date :</td>
                                                <td>{{ $job->order_date->toDateString() }}</td>
                                            </tr>
                                            <tr>
                                                <td>Deliver date :</td>
                                                <td>{{ $job->deliver_date->toDateString() }}</td>
                                            </tr>
                                            <tr>
                                                <td>T-shirt details :</td>
                                                <td>{{ $job->tshirt_details }}</td>
                                            </tr>
                                            <tr>
                                                <td>Short details :</td>
                                                <td>{{ $job->short_details }}</td>
                                            </tr>
                                            <tr <?php if (!empty($job->special_note)) {
                                                echo 'style="background-color: red;"';
                                                } ?>>
                                                <td>Special note :</td>
                                                <td>{{ $job->special_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>Logo and number :</td>
                                                <td>{{ $job->logo_and_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Size label details :</td>
                                                <!-- Use the null coalescing operator to provide a default value -->
                                                <td>{{ ($job->size_label_details !== null && $job->size_label_details !== 'null') ? $job->size_label_details : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pattern :</td>
                                                <td>{{ $job->pattern }}</td>
                                            </tr>
                                            <tr>
                                                <td>Packing :</td>
                                                <td>{{ $job->packing }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Reference document :</td>
                                                <td>
                                                    @if ($job->job_reference_document)
                                                    <a href="{{ asset('uploads/jobs/' . $job->job_reference_document) }}"
                                                        class="border-0 btn font-weight-bold bg-gr-green">DOWNLOAD
                                                        <span class="fas fa-download"></span></a>
                                                    @else
                                                    <button disabled
                                                        class="border-0 btn font-weight-bold bg-gr-crimson text-light">NOT
                                                        PROVIDED</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Assigned Designer :</td>
                                                @if ($job->assignedDesigner)
                                                <td>{{ $job->assignedDesigner->name }}</td>
                                                @else
                                                <td style="color: red;">Designer not yet assigned</td>
                                                @endif
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- style info card --}}
                    <div class="card border-0 shadow-none">
                        <div class="card-header" style="background-color: transparent;">
                            <h5>Styles</h5>
                        </div>
                        <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Design</th>
                                        <th>Sleeve</th>
                                        <th>Neck type</th>
                                        <th>Size</th>
                                        <th>remarks</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($styleDetailRecords as $styleDetailRecord)
                                    <tr>
                                        <td>{{ $styleDetailRecord->category }}</td>
                                        <td>{{ $styleDetailRecord->design }}</td>
                                        <td>{{ $styleDetailRecord->sleeve }}</td>
                                        <td>{{ $styleDetailRecord->neck_type }}</td>
                                        <td>{{ $styleDetailRecord->size }}</td>
                                        <td>{{ $styleDetailRecord->remarks }}</td>
                                        <td>{{ $styleDetailRecord->qty }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5"></td>
                                        <td class="font-weight-bold">Sub total:</td>
                                        <td class="font-weight-bold">{{ $styleSubTotal }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    {{-- summary of style --}}
                    <div>
                        <h3>Summary of Style</h3>

                        @foreach ($summaryOfStyle as $category => $categoryRecords)
                        <h4>{{ $category }}</h4>

                        @foreach ($categoryRecords as $design => $designRecords)
                        <h5>{{ $design }}</h5>

                        @foreach ($designRecords as $sleeve => $sleeveRecords)
                        <h6>{{ $sleeve }}</h6>

                        @foreach ($sleeveRecords as $neckType => $records)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Design</th>
                                    <th>Sleeve</th>
                                    <th>Neck type</th>
                                    <th>Size</th>
                                    <th>Remarks</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalQty = 0;
                                @endphp

                                @foreach ($records as $record)
                                <tr>
                                    <td>{{ $record->category }}</td>
                                    <td>{{ $record->design }}</td>
                                    <td>{{ $record->sleeve }}</td>
                                    <td>{{ $record->neck_type }}</td>
                                    <td>{{ $record->size }}</td>
                                    <td>{{ $record->remarks }}</td>
                                    <td>{{ $record->qty }}</td>
                                </tr>
                                @php
                                $totalQty += $record->qty;
                                @endphp
                                @endforeach

                                <tr>
                                    <th colspan="5"></th>
                                    <th class="font-weight-bold">Sub total:</th>
                                    <th class="font-weight-bold">{{ $totalQty }}</th>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach
                        @endforeach
                        @endforeach
                        @endforeach
                    </div>




                    {{-- department info card --}}
                    <div class="card border-0 shadow-none">
                        <div class="card-header" style="background-color: transparent;">
                            <h5>Deparment involvement</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Start date</th>
                                        <th>Actual start date & time</th>
                                        <th>End date</th>
                                        <th>Actual end date & time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departmentDetailRecords as $departmentDetailRecord)
                                    <tr>
                                        <td>{{ $departmentDetailRecord['department']['department_name'] }}</td>
                                        <td>{{ $departmentDetailRecord->start_date->toDateString() }}</td>
                                        <td>
                                            @if ($departmentDetailRecord->actual_start_date == null)
                                            Not recorded
                                            @else
                                            {{ $departmentDetailRecord->actual_start_date->format('Y-m-d h:i A') }}
                                            @endif
                                        </td>
                                        <td>{{ $departmentDetailRecord->end_date->toDateString() }}</td>
                                        <td>
                                            @if ($departmentDetailRecord->actual_end_date == null)
                                            Not recorded
                                            @else
                                            {{ $departmentDetailRecord->actual_end_date->format('Y-m-d h:i A') }}
                                            @endif
                                        </td>
                                        </td>
                                        <td>
                                            @if ($departmentDetailRecord->department_status == 0)
                                            <span class="badge badge-info">PENDING</span>
                                            @elseif ($departmentDetailRecord->department_status == 1)
                                            <span class="badge badge-success">COMPLETE</span>
                                            @elseif ($departmentDetailRecord->department_status == 2)
                                            <span class="badge badge-warning">ONGOING</span>
                                            @elseif ($departmentDetailRecord->department_status == 3)
                                            <span class="badge badge-secondary">HOLD</span>
                                            @elseif ($departmentDetailRecord->department_status == 4)
                                            <span class="badge badge-danger">NOT READY</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    {{-- other comments card --}}
                    <div class="card border-0 shadow-none">
                        <div class="card-header" style="background-color: transparent;">
                            <h5>Comments</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $job->comment }}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>

{{-- image popup modal --}}
<div class="modal fade bd-example-modal-lg" id="design_img_popup_modal" tabindex="-1" role="dialog"
    aria-labelledby="design_img_popup_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <img id="design_img_popup" src="" alt="image">
        </div>
    </div>
</div>

{{-- custom script --}}
<script>
    // $('.print-window').click(function() {
    //     window.print();
    // });
    // design image popup
    $(".popup").click(function (e) {
        e.preventDefault();
        let src = $(this).attr('src');
        $(".modal").modal('show');
        $("#design_img_popup").attr('src', src);
    });

    // image view
    let img = document.getElementById("job_design_image_view");

    // display the first design image
    function showFirstDesignImage() {
        if ("{{ $job->job_design_image_1 != null }}") {
            img.src = "{{ asset('uploads/jobs/' . $job->job_design_image_1) }}";
        } else {
            img.src = "{{ asset('image/design-empty-placeholder.png') }}";
        }

    }

    // display the second design image
    function showSecondDesignImage() {
        if ("{{ $job->job_design_image_2 != null }}") {
            img.src = "{{ asset('uploads/jobs/' . $job->job_design_image_2) }}";
        } else {
            img.src = "{{ asset('uploads/jobs/image/design-empty-placeholder.png') }}";
        }

    }

    function printpdfd() {
        // Open a new window with the PDF URL
        var pdfUrl = "{{ route('job_details_report', ['job' => $job]) }}";
        var printWindow = window.open(pdfUrl, '_blank');

        // Check if the window is opened successfully
        if (printWindow) {
            // Wait for the window to be fully loaded
            printWindow.onload = function () {
                // Trigger the print dialog
                printWindow.print();
            };
        } else {
            // Handle the case where the window couldn't be opened
            alert('Failed to open print window. Please ensure pop-ups are allowed.');
        }
    }
</script>
@endsection