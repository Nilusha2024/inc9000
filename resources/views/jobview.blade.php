@extends('layouts.app')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    {{-- header section --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-black-50">Job </h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Job </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- content section --}}
    <section class="content">
        <div class="container-fluid">
            {{-- job view card --}}



            <div>
                <div>
                    @if ($jobactivity['job']['job_status'] == 1)
                        <div class="card-body ps-4 pe-4 pb-4">
                            <div class="d-flex justify-content-center">
                                <div class="card border-dark mb-3 " style="width: 25rem; background: rgba(0, 128, 0, 0.1);">
                                    <div class="card-header">Job No: {{ $jobactivity['job']['job_no'] }}</div>
                                    <div class="card-body text-dark">
                                        <h5 class="card-title">Job Assigned:</h5>
                                        <p class="card-text">{{ $jobactivity['user']['name'] }}</p>
                                        <h5 class="card-title">Client Refernce No.:</h5>
                                        <p class="card-text">{{ $jobactivity['job']['client_reference_no'] }}</p>
                                        <h5 class="card-title">Delivery Date:</h5>
                                        <p class="card-text">{{ $jobactivity['job']['deliver_date'] }}</p>
                                        <h5 class="card-title">Job Title:</h5>
                                        <p class="card-text">{{ $jobactivity['job']['job_title'] }}</p>
                                        <h5 class="card-title">Assigned Department:</h5>
                                        <p class="card-text">{{ $jobactivity['department']['department_name'] }}</p>
                                        <h5 class="card-title">Job Department Status:</h5>
                                        <p class="card-text"></p>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="background: rgba(0, 128, 0, 0.0);">
                                            <option selected>{{ $jobactivity['job']['job_status'] }}</option>
                                            <option value="1">Status 1</option>
                                            <option value="2">Status 2</option>
                                            <option value="3">Status 3</option>
                                          </select>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button type="button" class="btn btn-success">Update</button>
                                            <small class="text-muted">
                                                Active
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-body ps-4 pe-4 pb-4">
                            <div class="d-flex justify-content-center">
                                <div class="card border-dark mb-3 " style="width: 25rem; ">
                                    <div class="card-header">Job No: {{ $jobactivity['job']['job_no'] }}</div>
                                    <div class="card-body text-dark">
                                        <h5 class="card-title">Job Assigned:</h5>
                                        <p class="card-text">{{ $jobactivity['user']['name'] }}</p>
                                        <h5 class="card-title">Client Refernce No.:</h5>
                                        <p class="card-text">{{ $jobactivity['job']['client_reference_no'] }}</p>
                                        <h5 class="card-title">Delivery Date:</h5>
                                        <p class="card-text">{{ $jobactivity['job']['deliver_date'] }}</p>
                                        <h5 class="card-title">Job Title:</h5>
                                        <p class="card-text">{{ $jobactivity['job']['job_title'] }}</p>
                                        <h5 class="card-title">Assigned Department:</h5>
                                        <p class="card-text">{{ $jobactivity['department']['department_name'] }}</p>
                                        <h5 class="card-title">Job Department Status:</h5>
                                        <p class="card-text"></p>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="background: rgba(0, 128, 0, 0.0);">
                                            <option selected>{{ $jobactivity['job']['job_status'] }}</option>
                                            <option value="1">Status 1</option>
                                            <option value="2">Status 2</option>
                                            <option value="3">Status 3</option>
                                          </select>
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button type="button" class="btn btn-success">Update</button>
                                            <small class="text-muted">
                                                Pending
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
@endsection
