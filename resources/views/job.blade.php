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
                        <a href="{{ route('create_job') }}" class="btn btn-primary text-bold text-bold bg-gr-blue">+ JOB</a>
                    </div>
                </div>
                <div class="card-body ps-4 pe-4 pb-4">

                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Job No</th>
                                <th>Client</th>
                                <th>Job title</th>
                                <th>Order date</th>
                                <th>Deliver date</th>
                                <th>Sub total</th>
                                <th>Status</th>
                                <th>Active status</th>
                                @if (Auth::user()->role_id == 1)
                                    <th>Invoice</th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $key => $job)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $job->job_no }}</td>
                                    <td>{{ $job['client']['first_name'] }}</td>
                                    <td>{{ $job->job_title }}</td>
                                    <td>{{ $job->order_date->toDateString() }}</td>
                                    <td>{{ $job->deliver_date->toDateString() }}</td>
                                    <td>{{ $job->total_styles_qty }}</td>
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

                                    {{-- active status change --}}
                                    <td>
                                        <div class="d-flex justify-content-center">

                                            @if ($job->record_status == 1)
                                                <span class="badge badge-success">ACTIVE</span>
                                            @else
                                                <span class="badge badge-danger">INACTIVE</span>
                                            @endif

                                        </div>
                                    </td>

                                    {{-- invoice visibility : for invoice admin only --}}
                                    @if (Auth::user()->role_id == 1)
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                {{-- invoice check --}}
                                                @if ($job->invoice == 0)
                                                    <button type="button" value="{{ $job->id }}"
                                                        class="btn btn-sm btn-danger font-weight-bold invoice-edit"
                                                        onclick="confirmInvoice(this.value)">
                                                        NO
                                                    </button>
                                                @else
                                                    <button type="button" value="{{ $job->id }}"
                                                        class="btn btn-sm btn-success font-weight-bold invoice-edit"
                                                        disabled>
                                                        YES
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    @endif

                                    <td>
                                        <div class="row">

                                            @if ($job->record_status == 1)
                                                {{-- to update --}}
                                                <div class="col">
                                                    <a href="{{ route('edit_job', ['job' => $job]) }}"
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
                                            @else
                                                <div class="col">
                                                    <button href="{{ route('edit_job', ['job' => $job]) }}"
                                                        class="btn btn-default btn-sm btn-flat border-0" style="width: 100%"
                                                        disabled>
                                                        Edit
                                                    </button>
                                                </div>
                                                <div class="col">
                                                    <button href="{{ route('view_job_details', ['job' => $job]) }}"
                                                        class="btn btn-success btn-sm btn-flat border-0" style="width: 100%"
                                                        disabled>
                                                        View
                                                    </button>
                                                </div>
                                            @endif



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

    {{-- re importing jQuery because it won't load for some reason  --}}
    <script src="plugins/jquery/jquery.min.js"></script>

    {{-- custom script --}}
    <script>
        function confirmInvoice(jobId) {

            // pops a sweetalert confirm message

            Swal.fire({
                icon: 'question',
                title: 'Confirm invoice check?',
                text: 'Once you check off the invoice, it cannot be reversed. Are you sure you want to confirm?',
                showDenyButton: true,
                confirmButtonText: 'Continue',
                denyButtonText: `Cancel`,
            }).then((result) => {
                if (result.isConfirmed) {

                    // ajax setup
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    let form_data = new FormData();
                    form_data.append('job_id', jobId);

                    $.ajax({
                        url: "{{ url('check_invoice') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: form_data,
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: 1
                                }).then(function() {
                                    location.reload();
                                });
                            } else if (response.status == 500) {
                                Swal.fire({
                                    icon: 'error',
                                    title: response.message,
                                    footer: response.error,
                                    showConfirmButton: 1
                                });
                            }
                        }
                    });

                }
            });


        }
    </script>
@endsection
