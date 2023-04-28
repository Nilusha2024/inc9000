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
                        <h5>Details for job : {{ $job->id }}</h5>
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
                                    <div class="card-header">
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
                                            <div class="border d-flex justify-content-center align-items-center"
                                                style="width: 100%; border-radius: 20px;">
                                                <img id="job_design_image_view"
                                                    src={{ asset('uploads/jobs/' . $job->job_design_image_1) }}
                                                    width="100%" height="100%" style="border-radius: 20px;"
                                                    alt="design image">
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>

                            {{-- right : info holder --}}
                            <div class="col-sm-8 ps-5">

                                {{-- core info card --}}
                                <div class="card border-0 shadow-none">
                                    <div class="card-header">
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
                                                            <span class="badge badge-warning">PENDING</span>
                                                        @elseif ($job->job_status == 1)
                                                            <span class="badge badge-success">ACTIVE</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Job no :</td>
                                                    <td>{{ $job->job_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Job title :</td>
                                                    <td>{{ $job->job_title }}</td>
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
                                                    <td>Order date :</td>
                                                    <td>{{ $job->order_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Deliver date :</td>
                                                    <td>{{ $job->deliver_date }}</td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- style info card --}}
                        <div class="card border-0 shadow-none">
                            <div class="card-header">
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
                                                <td>{{ $styleDetailRecord->qty }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        {{-- department info card --}}
                        <div class="card border-0 shadow-none">
                            <div class="card-header">
                                <h5>Deparment involvement</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="25%">Department</th>
                                            <th width="25%">Start date</th>
                                            <th width="25%">End date</th>
                                            <th width="25%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($departmentDetailRecords as $departmentDetailRecord)
                                            <tr>
                                                <td>{{ $departmentDetailRecord['department']['department_name'] }}</td>
                                                <td>{{ $departmentDetailRecord->start_date }}</td>
                                                <td>{{ $departmentDetailRecord->end_date }}</td>
                                                <td>
                                                    @if ($departmentDetailRecord->department_status == 0)
                                                        <span class="badge badge-warning">PENDING</span>
                                                    @elseif ($departmentDetailRecord->department_status == 1)
                                                        <span class="badge badge-success">ACTIVE</span>
                                                    @endif
                                                </td>
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
    </section>

    {{-- custom script --}}
    <script>
        // image view
        let img = document.getElementById("job_design_image_view");

        // display the first design image
        function showFirstDesignImage() {
            img.src = "{{ asset('uploads/jobs/' . $job->job_design_image_1) }}";
        }

        // display the second design image
        function showSecondDesignImage() {
            img.src = "{{ asset('uploads/jobs/' . $job->job_design_image_2) }}";
        }
    </script>
@endsection
