@extends('layouts.app')

@section('content')
    {{-- token edit modal --}}
    <div class="modal fade" id="token_edit_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                {{-- form --}}
                <form action="{{ route('update_token') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="token_edit_modal_title">Edit token</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">

                        <p id="modal_text_content"></p>

                        {{-- hidden input id --}}
                        <input type="hidden" name="job_department_record_id" id="job_department_record_id">

                        {{-- number input goes here with eror fields --}}
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <input type="number" value="0" class="form-control" name="new_token" id="new_token"
                                    min="0" oninput="this.value = Math.abs(this.value)" />
                                <label for="new_token">New token</label>
                                @error('new_token')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update token</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- header section --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-black-50">Manage tokens</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tokens</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- content section --}}
    <section class="content">

        <div class="container-fluid">

            {{-- success alert --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-block bg-gr-green">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            {{-- failure alerts --}}
            @if ($errors->any())
                <div class="alert alert-block bg-gr-crimson text-light">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- card --}}
            <div class="card shadow-lg mb-3" style=" border-radius: 25px;">
                <div class="card-header m-3 mb-0" style="background-color: transparent;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Department job list</h5>

                        <div style="width:25%">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: transparent;"><span
                                        class="fas fa-box"></span></span>

                                <div class="form-floating">
                                    <select
                                        class="form-select form-select-transparent @error('token_department') is-invalid @enderror"
                                        style="appearance:none;" name="token_department" id="token_department"
                                        onchange="onDepartmentSelect(this.value)">
                                        <option value="" disabled selected hidden>None</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('token_department') == $department->id ? 'selected' : '' }}>
                                                {{ $department->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="token_department">Display records for :</label>
                                    @error('token_department')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body ps-4 pe-4 pb-4 text-center" id="job-department-records">

                    {{-- table removed --}}
                    <div>
                        <p>Select a department to view records</p>
                    </div>

                </div>
            </div>

        </div>

    </section>

    {{-- re importing jQuery because it won't load for some reason  --}}
    <script src="plugins/jquery/jquery.min.js"></script>

    {{-- custom script --}}
    <script>
        // on department select
        function onDepartmentSelect(departmentId) {

            $.ajax({
                url: "{{ route('job_department_records') }}",
                method: "GET",
                data: {
                    "departmentId": departmentId,
                },
                success: function(data) {
                    $('#job-department-records').html(data);
                },
            });

        }

        // edit token -> opens the popup modal to edit the token
        function editToken(jobDepartmentRecordId, tokenValue) {

            // set current token value
            $('#modal_text_content').html(
                `The current token is : <span class="badge badge-warning"> ${tokenValue} </span>. Change it to : `);

            // display modal
            $('#token_edit_modal').modal('show');

            // do an ajax call to update
            $.ajax({
                type: "GET",
                url: "edit_token/" + jobDepartmentRecordId,
                success: function(response) {
                    $("#job_department_record_id").val(jobDepartmentRecordId);
                    $("#new_token").val(response.departmentDetailRecord.token);
                }
            });


        }
    </script>
@endsection
