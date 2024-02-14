@extends('layouts.app')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    {{-- header section --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-black-50">Job List</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Job List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- content section --}}
    <section class="content">
        <div class="container-fluid">
            {{-- job view card --}}
            <div class="d-flex justify-content-center">
                <div class="input-group rounded" style="max-width: 25rem;">
                    <input type="search" name="search" id="search" class="form-control rounded" placeholder="Search" />
                </div>
            </div>
            <br>
            <div class="all-data" id="all-data">
                @foreach ($jobs as $job)
                    <a href="{{ route('jobview', ['job' => $job]) }}" style="text-decoration:none">
                        <div class="" id="search-results">
                            @if ($job['department_status'] == 1)
                                <div class="card-body ps-4 pe-4 pb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card mb-3 bg-gr-mint-light" style="width: 25rem;">
                                            <div class="card-header">Job No: {{ $job->job_no }}</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Customer:</h5>
                                                <p class="card-text">{{ $job['client']['first_name'] }}</p>
                                                <h5 class="card-title">Delivery Date:</h5>
                                                <p class="card-text">{{ $job['deliver_date'] }}</p>
                                            </div>
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    @if ($job['department_status'] == 0)
                                                        <span class="badge badge-info">PENDING</span>
                                                    @elseif ($job['department_status'] == 1)
                                                        <span class="badge badge-success">COMPLETE</span>
                                                    @elseif ($job['department_status'] == 2)
                                                        <span class="badge badge-warning">ONGOING</span>
                                                    @elseif ($job['department_status'] == 3)
                                                        <span class="badge badge-secondary">HOLD</span>
                                                    @elseif ($job['department_status'] == 4)
                                                        <span class="badge badge-secondary">NOT READY</span>
                                                    @endif
                                                    </p>
                                                    <button type="button" class="btn btn-primary bg-gr-blue border-0"
                                                        onclick="window.location='{{ route('jobview', ['job' => $job]) }}'">
                                                        View Job
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @elseif ($job['department_status'] == 2)
                                <div class="card-body ps-4 pe-4 pb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card mb-3 bg-gr-mint-jo" style="width: 25rem;">
                                            <div class="card-header">Job No: {{ $job->job_no }}</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Customer:</h5>
                                                <p class="card-text">{{ $job['client']['first_name'] }}</p>
                                                <h5 class="card-title">Delivery Date:</h5>
                                                <p class="card-text">{{ $job['deliver_date'] }}</p>
                                            </div>
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    @if ($job['department_status'] == 0)
                                                        <span class="badge badge-info">PENDING</span>
                                                    @elseif ($job['department_status'] == 1)
                                                        <span class="badge badge-success">COMPLETE</span>
                                                    @elseif ($job['department_status'] == 2)
                                                        <span class="badge badge-warning">ONGOING</span>
                                                    @elseif ($job['department_status'] == 3)
                                                        <span class="badge badge-secondary">HOLD</span>
                                                    @elseif ($job['department_status'] == 4)
                                                        <span class="badge badge-secondary">NOT READY</span>
                                                    @endif
                                                    </p>
                                                    <button type="button" class="btn btn-primary bg-gr-blue border-0"
                                                        onclick="window.location='{{ route('jobview', ['job' => $job]) }}'">
                                                        View Job
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card-body ps-4 pe-4 pb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card mb-3 " style="width: 25rem; ">
                                            <div class="card-header">Job No: {{ $job->job_no }}</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Customer:</h5>
                                                <p class="card-text">{{ $job['client']['first_name'] }}</p>
                                                <h5 class="card-title">Delivery Date:</h5>
                                                <p class="card-text">{{ $job['deliver_date'] }}</p>
                                            </div>
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    @if ($job['department_status'] == 0)
                                                        <span class="badge badge-info">PENDING</span>
                                                    @elseif ($job['department_status'] == 1)
                                                        <span class="badge badge-success">COMPLETE</span>
                                                    @elseif ($job['department_status'] == 2)
                                                        <span class="badge badge-warning">ONGOING</span>
                                                    @elseif ($job['department_status'] == 3)
                                                        <span class="badge badge-secondary">HOLD</span>
                                                    @elseif ($job['department_status'] == 4)
                                                        <span class="badge badge-secondary">NOT READY</span>
                                                    @endif
                                                    </p>
                                                    <button type="button" class="btn btn-primary bg-gr-blue border-0"
                                                        onclick="window.location='{{ route('jobview', ['job' => $job]) }}'">
                                                        View Job
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        </div>
    </section>
    <div class="search-results" id="content"></div>
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $("#search").on('keyup', function() {
        //         $search = $(this).val();
        //         if ($search) {
        //             $('.all-data ').hide();
        //             $('.search-results').show();
        //         } else {
        //             $('.all-data ').show();
        //             $('.search-results').hide();
        //         }

        //         $.ajax({
        //             type: 'get',
        //             url: '{{ URL::to('search') }}',
        //             data: {
        //                 'search': $search
        //             },
        //             success: function(data) {
        //                 $('#content').html(data)
        //             }

        //         });
        //     });
        // });


        $(document).ready(function() {
            $("#search").on('keyup', function() {
                const $search = $(this).val();
                const $allData = $('.all-data');
                const $searchResults = $('.search-results');

                if ($search) {
                    $allData.hide();
                    $searchResults.show();
                } else {
                    $allData.show();
                    $searchResults.hide();
                }

                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('search') }}', 
                    data: {
                        'search': $search
                    },
                    success: function(data) {
                        $('#content').html(data);
                    }
                });
            });
        });
    </script>
@endsection
