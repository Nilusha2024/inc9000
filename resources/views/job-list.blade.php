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
                    <!--
                                                    <span class="input-group-text border-0" id="search-addon">
                                                        <i class="fas fa-search"></i>
                                                    </span> -->
                </div>
            </div>
            <div class="all-data" id="all-data">
                @foreach ($jobs as $job)
                    <a href="./jobview/{{ $job->id }}">
                        <div class="" id="search-results">
                            @if ($job['job_status'] == 1)
                            <div class="card-body ps-4 pe-4 pb-4">
                                <div class="d-flex justify-content-center">
                                    <div class="card border-dark mb-3 "
                                        style="width: 25rem; background: rgba(0, 128, 0, 0.1);">
                                        <div class="card-header">Job No: {{ $job->job_no }}</div>
                                        <div class="card-body text-dark">
                                            <h5 class="card-title">Customer:</h5>
                                            <p class="card-text">{{ $job['client']['first_name'] }}</p>
                                            <h5 class="card-title">Delivery Date:</h5>
                                            <p class="card-text">{{ $job['deliver_date'] }}</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    Active
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </a>
                    @else
                    <a href="./jobview/{{ $job->id }}">
                        <div class="card-body ps-4 pe-4 pb-4">
                            <div class="d-flex justify-content-center">
                                <div class="card border-dark mb-3 " style="width: 25rem; ">
                                    <div class="card-header">Job No: {{ $job->job_no }}</div>
                                    <div class="card-body text-dark">
                                        <h5 class="card-title">Customer:</h5>
                                        <p class="card-text">{{ $job['client']['first_name'] }}</p>
                                        <h5 class="card-title">Delivery Date:</h5>
                                        <p class="card-text">{{ $job['deliver_date'] }}</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                Pending
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
            @endforeach
        </div>
        <div class="search-results" id="content"></div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#search").on('keyup', function() {
                $search = $(this).val();
                if ($search) {
                    $('.all-data ').hide();
                    $('.search-results').show();
                } else {
                    $('.all-data ').show();
                    $('.search-results').hide();
                }

                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('search') }}',
                    data: {
                        'search': $search
                    },
                    success: function(data) {
                        $('#content').html(data)
                        console.log(data);
                    }

                });
            });
        });
    </script>
@endsection
