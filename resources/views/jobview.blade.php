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
            @if ($jobactivity['job']['job_status'] == 1)
            <div class="card-body ps-4 pe-4 pb-4">
                <div class="d-flex justify-content-center">
                    <div class="card border-dark mb-3 bg-gr-mint-light  " style="width: 25rem; ">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                Job No: {{ $jobactivity['job']['job_no'] }} <p class="card-text">
                                    @if ($jobactivity['job']['job_status'] == 0)
                                        <span class="badge badge-info">PENDING</span>
                                    @elseif ($jobactivity['job']['job_status'] == 1)
                                        <span class="badge badge-success">COMPLETE</span>
                                    @elseif ($jobactivity['job']['job_status'] == 2)
                                        <span class="badge badge-warning">ONGOING</span>
                                    @elseif ($jobactivity['job']['job_status'] == 3)
                                        <span class="badge badge-secondary">HOLD</span>
                                    @elseif ($jobactivity['job']['job_status'] == 4)
                                        <span class="badge badge-secondary">NOT READY</span>
                                    @endif
                                </p>
                            </div>
                        </div>
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
                            <p class="card-text">
                                @if ($jobactivity['job']['job_status'] == 0)
                                    PENDING
                                @elseif ($jobactivity['job']['job_status'] == 1)
                                    COMPLETE
                                @elseif ($jobactivity['job']['job_status'] == 2)
                                    ONGOING
                                @elseif ($jobactivity['job']['job_status'] == 3)
                                    HOLD
                                @elseif ($jobactivity['job']['job_status'] == 4)
                                    NOT READY
                                @endif
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($jobactivity['job']['job_status'] == 0)
                                    <form action="{{ route('job.update.status', $jobactivity->job_id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="btn btn-primary bg-gr-blue border-0">Start</button>
                                    </form>
                                @elseif ($jobactivity['job']['job_status'] == 2)
                                    <form action="{{ route('job.complete.status', $jobactivity->job_id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="btn btn-primary bg-gr-blue border-0">Complete</button>
                                    </form>
                                @elseif ($jobactivity['job']['job_status'] == 3)
                                    <form action="{{ route('job.update.status', $jobactivity->job_id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="btn btn-primary bg-gr-blue border-0">Start</button>
                                    </form>
                                @else
                                    <div></div>
                                @endif
                                <small class="text-muted">
                                </small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @elseif ($jobactivity['job']['job_status'] == 2)
                <div class="card-body ps-4 pe-4 pb-4">
                    <div class="d-flex justify-content-center">
                        <div class="card border-dark mb-3 bg-gr-mint-jo  " style="width: 25rem; ">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    Job No: {{ $jobactivity['job']['job_no'] }} <p class="card-text">
                                        @if ($jobactivity['job']['job_status'] == 0)
                                            <span class="badge badge-info">PENDING</span>
                                        @elseif ($jobactivity['job']['job_status'] == 1)
                                            <span class="badge badge-success">COMPLETE</span>
                                        @elseif ($jobactivity['job']['job_status'] == 2)
                                            <span class="badge badge-warning">ONGOING</span>
                                        @elseif ($jobactivity['job']['job_status'] == 3)
                                            <span class="badge badge-secondary">HOLD</span>
                                        @elseif ($jobactivity['job']['job_status'] == 4)
                                            <span class="badge badge-secondary">NOT READY</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
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
                                <p class="card-text">
                                    @if ($jobactivity['job']['job_status'] == 0)
                                        PENDING
                                    @elseif ($jobactivity['job']['job_status'] == 1)
                                        COMPLETE
                                    @elseif ($jobactivity['job']['job_status'] == 2)
                                        ONGOING
                                    @elseif ($jobactivity['job']['job_status'] == 3)
                                        HOLD
                                    @elseif ($jobactivity['job']['job_status'] == 4)
                                        NOT READY
                                    @endif
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($jobactivity['job']['job_status'] == 0)
                                        <form action="{{ route('job.update.status', $jobactivity->job_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-primary bg-gr-blue border-0">Start</button>
                                        </form>
                                    @elseif ($jobactivity['job']['job_status'] == 2)
                                        <form action="{{ route('job.complete.status', $jobactivity->job_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-primary bg-gr-blue border-0">Complete</button>
                                        </form>
                                    @elseif ($jobactivity['job']['job_status'] == 3)
                                        <form action="{{ route('job.update.status', $jobactivity->job_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-primary bg-gr-blue border-0">Start</button>
                                        </form>
                                    @else
                                        <div></div>
                                    @endif
                                    <small class="text-muted">
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
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">

                                    Job No: {{ $jobactivity['job']['job_no'] }} <p class="card-text">
                                        @if ($jobactivity['job']['job_status'] == 0)
                                            <span class="badge badge-info">PENDING</span>
                                        @elseif ($jobactivity['job']['job_status'] == 1)
                                            <span class="badge badge-success">COMPLETE</span>
                                        @elseif ($jobactivity['job']['job_status'] == 2)
                                            <span class="badge badge-warning">ONGOING</span>
                                        @elseif ($jobactivity['job']['job_status'] == 3)
                                            <span class="badge badge-secondary">HOLD</span>
                                        @elseif ($jobactivity['job']['job_status'] == 4)
                                            <span class="badge badge-secondary">NOT READY</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
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
                                <p class="card-text">
                                    @if ($jobactivity['job']['job_status'] == 0)
                                        PENDING
                                    @elseif ($jobactivity['job']['job_status'] == 1)
                                        COMPLETE
                                    @elseif ($jobactivity['job']['job_status'] == 2)
                                        ONGOING
                                    @elseif ($jobactivity['job']['job_status'] == 3)
                                        HOLD
                                    @elseif ($jobactivity['job']['job_status'] == 4)
                                        NOT READY
                                    @endif
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($jobactivity['job']['job_status'] == 0)
                                        <form action="{{ route('job.update.status', $jobactivity->job_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-primary bg-gr-blue border-0">Start</button>
                                        </form>
                                    @elseif ($jobactivity['job']['job_status'] == 2)
                                        <form action="{{ route('job.complete.status', $jobactivity->job_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-primary bg-gr-blue border-0">Complete</button>
                                        </form>
                                    @elseif ($jobactivity['job']['job_status'] == 3)
                                        <form action="{{ route('job.update.status', $jobactivity->job_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-primary bg-gr-blue border-0">Start</button>
                                        </form>
                                        @elseif ($jobactivity['job']['job_status'] == 4)
                                        <form action="{{ route('job.update.status', $jobactivity->job_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-primary bg-gr-blue border-0">Start</button>
                                        </form>
                                    @else
                                        <div></div>
                                    @endif
                                    <small class="text-muted">
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
