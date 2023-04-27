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
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- content section --}}
    <section class="content">
        <div class="container-fluid">
            {{-- job view table card --}}
            <div class="card shadow-lg mb-3" style=" border-radius: 25px;">
                <div class="card-header m-3 mb-0" style="background-color: transparent;">
                    <div class="d-flex justify-content-between">
                        <h5>Job list</h5>
                        <a href="{{ route('create_job') }}" class="btn btn-primary text-bold">+ JOB</a>
                    </div>
                </div>
                <div class="card-body ps-4 pe-4 pb-4">

                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Job ID</th>
                                <th>Client</th>
                                <th>Job title</th>
                                <th>Order date</th>
                                <th>Deliver date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job['client']['first_name'] }}</td>
                                    <td>{{ $job->job_title }}</td>
                                    <td>{{ $job->order_date }}</td>
                                    <td>{{ $job->deliver_date }}</td>
                                    <td>
                                        <div class="row">
                                            {{-- to update --}}
                                            <div class="col">
                                                <a href="{{ route('job', ['job' => $job]) }}"
                                                    class="btn btn-default btn-sm btn-flat" style="width: 100%">
                                                    Edit
                                                </a>
                                            </div>
                                            {{-- to view --}}
                                            <div class="col">
                                                <a href="{{ route('view_job_details', ['job' => $job]) }}"
                                                    class="btn btn-success btn-sm btn-flat" style="width: 100%">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </section>
@endsection
